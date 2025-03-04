<?php

namespace AP\ErrorNode;

class Error
{
    readonly public string $message;

    public function __construct(
        string                $message,
        public array          $path = [],
        readonly public array $context = [],
    )
    {
        if (empty($this->context)) {
            $this->message = $message;
        } else {
            $keys = [];
            foreach ($this->context as $k => $v) {
                $keys[] = '{' . $k . '}';
            }
            $this->message = str_replace($keys, $this->context, $message);
        }
    }
}