<?php

abstract class FilePhp
{
    const REGEX = '<\?php\n';
    const ELEMENTS = array();

    public readonly string $name;
    private string $_content;

    public function __construct(string $name, string $content = null)
    {
        $this->name = $name;
        $this->setContent($content);
    }

    public static function readContent(string $fileName): string
    {
        if (is_readable($fileName)) {
            return file_get_contents($fileName);
        }

        throw new RuntimeException("$fileName is not readable");
    }

    public function setContent(string $newContent): void
    {
        $this->_content = $newContent;
    }

    public function getContent(): string
    {
        return $this->_content;
    }

    public function checkBeginnigComment(): bool
    {
        $regex = new Regex(self::REGEX . Comment::REGEX);

        return $regex->hasMatch($this->getContent());
    }

    public function checkComment(): bool
    {
        $regex = new Regex(Comment::REGEX . "\n" . static::REGEX);

        return $regex->hasMatch($this->getContent());
    }
}
