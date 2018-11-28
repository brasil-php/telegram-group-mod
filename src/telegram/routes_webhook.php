<?php

$telegram_router['/start'] = function ($data) use ($telegram) {
    $from = $data['message']['from'];
    $chat = $data['message']['chat'];

    $name = '';
    if (!empty($from['first_name'])) {
        $name = ' ' . $from['first_name'];
    }
    
    $message = 'Oi%s, Se quiser alterar este endpoint, altere publicando o "routes/telegram.php" com comando "php artisan vendor:publish"';


    $telegram->sendMessage([
        'chat_id' => $chat['id'],
        'text' => sprintf($message , $name)
    ]);
};
