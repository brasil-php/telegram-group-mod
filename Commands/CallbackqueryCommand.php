<?php
/**
 * This file is part of the TelegramBot package.
 *
 * (c) Avtandil Kikabidze aka LONGMAN <akalongman@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Longman\TelegramBot\Commands\SystemCommands;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Request;

/**
 * Callback query command
 *
 * This command handles all callback queries sent via inline keyboard buttons.
 *
 * @see InlinekeyboardCommand.php
 */
class CallbackqueryCommand extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'callbackquery';

    /**
     * @var string
     */
    protected $description = 'Reply to callback query';

    /**
     * @var string
     */
    protected $version = '1.1.1';

    /**
     * Command execute method
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $callback_query    = $this->getCallbackQuery();
        $member = $callback_query->getFrom()->getUsername();
        $chat_id = $callback_query->getMessage()->getChat()->getId();
        
        $callback_query_id = $callback_query->getId();
        $callback_data     = $callback_query->getData();
        $from     = $callback_query->getFrom()->getId();

        $callback_data = json_decode($callback_data, true);

        if ($callback_data['type'] === 'identifier') {
            $this->newMemberCallback($chat_id, $from, $callback_data, $member, $callback_query_id);
        }
    }

    protected function newMemberCallback($chat_id, $from, $callback_data, $member, $callback_query_id) {
        if (is_array($callback_data['data']['members'])) {
            $new_members = implode(', ', $callback_data['data']['members']);
        } else {
            $callback_data['data']['members'] = [$callback_data['data']['members']];
            $new_members = $callback_data['data']['members'];
        }

        $result = in_array($member, $callback_data['data']['members']);

        if (empty($result)) {
            $text = '@' . $member . ', este botão não é para você, intrometido!' . PHP_EOL . ' @' . $new_members . ' quem deveria clicar';
        } else {
            $text = "Olá @" . $new_members . "!" . PHP_EOL . "Seja bem vindo ao grupo!";
            $this->unbanUser($chat_id, $from);
        }

        $data = [
            'callback_query_id' => $callback_query_id,
            'text'              => $text,
            'show_alert'        => true,
            'cache_time'        => 5,
        ];

        return Request::answerCallbackQuery($data);
    }

    private function unbanUser($chat_id, $member)
    {
        Request::restrictChatMember([
            'chat_id' => $chat_id,
            'user_id' => $member,
            'can_send_messages' => true,
            'can_send_media_messages' => true,
            'can_send_other_messages' => true,
            'can_add_web_page_previews' => true,
        ]);
    }
}
