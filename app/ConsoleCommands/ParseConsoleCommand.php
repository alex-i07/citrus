<?php

namespace App\ConsoleCommands;

use App\PageParser;
use App\OutputFormatter;

class ParseConsoleCommand
{
    /**
     * COMMANDER/INVOKER
     * Name of the parameter in command line without hyphens.
     */
    public const OPTION = 'url';

    /**
     * @return mixed
     */
    public function handle($option, $optionValue)
    {
        $result = PageParser::parsePage($optionValue);


        // carWash invoker/Commander
//        $carWash->addProgramme('motorwash',
//            new CarSimpleWashCommand,
//            new CarMotorWashCommand,
//            new CarDryCommand,
//            new CarWaxCommand
//        );

//        var_dump($result); exit(0);

        $urls = $result['urls'];

        unset($result['urls']);

        OutputFormatter::output($result);

//        foreach ($urls as $url) {
//            if("http://{$optionValue}" !== $url) {
//                $tmp = PageParser::parsePage($url);
//                if (isset($tmp['urls'])) {
//                    $result[] = $tmp['urls'];
//                    unset($tmp['urls']);
//                }
//            }
//        }

    }
}