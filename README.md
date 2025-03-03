# AP\ErrorNode

[![MIT License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

A simple and lightweight PHP library for handling structured error messages, useful for validation, data processing, and API responses.

## Installation

```bash
composer require ap-lib/error-node
```

## Features

- Structured error representation
- Easy instantiation of single or multiple errors
- Throwable error handling
- Simple and extensible design

## Requirements

- PHP 8.3 or higher

## Getting started

### Basic usage

```php
use AP\NodeError\Error;
use AP\NodeError\Errors;
use AP\NodeError\ThrowableErrors;

// Creating a single error
$error = new Error("Invalid input", ["user", "email"]);

// Creating multiple errors
$errors = new Errors([
    new Error("Field is required", ["user", "name"]),
    new Error("Invalid format", ["user", "email"]),
]);

// Handling errors
if (!empty($errors->getErrors())) {
    throw $errors->getNodeErrorsThrowable();
}
```