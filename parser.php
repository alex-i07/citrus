#!/usr/bin/php
<?php

use App\CommandFactory;
require __DIR__.'/vendor/autoload.php';

$command = isset($argv[1]) ? $argv[1] : null;
$option = isset($argv[2]) ? $argv[2] : null;

$optionParserRegExp = "/^--(url|domain)=(http:\/\/|https:\/\/|)(.+)$/";

preg_match($optionParserRegExp, $option, $matches);

$option = isset($matches[1]) ? $matches[1] : null;
$optionValue = isset($matches[3]) ? $matches[3] : null;

$command = CommandFactory::make($command, $option, $optionValue);
$command->handle($option, $optionValue);

exit(0);
