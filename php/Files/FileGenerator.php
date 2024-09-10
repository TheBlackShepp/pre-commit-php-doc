<?php

include "boostrap.php";

class FileGenerator
{
    public static function generateFile($name, $content)
    {
        $subclass = self::getSubclasses();
        foreach ($subclass as $subclass) {
            $regex = new Regex($subclass::REGEX);
            if ($regex->hasMatch($content)) {
                return new $subclass($name, $content);
            }
        }
        return null; // Return null if no match is found
    }

    private static function getSubclasses(): array
    {
        $subclasses = [];
        foreach (get_declared_classes() as $className) {
            if (is_subclass_of($className, FilePhp::class)) {
                $subclasses[] = $className;
            }
        }
        return $subclasses;
    }
}
