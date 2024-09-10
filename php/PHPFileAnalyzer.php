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

        // TODO: Move this line
        $shell->showNameFile($file->name);

        // Main comment
        if ($file->checkBeginnigComment()) {
            // TODO: Move this line
            $shell->echo(Icons::CORRECT->value . " has comment after the <?php");
        } else {
            // TODO: Move this line
            $shell->echo(Icons::FAIL->value . "doesn't have comment after the <?php", Colors::FAIL);
        }

        // Comment before class/trait/...
        if ($file->checkComment()) {
            // TODO: Move this line
            $shell->echo(Icons::CORRECT->value . " have comment");
        } else {
            // TODO: Move this line
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
}