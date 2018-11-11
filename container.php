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

    $mysql_credentials = [
        'host' => getenv('MYSQL_HOST'),
        'port' => getenv('MYSQL_PORT'), // optional
        'user' => getenv('MYSQL_USER'),
        'password' => getenv('MYSQL_PASSWORD'),
        'database' => getenv('MYSQL_DB'),
    ];

    $telegram->enableMySql($mysql_credentials);

    Longman\TelegramBot\TelegramLog::initErrorLog(__DIR__ . '/logs/' . getenv('BOT_USERNAME') . '_error.log');
    Longman\TelegramBot\TelegramLog::initDebugLog(__DIR__ . '/logs/' . getenv('BOT_USERNAME') . '_debug.log');
    Longman\TelegramBot\TelegramLog::initUpdateLog(__DIR__ . '/logs/' . getenv('BOT_USERNAME') . '_update.log');

    $telegram->enableLimiter();
    return $telegram;
};