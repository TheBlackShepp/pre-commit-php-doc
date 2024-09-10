<?php
enum Colors: string
{
    case HEADER = "\033[95m";
    case OKBLUE = "\033[94m";
    case OKCYAN = "\033[96m";
    case OKGREEN = "\033[92m";
    case WARNING = "\033[93m";
    case FAIL = "\033[91m";
    case ENDC = "\033[0m";
    case BOLD = "\033[1m";
    case UNDERLINE = "\033[4m";
}

enum Icons: string
{
    case ERROR = "⛔";
    case FAIL = "❌";
    case CORRECT = "✔️";
}


class Shell
{
    private static ?Shell $instance = null;

    public static function getInstance(): Shell
    {
        if (self::$instance == null) {
            self::$instance = new Shell();
        }
        return self::$instance;
    }

    public function echo(string $message, Colors $color = null): void
    {
        if (is_null($color)) {
            echo $message . PHP_EOL;
        } else {
            echo $color->value . $message . Colors::ENDC->value . PHP_EOL;
        }
    }

    public function showNameFile(string $name): void
    {
        $separator = '';
        for ($i = 0; $i < strlen($name) + 4; $i++) {
            $separator .= '-';
        }

        $this->echo('');
        $this->echo($separator);
        $this->echo("| " . $name . " |");
        $this->echo($separator);
    }
}
