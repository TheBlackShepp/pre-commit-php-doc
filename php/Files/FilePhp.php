<?php

abstract class FilePhp
{
    const REGEX_STARTED_FILE = "<\?php\n";
    const REGEX = '';
    const ELEMENTS = array();

    public readonly string $name;
    private string $_content;

    public function __construct(string $name, string $content = null)
    {
        $this->name = $name;
        $this->setContent($content);
    }

    public function setContent(string $newContent): void
    {
        $this->_content = $newContent;
    }

    public function getContent(): string
    {
        return $this->_content;
    }

    public static function readContent(string $fileName): string
    {
        if (is_readable($fileName)) {
            return file_get_contents($fileName);
        }

        throw new RuntimeException("$fileName is not readable");
    }
}
