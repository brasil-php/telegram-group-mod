<?php

use Pimple\Container;

$c = new Container();

$c['logger'] = function () {
    $logger = new Monolog\Logger(getenv('LOG_NAME'));
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler(__DIR__ . getenv('LOG_PATH'), getenv('LOG_LEVEL')));
    return $logger;
};

$c['telegram'] = function () {
    $telegram = new Longman\TelegramBot\Telegram(getenv('BOT_API_KEY'), getenv('BOT_USERNAME'));

    Longman\TelegramBot\TelegramLog::initErrorLog(__DIR__ . '/logs/' . getenv('BOT_USERNAME') . '_error.log');
    Longman\TelegramBot\TelegramLog::initDebugLog(__DIR__ . '/logs/' . getenv('BOT_USERNAME') . '_debug.log');
    Longman\TelegramBot\TelegramLog::initUpdateLog(__DIR__ . '/logs/' . getenv('BOT_USERNAME') . '_update.log');

    $telegram->enableLimiter();
    return $telegram;
};