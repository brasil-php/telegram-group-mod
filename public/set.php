<?php

require __DIR__ . '/../bootstrap.php';

try {
    $telegram = $c['telegram'];

    $result = $telegram->setWebhook(getenv('HOOK_URL'));
    if ($result->isOk()) {
        echo $result->getDescription();
    }
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    Longman\TelegramBot\TelegramLog::error($e);
}