<?php

namespace App;


class OutputFormatter
{
    /**
     * @param array $result
     */
    public static function output(array $result)
    {
        foreach ($result as $key => $value) {
            echo str_pad($key, 100, '=', STR_PAD_BOTH) . "\n";
            foreach ($value as $k => $v) {
                echo (string)($k + 1) . "." . "\t" . str_pad($v, 90, " ", STR_PAD_RIGHT) . "\n" .
                    str_pad(' ', 90, '-', STR_PAD_RIGHT) . "\n";
            }
        }
    }
}