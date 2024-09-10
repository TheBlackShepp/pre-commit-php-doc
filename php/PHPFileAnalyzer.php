<?php

class PHPFileAnalyzer
{
    static public function analyzeFile(FilePhp $file): void
    {
        $shell = Shell::getInstance();

        if ($file === null) {
            $shell->echo(Icons::FAIL->value . " File could not be generated.", Colors::FAIL);
            return;
        }

        $shell->showNameFile($file->name);

        // Main comment
        if (self::hasCommentInFile($file)) {
            $shell->echo(Icons::CORRECT->value . " has comment after the <?php");
        } else {
            $shell->echo(Icons::FAIL->value . "doesn't have comment after the <?php", Colors::FAIL);
        }

        // Comment before class/trait/...
        if (self::hasCommentInObject($file)) {
            $shell->echo(Icons::CORRECT->value . " have comment");
        } else {
            $shell->echo(Icons::FAIL->value . "doesn't have comment", Colors::FAIL);
        }

        // Check Elements have
        foreach ($file::ELEMENTS as $element) {
            $regex = new Regex($element::REGEX);
            $coincidences = $regex->getMatches($file->getContent());

            foreach ($coincidences[0] as $coincidence) {
                $instanceElement = new $element($coincidence[0]);
            }
        }
    }

    private static function hasCommentInFile(FilePhp $file): bool
    {
        $regex = new Regex($file::REGEX_STARTED_FILE . COMMENT);

        return $regex->hasMatch($file->getContent());
    }

    private static function hasCommentInObject(FilePhp $file): bool
    {
        $regex = new Regex(COMMENT . "\n" . $file::REGEX);

        return $regex->hasMatch($file->getContent());
    }
}
