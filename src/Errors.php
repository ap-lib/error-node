<?php

namespace AP\NodeError;

use RuntimeException;

class Errors
{
    protected array $errors;

    /**
     * @param array<Error> $errors The list of casting errors encountered
     * @throws RuntimeException If any provided error isn't an instance of `Error`
     */
    public function __construct(array $errors)
    {
        foreach ($errors as $error) {
            if (!($error instanceof Error)) {
                throw new RuntimeException("All cast errors must extend " . Error::class);
            }
            $this->errors[] = $error;
        }
    }

    /**
     * @param string $message
     * @param array $path
     * @return self
     */
    public static function one(string $message, array $path = []): self
    {
        return new self([new Error($message, $path)]);
    }

    /**
     * Retrieves the list of casting errors
     *
     * @return array<Error>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return ThrowableErrors
     */
    public function getNodeErrorsThrowable(): ThrowableErrors
    {
        return new ThrowableErrors($this->errors);
    }

}