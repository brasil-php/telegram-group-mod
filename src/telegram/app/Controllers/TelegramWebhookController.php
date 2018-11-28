<?php

namespace Telegram\Sdk\Controllers;

use App\Http\Controllers\Controller;
use Telegram\Sdk\Api as Telegram;
use Telegram\Sdk\TelegramRouter;

class TelegramWebhookController extends Controller
{
    public function index()
    {
        $telegram = app(Telegram::class);
        
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);

        $action = $data['message']['text'];

        $route_path = base_path('routes/telegram.php');
        if (!file_exists($route_path)) {
            $route_path = __DIR__ . '/../../routes_webhook.php';
        }

        $telegram_router = new TelegramRouter;
        require $route_path;
        $telegram_router->handler($action, $data);

        return '';
    }
    
    public function info()
    {
        $telegram = app(Telegram::class);

        return (string)$telegram->getWebhookInfo();
    }

    public function set()
    {
        $telegram = app(Telegram::class);

        return (string)$telegram->setWebhook([
            'url'=>config('telegram.webhook_url')
        ]);
    }

    public function delete()
    {
        $telegram = app(Telegram::class);

        return (string)$telegram->deleteWebhook();
    }
}
