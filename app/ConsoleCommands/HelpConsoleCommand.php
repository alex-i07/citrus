<?php

namespace App\ConsoleCommands;

use App\OutputFormatter;

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
//            str_pad
    /**
     * @return mixed
     */
    public function handle($option, $optionValue)
    {
        OutputFormatter::output(self::HELP_CONTENT);
    }
}