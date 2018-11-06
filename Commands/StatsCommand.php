<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06/11/18
 * Time: 20:21
 */

namespace Longman\TelegramBot\Commands\SystemCommands;


use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\DB;
use Longman\TelegramBot\Request;
class StatsCommand extends SystemCommand
{
    protected $name = 'stats';
    protected $description = 'Stat command for issues';
    protected $usage = '/stats';
    protected $version = '1.0.0';

    public function execute()
    {
        $pdo = DB::getPdo();

        $countIssues = $pdo->query('SELECT * FROM message where text like "%#issue%"')->rowCount();
        $countResolved = $pdo->query('SELECT * FROM message where text like "%#resolved%"')->rowCount();
        $message = $this->getMessage();

        $chat_id = $message->getChat()->getId();

        $data = [
            'chat_id' => $chat_id,
            'text'    => "Issues criadas: {$countIssues}\nIssues resolvidas: {$countResolved}",
        ];

        return Request::sendMessage($data);
    }
}