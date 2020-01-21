#!/usr/bin/php
<?php
ini_set('xdebug.max_nesting_level', '5000');

use App\Registry;
use App\ConsoleCommandFactory;

require __DIR__ . '/vendor/autoload.php';

$command = isset($argv[1]) ? $argv[1] : null;
$option = isset($argv[2]) ? $argv[2] : null;

preg_match(Registry::OPTION_PARSER_REG_EXP, $option, $matches);

$option = isset($matches[1]) ? $matches[1] : null;
$optionValue = isset($matches[2]) ? $matches[2] : null;

$command = ConsoleCommandFactory::make($command, $option, $optionValue);
$command->handle($option, $optionValue);

exit(0);
