<?php

namespace App;


class Registry
{
    private static $htmlPageRegistry;

    private static $parsedImageUrls = [];

    private static $urlsToParse = [];

    public static function getHtmlPage()
    {
        if (self::$htmlPageRegistry) {
            return self::$htmlPageRegistry;
        }

        return false;
    }

    public static function setHtmlPage($parsedPage)
    {
        self::$htmlPageRegistry = $parsedPage;
    }

    public static function getFirstUrlToParse()
    {
        return array_shift(self::$urlsToParse);
    }

    public static function setParsedImageUrls(array $parsedImageUrls)
    {
        array_merge(self::$parsedImageUrls, $parsedImageUrls);
    }
}