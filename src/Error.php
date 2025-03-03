<?php

namespace AP\NodeError;

class Error
{
    public function __construct(
        readonly public string $message,
        public array           $path = [],
    )
    {
    }
}