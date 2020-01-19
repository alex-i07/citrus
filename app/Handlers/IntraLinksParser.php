<?php

namespace App\Handlers;

use App\Registry;

class IntraLinksParser extends BaseHandler
{
    public function handle()
    {
        $dom = Registry::getHtmlPage();
        $links = $dom->getElementsByTagName('a');

        $urls = [];
        foreach ($links as $link) {
            $url = parse_url($link->getAttribute('href'), PHP_URL_HOST);
            $path = parse_url($link->getAttribute('href'), PHP_URL_PATH);
            if ($optionValue === $link->getAttribute('href')) {
            }
            if (strpos($optionValue, $url) !== false && $path !== null && $path !== '/') {
                $urls[] = implode(parse_url($link->getAttribute('href')), '');
            }
        }
        return parent::handle();
    }
}