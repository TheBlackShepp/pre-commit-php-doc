<?php

/**
 * Class Comment
 * 
 * Represents a PHPDoc comment and provides methods for parsing and validating its content,
 * as well as extracting and formatting associated tags (e.g., @param, @return).
 */
class Comment
{
    /**
     * Regular expression pattern used to match PHPDoc comments.
     * 
     * @var string
     */
    const REGEX = "\/\*\*[\s\S]*?\*\/";

    /**
     * The content of the PHPDoc comment.
     * 
     * @var string
     */
    protected string $content;

    /**
     * The title or general description from the PHPDoc comment.
     * 
     * @var string
     */
    protected string $title = '';

    /**
     * An array of `CommentTag` objects representing the tags within the PHPDoc comment.
     * 
     * @var CommentTag[]
     */
    protected array $tags = [];

    /**
     * Constructor for the Comment class.
     *
     * @param string $content The full PHPDoc comment content.
     */
    public function __construct(string $content)
    {
        $this->content = $content;
        $this->parseComment();
    }

    /**
     * Checks if the content is a well-formed PHPDoc comment.
     *
     * @return bool Returns true if the comment matches the PHPDoc format, false otherwise.
     */
    public function isValidPhpDoc(): bool
    {
        return preg_match('/^\/\*\*[\s\S]*?\*\/$/', $this->content) === 1;
    }

    /**
     * Parses the PHPDoc comment, separating the title from the tags.
     * 
     * This method processes the content line-by-line to identify the general description (title)
     * and the specific tags (e.g., @param, @return).
     */
    protected function parseComment(): void
    {
        $lines = explode(PHP_EOL, $this->content);

        $isInTags = false;  // Para distinguir cuándo empiezan las etiquetas

        foreach ($lines as $line) {
            $line = trim($line, "/* ");

            if (empty($line)) {
                continue;
            }

            if (!$isInTags && !preg_match('/^\@/', $line)) {
                $this->title .= $line . ' ';
            } else {
                $isInTags = true;  // Una vez que encontramos la primera etiqueta, empezamos a extraerlas
                $this->extractTag($line);
            }
        }

        $this->title = trim($this->title);  // Limpiamos espacios adicionales
    }

    /**
     * Extracts a tag from a line in the PHPDoc comment.
     * 
     * Recognizes common PHPDoc tags such as @param, @return, @var, and @throws.
     * 
     * @param string $line The line containing the tag.
     */
    protected function extractTag(string $line): void
    {
        if (preg_match('/^\@param\s+([^\s]+)\s+\$([^\s]+)\s+([^\*]*)/', $line, $matches)) {
            $this->tags[] = new CommentTag('@param', $matches[1], $matches[2], $matches[3]);
        } elseif (preg_match('/^\@return\s+([^\s]+)\s+([^\*]*)/', $line, $matches)) {
            $this->tags[] = new CommentTag('@return', $matches[1], '', $matches[2]);
        } elseif (preg_match('/^\@var\s+([^\s]+)\s+([^\*]*)/', $line, $matches)) {
            $this->tags[] = new CommentTag('@var', $matches[1], '', $matches[2]);
        } elseif (preg_match('/^\@throws\s+([^\s]+)\s+([^\*]*)/', $line, $matches)) {
            $this->tags[] = new CommentTag('@throws', $matches[1], '', $matches[2]);
        }
    }
}
