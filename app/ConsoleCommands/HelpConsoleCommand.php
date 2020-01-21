<?php

namespace App\ConsoleCommands;

class HelpConsoleCommand
{
    /**
     * Name of the parameter in command line without hyphens.
     */
    public const OPTION = 'help';

    /**
     * Help text.
     */
    protected const HELP_CONTENT = [ 'HELP MESSAGE' => [
        "parser.php help: \t \t  \t \t \t    outputs this help message",
        "parser.php parse --url=(http://|https://|)example.org/page: parse page specified in --url flag",
        "parser.php report --domain=(http://|https://|)example.org:  analyze specified domain",
    ]];

    /**
     * @return mixed
     */
    public function handle($option, $optionValue)
    {
        foreach (self::HELP_CONTENT as $key => $value) {
            echo str_pad($key, 100, '=', STR_PAD_BOTH) . "\n";
            foreach ($value as $k => $v) {
                echo (string)($k + 1) . "." . "\t" . str_pad($v, 90, " ", STR_PAD_RIGHT) . "\n" .
                    str_pad(' ', 90, '-', STR_PAD_RIGHT) . "\n";
            }
        }
    }
}