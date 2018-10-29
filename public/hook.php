<?php

require __DIR__ . '/../bootstrap.php';

try {
    $telegram = $c['telegram'];

    $telegram->addCommandsPaths([__DIR__ . '/../Commands']);

    $telegram->handle();
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    Longman\TelegramBot\TelegramLog::error($e);
}