<?php

namespace App\Handlers;

use App\Registry;

class ImagesSourcesParser extends BaseHandler
{
    /**
     * @return null
     */
    public function handle()
    {
        $dom = Registry::getHtmlPage();
        $images = $dom->getElementsByTagName('img');

        $imageSources = [];
        foreach ($images as $image) {
            $imageSources[] = $image->getAttribute('src');
        }

        Registry::setParsedImageUrls($imageSources);

        parent::setNext(new IntraLinksParser());

        return parent::handle();
    }
}