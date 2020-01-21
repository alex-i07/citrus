<?php

namespace App\ConsoleCommands;

use App\Registry;
use App\Handlers\HtmlPageFetcher;

class ReportConsoleCommand
{
    /**
     * Name of the parameter in command line without hyphens.
     */
    public const OPTION = 'domain';

    /**
     * Output type.
     */
    public const OUTPUT_TYPE = 'console';

    /**
     * @return mixed
     */
    public function handle($option, $optionValue)
    {
        preg_match(Registry::OPTION_VALUE_PARSER_REG_EXP, $optionValue, $matches);

        Registry::setDomainName($matches[3]);

        if (empty($matches[1])) {
            Registry::setUrlsToParse(['http://' . $optionValue]);
        }

        Registry::setOutputType(self::OUTPUT_TYPE);

        $handler = new HtmlPageFetcher();

        $handler->handle();
    }
}