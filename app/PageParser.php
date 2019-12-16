<?php

namespace App;


class PageParser
{
    /**
     * @param $optionValue
     *
     * @return array
     */
    public static function parsePage($optionValue)
    {
        $pageContent = file_get_contents("http://{$optionValue}");

        $dom = new \DOMDocument;
        @$dom->loadHTML($pageContent);

        $images = $dom->getElementsByTagName('img');

        $imageSources = [];
        foreach ($images as $image) {
            $imageSources[] = implode(parse_url($image->getAttribute('src')), '');
        }

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

        $result = [$optionValue => $imageSources, 'urls' => $urls];

        return $result;
    }
}