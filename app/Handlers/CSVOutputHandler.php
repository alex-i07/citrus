<?php

namespace App\Handlers;

use App\Registry;

class CSVOutputHandler extends BaseHandler
{
    public function handle()
    {
        if (($scanResults = fopen(Registry::SCAN_RESULTS, 'w')) !== false) {
            foreach (Registry::getParsedImageUrls() as $key => $urls) {
                $mediator = [];
                $mediator[] = $key;
                $mediator[] = count($urls);

                fputcsv($scanResults, ['target URL', 'images number'], '|');
                fputcsv($scanResults, $mediator, '|');

                fputcsv($scanResults, [str_pad('images sources', 50, '=', STR_PAD_BOTH)]);
                fputcsv($scanResults, $urls, PHP_EOL);
            }
        }

        fclose($scanResults);

        echo(getcwd() . DIRECTORY_SEPARATOR . Registry::SCAN_RESULTS . PHP_EOL);

        return true;
    }
}