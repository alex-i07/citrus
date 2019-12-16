<?php

namespace App\Commands;


class ReportCommand
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