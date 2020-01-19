<?php

namespace App\Handlers;

use App\Registry;

class HtmlPageFetcher extends BaseHandler
{
    /**
     *
     * @return \DOMDocument
     */
    public function handle()
    {
        $data = Registry::getFirstUrlToParse();
        $pageContent = file_get_contents("http://{$data}");

        $dom = new \DOMDocument;
        @$dom->loadHTML($pageContent);

        Registry::setHtmlPage($dom);

        return parent::handle($dom);
    }
}