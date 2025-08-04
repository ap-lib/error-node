<?php

namespace AP\ErrorNode;

use RuntimeException;

class Errors
{
    /**
     * @var array<Error>
     */
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
     * Prepends a path segment to all existing error paths.
     *
     * This is useful when nesting validation contexts. Each error's path
     * will be updated to reflect its position relative to a new root or scope.
     *
     * Example:
     *   Original path: ['email']
     *   After prependPathSegment('user'): ['user', 'email']
     *
     * @param string $segment The path segment to prepend.
     * @return static Returns the current instance for method chaining.
     */
    public function prependPathSegment(string $segment): static
    {
        foreach ($this->errors as $error){
            $error->path = array_merge([$segment], $error->path);
        }
        return $this;
    }

    /**
     * @param string $message
     * @param array $context
     * @param array $path
     * @return self
     */
    public static function one(string $message, array $context = [], array $path = []): self
    {
        return new self([new Error($message, $path, $context)]);
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