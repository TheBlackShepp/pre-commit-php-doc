<?php

class FileAttribute
{
    const REGEX = '(public|protected|private|abstract|readonly)\s*(static\s+)?(\w+)\s*\$([\w_]+)\s*';

    public function __construct(string $attribute)
    {
        // Regular expression to capture the attribute details
        $attributePattern = '/\s*' . self::REGEX . '/';

        // Apply the regular expression to extract all attributes
        if (preg_match_all($attributePattern, $attribute, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $attribute) {
                $typeHint = $attribute[3] ?? 'mixed';                               // Default to 'mixed' if not specified
                $attributeName = $attribute[4];
            }
        } else {
            echo "No attributes found.";
        }
    }
}
