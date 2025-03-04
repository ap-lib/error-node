<?php

namespace AP\ErrorNode;

use RuntimeException;

class ThrowableErrors extends \Error
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
        parent::__construct();
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
     * @return Errors
     */
    public function getNodeErrors(): Errors
    {
        return new Errors($this->errors);
    }
}