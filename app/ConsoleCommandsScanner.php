<?php

namespace App;


class ConsoleCommandsScanner
{
    /**
     * Directory where commands files are placed.
     */
    protected const COMMANDS_PATH = 'app' . DIRECTORY_SEPARATOR . 'ConsoleCommands' . DIRECTORY_SEPARATOR;

    /**
     * RegExp that is used to parse command file name to
     * retrieve command itself.
     */
    protected const REGEXP = "/^([A-Z]{1}[a-z]+){1}Command\.php$/";

    /**
     * Scan specified directory for available command files and
     * return available commands.
     *
     * @return array
     */
    public static function scan()
    {
        $allFilesAndDirectories = scandir(self::COMMANDS_PATH);

        array_shift($allFilesAndDirectories);
        array_shift($allFilesAndDirectories);

        $availableCommands = array_map(function ($value) {
            if (is_file(self::COMMANDS_PATH . $value) && preg_match(self::REGEXP, $value)) {
                preg_match(self::REGEXP, $value, $matches);

                return strtolower($matches[1]);
            }
        }, $allFilesAndDirectories);

        return $availableCommands;
    }
}