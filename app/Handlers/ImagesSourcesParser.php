<?php

namespace App\Handlers;

use App\Registry;

class ImagesSourcesParser extends BaseHandler
{
    public function handle()
    {
        $dom = Registry::getHtmlPage();
        $images = $dom->getElementsByTagName('img');

        $imageSources = [];
        foreach ($images as $image) {
            $imageSources[] = $image->getAttribute('src');
//            $imageSources[] = implode(parse_url($image->getAttribute('src')), '');
        }

        Registry::setParsedImageUrls($imageSources);

        return parent::handle();
    }
}