<?php

namespace App\Telegram;

class NewChatMember
{
    public function __invoke($data)
    {
        $from = $data['message']['from'];
        $chat = $data['message']['chat'];
        
        $message = 'Olha um cara novo...';

        if (!empty($from['first_name'])) {
            $message .= ' oi ' . $from['first_name'];
        }

        telegram()->sendMessage([
            'chat_id' => $chat['id'],
            'text' => $message
        ]);
    }
}
