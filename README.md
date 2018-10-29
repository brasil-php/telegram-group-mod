# Telegram Bot Mod 🤖

## Como usar?

Crie um Bot com o [BotFather](https://telegram.me/botfather) enviando a mensagem `/newbot` para ele, siga as instruções que ele te der e anote o token que ele vai retornar.

Faça uma cópia do arquivo `.env.example` com o nome `.env` e preencha com o username e token criados junto ao BotFather e a URL do WebHook em que este repositório vai ficar.

Lembre-se de:

 - Rodar o comando `/setprivacy` e escolher `Disable`
 - Adicionar o Bot como administrador do Grupo

## Como debugar.

A forma mais eficiente que encontrei foi usar o [Ngrok](https://ngrok.com/), ele fornece uma URL online e com HTTPS para acesso ao seu Computador, na porta que voce informar, na sequência eu configurei o XDebug com debug remoto no Visual Studio Code, mas você pode tentar fazer isso em qualquer IDE/Editor de texto do mercado.

```
// TODO: adicionar tutoriais de como configurar o XDebug com Visual Studio Code (e/ou outras IDEs e editores de texto) e como usar o Ngrok.
```

## Como contribuir

Veja o que tem pra fazer nas issues, mande seu PR.
