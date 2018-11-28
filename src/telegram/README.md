# Laravel Telegram Simple Integration

## Instalação

```
composer require erikfig/laravel-telegram
```

## Uso

Para testar, crie duas variáveis de ambiente:

```
TELEGRAM_TOKEN="TOKEN_DO_BOT"
TELEGRAM_WEBHOOK_URL="https://url-para-o-laravel/telegram"
```

Ele deve responder nativamente pelo comando `/start` (botão "começar"), publique os arquivos de configuração com o comando `php artisan vendor:publish` e altere o `routes/telegram.php`, este serviço não segue a mesma estrutura do Laravel, mas expressões regulares nativas.
