<?php

class FileAttribute
{
    const REGEX = '(public|protected|private|abstract|readonly)\s*(static\s+)?(\w+)\s*\$([\w_]+)\s*';

    private string $_name;
    private string $_type;

    public function __construct(string $attribute)
    {
        // Excecute expression to capture the name and type
        $matches = $this->_doRegexToMethod($attribute);

        if (count($matches) > 0 &&  count($matches[0]) > 0 ) {
            $this->_name = $this->_extractName($matches[0]);
            $this->_type = $this->_extractType($matches[0]);
        } else {
            echo "No attributes found.";
        }
    }

    public function getName(): string
    {
        return $this->_name;
    }

    public function getType(): string
    {
        return $this->_type;
    }

    private function _doRegexToMethod(string $attribute): array
    {
        // Regular expression to capture the attribute details
        $attributePattern = '/\s*' . self::REGEX . '/';

        // Apply the regular expression to extract the method name and parameters
        if (preg_match_all($attributePattern, $attribute, $matches, PREG_SET_ORDER)) {
            return $matches;
        }

        return array();
    }

    private function _extractName(array $matchesRegex): string
    {
        return $matchesRegex[4];
    }


    private function _extractType(array $matchesRegex): string
    {
        return $matchesRegex[3];
    }
}
