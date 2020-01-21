<?php

namespace App;


class Registry
{
    /**
     * Regular expression for console option parsing.
     */
    public const OPTION_PARSER_REG_EXP = "/^--(url|domain)=(http:\/\/|https:\/\/|.+)$/";

    /**
     * Regular expression for console option value parsing.
     */
    public const OPTION_VALUE_PARSER_REG_EXP = "/^(https?:\/\/)?(www\.)?([^\/]+)\/?.*$/";

    /**
     * CSV file name.
     */
    public const SCAN_RESULTS = 'scan_results.csv';
    /**
     * @var \DOMDocument
     */
    private static $htmlPageRegistry;

    /**
     * @var array
     */
    private static $parsedImageUrls = [];

    /**
     * @var array
     */
    private static $urlsToParse = [];

    /**
     * @var array
     */
    private static $alreadyParsedUrls = [];

    /**
     * @var
     */
    private static $domainName;

    /**
     * @var string
     */
    private static $currentParsedUrl;

    /**
     * @var string
     */
    private static $outputType;

    /**
     * Returns instance of \DOMDocument
     * which represents fetched html page.
     *
     * @return bool
     */
    public static function getHtmlPage()
    {
        if (self::$htmlPageRegistry) {
            return self::$htmlPageRegistry;
        }

        return false;
    }

    /**
     * Fill htmlPageRegistry static property with
     * \DOMDocument data.
     *
     * @param \DOMDocument $parsedPage
     */
    public static function setHtmlPage(\DOMDocument $parsedPage)
    {
        self::$htmlPageRegistry = $parsedPage;
    }

    /**
     * Get first url for parsing from $urlsToParse
     * static property. Urls are stored as keys of
     * associative array not to allow duplicates.
     *
     * @return mixed
     */
    public static function getFirstUrlToParse()
    {
        $url = array_keys(self::$urlsToParse);
        self::$currentParsedUrl = array_shift($url);

        return self::$currentParsedUrl;
    }

    /**
     * Removes first url from $urlsToParse, push it
     * to $alreadyParsedUrls and erase currentParsedUrl.
     */
    public static function removeFirstUrl()
    {
        $urls = array_keys(self::$urlsToParse);
        self::$alreadyParsedUrls[] = array_shift($urls);
        array_shift(self::$urlsToParse);
        self::$currentParsedUrl = null;
    }

    /**
     * Moves urls that was not parsed into
     * $urlsToParse static property.
     *
     * @param array $urls
     */
    public static function setUrlsToParse(array $urls)
    {
        $difference = array_diff($urls, self::$alreadyParsedUrls);

        if (!empty($difference)) {

            self::$urlsToParse = array_merge(self::$urlsToParse, array_flip($difference));
        }
    }

    /**
     * Returns image sources.
     *
     * @return array
     */
    public static function getParsedImageUrls()
    {
        return self::$parsedImageUrls;
    }

    /**
     * Creates array with key equal to current url and values is array
     * of images sources and merge it with $parsedImageUrls static property.
     *
     * @param array $parsedImageUrls
     */
    public static function setParsedImageUrls(array $parsedImageUrls)
    {
        self::$parsedImageUrls = array_merge(self::$parsedImageUrls, [self::$currentParsedUrl => $parsedImageUrls]);
    }

    /**
     * Gets domain name of the site
     * that is currently parsed.
     *
     * @return bool
     */
    public static function getDomainName()
    {
        if (self::$domainName) {
            return self::$domainName;
        }

        return false;
    }

    /**
     * Sets domain name of the site.
     *
     * @param string $domainName
     */
    public static function setDomainName(string $domainName)
    {
        self::$domainName = $domainName;
    }

    /**
     * This method determines if there is more
     * urls left for parsing.
     * @return bool
     */
    public static function urlToParsePresence(): bool
    {
        if (!empty(self::$urlsToParse)) {
            return true;
        }

        return false;
    }

    /**
     * Gets output type: console or csv.
     * @return mixed
     */
    public static function getOutputType()
    {
        return self::$outputType;
    }

    /**
     * Sets output type: console or csv.
     * @param string $type
     */
    public static function setOutputType(string $type)
    {
        self::$outputType = $type;
    }
}