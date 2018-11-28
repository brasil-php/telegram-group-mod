<?php
use App\Telegram\Start;
use App\Telegram\NewChatMember;

$telegram_router['/start'] = new Start;

$telegram_router['new_chat_member'] = new NewChatMember;

$telegram_router['default_action'] = function ($data) {
    $chat = $data['message']['chat'];

    $telegram->sendMessage([
        'chat_id' => $chat['id'],
        'text' => 'Eu não entendi...'
    ]);
};
