<?php

namespace App\Handlers;

use App\Registry;

class IntraLinksParser extends BaseHandler
{
    /**
     * @return null
     */
    public function handle()
    {
        $dom = Registry::getHtmlPage();
        $links = $dom->getElementsByTagName('a');

        $urls = [];
        foreach ($links as $link) {
            $host = parse_url($link->getAttribute('href'), PHP_URL_HOST);
            $path = parse_url($link->getAttribute('href'), PHP_URL_PATH);

            if (($host === null && $path !== null && $path !== '/' && strpos($path, '#') === false) ||
                (strpos(Registry::getDomainName(), $host) !== false && $path !== null && $path !== '/')
            ) {

                if ($host === null) {
                    $urls[] = 'http://' . Registry::getDomainName() . $link->getAttribute('href');
                } else {

                    $urls[] = $link->getAttribute('href');
                }
            }
        }

        Registry::removeFirstUrl();

        Registry::setUrlsToParse($urls);

        if (Registry::urlToParsePresence()) {

            parent::setNext(new HtmlPageFetcher());

            return parent::handle();
        }

        if (Registry::getOutputType() === 'csv') {

            parent::setNext(new CSVOutputHandler());

        } else {
            parent::setNext(new ConsoleOutputHandler());
        }

        return parent::handle();
    }
}