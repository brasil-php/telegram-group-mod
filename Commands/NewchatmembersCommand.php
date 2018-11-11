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
use Longman\TelegramBot\Entities\InlineKeyboard;
/**
 * New chat member command
 */
class NewchatmembersCommand extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'newchatmembers';
    /**
     * @var string
     */
    protected $description = 'New Chat Members';
    /**
     * @var string
     */
    protected $version = '1.2.0';
    /**
     * Command execute method
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $message = $this->getMessage();

        $chat_id = $message->getChat()->getId();
        $memberList = $message->getNewChatMembers();

        if (!is_array($memberList)) {
            $memberList = [$memberList];
        }

        $members = array_map(function ($member) {
            return $member->tryMention();
        }, $memberList);

        $keyboard_data = [
            'type' => 'identifier',
            'data' => [
                'members' => $members
            ]
        ];

        $inline_keyboard = new InlineKeyboard([
            ['text' => 'Não sou um robô 🤖', 'callback_data' => json_encode($keyboard_data)]
        ]);

        $data = [
            'chat_id'      => $chat_id,
            'text'         => implode(', ', $members) . ', confirme que você não é um robô clicando no link a seguir',
            'reply_markup' => $inline_keyboard,
        ];

        foreach ($memberList as $member) {
           $this->blockUser($chat_id, $member->getId());
        }

       return Request::sendMessage($data);
    }

    private function blockUser($chat_id, $member)
    {
        Request::restrictChatMember([
            'chat_id' => $chat_id,
            'user_id' => $member,
            'can_send_messages' => false,
            'can_send_media_messages' => false,
            'can_send_other_messages' => false,
            'can_add_web_page_previews' => false,
        ]);
    }
}