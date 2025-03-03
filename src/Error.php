<?php

namespace AP\ErrorNode;

class Error
{
    public function __construct(
        readonly public string $message,
        public array           $path = [],
    )
    {
    }
}