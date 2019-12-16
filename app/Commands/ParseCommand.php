<?php

namespace App\Commands;

use App\PageParser;
use App\OutputFormatter;

class ParseCommand
{
    /**
     * Name of the parameter in command line without hyphens.
     */
    public const OPTION = 'url';

    /**
     * @return mixed
     */
    public function handle($option, $optionValue)
    {
        $result = PageParser::parsePage($optionValue);

        $urls = $result['urls'];

        unset($result['urls']);

        OutputFormatter::output($result);

        foreach ($urls as $url) {
            if("http://{$optionValue}" !== $url) {
                $tmp = PageParser::parsePage($url);
                if (isset($tmp['urls'])) {
                    $result[] = $tmp['urls'];
                    unset($tmp['urls']);
                }
            }
        }

    }
}