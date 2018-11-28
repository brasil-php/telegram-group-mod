<?php

namespace Telegram\Sdk;

class TelegramRouter implements \ArrayAccess
{

    private $itens = [];

    public function __construct(array $itens = [])
    {
        $this->itens = $itens;
    }

    public function handler($path, $data)
    {
        if (!empty($data['new_chat_member'])) {
            $handler = $this->offsetGet("new_chat_member");
            return $handler($data);
        }

        foreach ($this->toArray() as $route => $handler) {
            $route = '/^' . str_replace('/', '\/', $route) . '$/';
            if (preg_match($route, $path, $params)) {
                return $handler($data, $params);
            }
        }

        if ($this->offsetExists('default_action')) {
            $handler = $this->offsetGet("default_action");
            return $handler($data);
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->itens[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->itens[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->itens[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->itens[$offset]);
    }

    public function toArray()
    {
        return $this->itens;
    }
}
