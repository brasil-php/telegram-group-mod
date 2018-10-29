<?php
require __DIR__ . '/../bootstrap.php';

try {
    $telegram = $c['telegram'];

    $result = $telegram->deleteWebhook();
    if ($result->isOk()) {
        echo $result->getDescription();
    }
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    Longman\TelegramBot\TelegramLog::error($e);
}