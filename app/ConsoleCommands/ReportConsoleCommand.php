<?php

namespace App\ConsoleCommands;


class ReportConsoleCommand
{
    public const OPTION = 'domain';
    /**
     * @return mixed
     */
    public function handle($option, $optionValue)
    {
        var_dump($option, $optionValue);
    }
}