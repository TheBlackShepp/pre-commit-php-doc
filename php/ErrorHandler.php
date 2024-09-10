<?php

class ErrorHandler
{
    private static ?ErrorHandler $instance = null;
    private array $errorStack = [];

    public static function getInstance(): ErrorHandler
    {
        if (self::$instance == null) {
            self::$instance = new ErrorHandler();
        }
        return self::$instance;
    }

    public function add(string $message, int $codeError): void
    {
        $this->errorStack[] = "[" . $codeError . "] " . $message;
    }

    public function hasAnyErrors(): bool
    {
        return count($this->errorStack) > 0;
    }

    public function cleanStack(): void
    {
        $this->errorStack = [];
    }

    public function getErrors(): array
    {
        return $this->errorStack;
    }
}
