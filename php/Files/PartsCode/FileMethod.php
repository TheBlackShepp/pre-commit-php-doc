<?php

class FileMethod
{
    const REGEX = '(\w+\s+|)(public|protected|private)(\s+\w+\s+|\s+)function\s+(\w+)\s*\(([^)]*)\)\s*(:\s*\??\s*(\w+))?';
    
    // Regular expression to capture the method name and parameters
    private string $_patternParameters = '/(\??\w+)\s+\$([\w_]+)(\s*=\s*[^,]+)?/';

    private string $_name;
    private ?array $_parameters;
    private string $_return;

    public function __construct(string $method)
    {
        // Excecute expression to capture the method name and parameters
        $matches = $this->_doRegexToMethod($method);

        if (sizeof($matches) > 0) {
            $this->_name = $this->_extractMehodName($matches);              // Extracted method name
            $this->_parameters = $this->_extractPararemeters($matches);     // Extract parameters and type
            $this->_return = $this->_extractReturn($matches);               // Extract the method return type
        } else {
            echo "No method found.";
        }
    }

    public function getName(): string 
    {
        return $this->_name;
    }

    public function getParameters():?array
    {
        return $this->_parameters;
    }

    public function getReturn(): string
    {
        return $this->_return;
    }

    private function _doRegexToMethod(string $method): array
    {
        // Apply the regular expression to extract the method name and parameters
        if (preg_match("/".self::REGEX."/", $method, $matches)) {
            return $matches;
        }

        return array();
    }

    private function _extractMehodName(array $matchesRegex): string
    {
        return $matchesRegex[4];
    }


    private function _extractReturn(array $matchesRegex): string
    {
        return $matchesRegex[6] ?? 'void';
    }


    private function _extractPararemeters(array $matchesRegex): ?array
    {
        $parameters = $matchesRegex[5];  // Extracted parameter string

        // If there are parameters, extract them
        if (!empty($parameters)) {
            // Find all matches for individual parameters
            preg_match_all($this->_patternParameters, $parameters, $paramMatches, PREG_SET_ORDER);

            $parameters = array();

            foreach ($paramMatches as $param) {
                $parameters[] = new Parameter($param[1], $param[2]);
            }

            return $parameters;
        }

        return null;
    }
}
