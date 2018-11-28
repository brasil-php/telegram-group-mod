<?php

namespace App\Telegram;

class Start
{
    public function __invoke($data)
    {
        $from = $data['message']['from'];
        $chat = $data['message']['chat'];

        $name = '';
        if (!empty($from['first_name'])) {
            $name = ' ' . $from['first_name'];
        }
        
        $message = 'Oi%s, agora um endpoint com classe';

        telegram()->sendMessage([
            'chat_id' => $chat['id'],
            'text' => sprintf($message , $name)
        ]);
    }
}
