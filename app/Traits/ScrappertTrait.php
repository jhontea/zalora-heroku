<?php
namespace App\Traits;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

trait ScraperTrait
{
    /*
    |--------------------------------------------------------------------------
    | Scaper Trait
    |--------------------------------------------------------------------------
    |
    | This controller handle data from front-end style website. If error happen,
    | check the style from website if anything changed from the original page.
    |
    */
    /**
     * Scrape data
     * 
     * @param string $url url where website scrape
     */
    public function getScrape($url) {
        try {
            //check URL
            $html = $this->checkUrl($url);
            if (!$html) {
                return 0;
            }

            return new Crawler($html);;
        } catch (Exception $err) {
            Log::error("[SCRAPE-TRAIT][GET-SCRAPE][{$url}] {$err->getMessage()}");
            return 0;
        }
    }

    public function checkUrl($url)
    {
        $client = new Client();
    
        try {
            $request = $client->get($url)->getBody()->getContents();
            return $request;
        } catch (Exception $e) {
            if ($e->getCode() == 404) {
                //url is gone
                session()->put('errorURL', 'URL not available');
                session()->put('errorCode', 404);
            } else {
                if (array_key_exists('Host', $e->getRequest()->getHeaders())) {
                    //check connection
                    session()->put('errorURL', 'Time has running out. Please check the connection');
                    session()->put('errorCode', 504);
                } else {
                    //url must be using http or https
                    session()->put('errorURL', 'Must be a valid URL.');
                    session()->put('errorCode', 500);
                }
            }
        }

        return 0;
    }
}