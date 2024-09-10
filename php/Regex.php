<?php

class Regex
{
    private string $_regex;

    public function __construct(string $regex)
    {
        $this->_regex = $regex;
    }

    public function __toString(): string
    {
        return "/" . $this->_regex . "/";
    }

    public function hasMatch(string $content): bool
    {
        return (bool) preg_match($this, $content);
    }

    public function getMatches(string $content): array
    {
        preg_match_all($this, $content, $coincidences, PREG_OFFSET_CAPTURE);

        return $coincidences;
    }
}
