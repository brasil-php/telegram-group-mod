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
 * Start command
 *
 * Gets executed when a user first starts using the bot.
 */
class StartCommand extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'start';

    /**
     * @var string
     */
    protected $description = 'Start command';

    /**
     * @var string
     */
    protected $usage = '/start';

    /**
     * @var string
     */
    protected $version = '1.1.0';

    /**
     * @var bool
     */
    protected $private_only = true;

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
        $members = $message->getNewChatMembers();

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

        return Request::sendMessage($data);
    }
}
