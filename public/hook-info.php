<?php

require __DIR__ . '/../bootstrap.php';

use Longman\TelegramBot\Request;

try {
    $telegram = $c['telegram'];

    $data = Request::getWebhookInfo();

    var_dump(getenv('BOT_USERNAME'), $data);
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    Longman\TelegramBot\TelegramLog::error($e);
}