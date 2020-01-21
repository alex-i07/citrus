<?php

namespace App\Handlers;

use App\Registry;

class HtmlPageFetcher extends BaseHandler
{
    /**
     * @return null
     *
     * @throws \Exception
     */
    public function handle()
    {
        $pageContent = @file_get_contents(Registry::getFirstUrlToParse());

        $dom = new \DOMDocument;
        @$dom->loadHTML($pageContent);

        Registry::setHtmlPage($dom);

        parent::setNext(new ImagesSourcesParser());

        return parent::handle($dom);
    }
}