<?php

namespace AP\ErrorNode;

class Error
{
    public function __construct(
        readonly public string $message,
        public array           $path = [],
        readonly public array  $context = [],
    )
    {
    }

    public function getFinalMessage(): string
    {
        if (empty($this->context)) {
            return $this->message;
        }
        $keys = [];
        foreach ($this->context as $k => $v) {
            $keys[] = '{' . $k . '}';
        }
        return str_replace($keys, $this->context, $this->message);
    }
}