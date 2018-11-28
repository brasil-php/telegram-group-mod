<?php

Route::post('/', 'TelegramWebhookController@index');
Route::get('/info', 'TelegramWebhookController@info');
Route::get('/set', 'TelegramWebhookController@set');
Route::get('/delete', 'TelegramWebhookController@delete');
