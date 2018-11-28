<?php

if (!function_exists('telegram')) {
    function telegram() {
        return app(\Telegram\Sdk\Api::class);
    }
}