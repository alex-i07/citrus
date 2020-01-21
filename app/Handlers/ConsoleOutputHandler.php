<?php

namespace App\Handlers;

use App\Registry;

class ConsoleOutputHandler extends BaseHandler
{
    /**
     * @return bool
     */
    public function handle()
    {
        echo str_pad('target URL', 100, ' ', STR_PAD_RIGHT) . '|' .
            str_pad('images number', 100, ' ', STR_PAD_RIGHT) . PHP_EOL;

        foreach (Registry::getParsedImageUrls() as $key => $urls) {

            echo str_pad($key, 100, ' ' ) . '|' . count($urls). PHP_EOL;
        }

        return true;
    }
}