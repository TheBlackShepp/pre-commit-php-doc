<?php

/**
 * Represents a documentation comment tag, such as @param or @return, 
 * with associated metadata like type, value type, variable name, and description.
 */
class CommentTag
{
    /**
     * The type of the comment tag (e.g., @param, @return).
     * 
     * @var string
     */
    public string $type;

    /**
     * The type of the value or variable associated with the tag.
     * 
     * @var string
     */
    public string $valueType;

    /**
     * The name of the variable or return value.
     * 
     * @var string
     */
    public string $name;

    /**
     * A brief description of the parameter or return value.
     * 
     * @var string
     */
    public string $description;

    /**
     * Constructor for the CommentTag class.
     *
     * @param string $type        The type of the tag (e.g., @param, @return).
     * @param string $valueType   The data type of the value or variable (optional).
     * @param string $name        The name of the variable or return value (optional).
     * @param string $description A description of the parameter or return value (optional).
     */
    public function __construct(string $type, string $valueType = '', string $name = '', string $description = '')
    {
        $this->type = $type;
        $this->valueType = $valueType;
        $this->name = $name;
        $this->description = $description;
    }
}
