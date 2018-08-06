<?php

namespace App\Services\Items;

use App\Services\Items\ItemService;
use App\Traits\ScraperTrait;

class ItemScrapeService {
    use ScraperTrait;

    /* 
     * Css style
     * Using XPath
     */
    protected $style = [
        'sku'               => '//*[@id="configSku"]',
        'brand'             => '//*[@id="product-box"]/div/div[1]/section/div[1]/div[2]/div/div[1]/h1/div[1]/a',
        'title'             => '//*[@id="product-box"]/div/div[1]/section/div[1]/div[2]/div/div[1]/h1/div[2]',
        'price'             => '//*[@id="js-price"]',
        'price_discount'    => '//*[@id="priceAndEd"]/div/div[2]/span/span[1]',
        'image_link'        => '//*[@id="prdImage"]',
        'data-active'       => '//*[@id="active-segments-roots"]'
    ];

    public function getItemScrape($url) {
        $itemService = new ItemService();
        $data = $itemService->hasItem($url);

        # check from db
        # if url is on db, do not scrape, just get data from db
        if ($data) {
            return $this->doGetDataFromDB($data);
        } 
        
        // do scrape data
        return $this->doGetScrape($url);
    }

    public function doGetDataFromDB($data) {
        return \Session::put('item-data', $data->toArray());;
    }

    public function doGetScrape($url) {
        // get DOM element
        try {
            $scrape = $this->getScrape($url);

            if ($scrape) {
                $price = $scrape->filterXpath($this->style['price'])->count()?
                            preg_replace('/\D/', "", $scrape->filterXpath($this->style['price'])->text()) : '';

                // Filter DOM using xpath style
                $result = [
                    'url'               => $url,
                    'sku'               => $scrape->filterXpath($this->style['sku'])->attr('value'),
                    'brand'             => $scrape->filterXpath($this->style['brand'])->text(),
                    'title'             => $scrape->filterXpath($this->style['title'])->text(),
                    'price'             => $price,
                    'price_discount'    => $scrape->filterXpath($this->style['price_discount'])->count()?
                                            preg_replace('/\D/', "", $scrape->filterXpath($this->style['price_discount'])->text()) :
                                            $price,
                    'image_link'        => $scrape->filterXpath($this->style['image_link'])->attr('src'),
                    'segment'           => str_replace('/', '', $scrape->filterXpath($this->style['data-active'])
                                            ->attr('data-active-segment')),
                    'category'          => $scrape->filterXpath($this->style['data-active'])->attr('data-active-root')
                ];

                $result['discount'] = $result['price_discount']?
                                        round(($result['price'] - $result['price_discount']) / $result['price'] * 100) : 0;

                \Session::put('item-data', $result);
                return $result;
            } 
            return 0;
        } catch (\Exception $err) {
            return 0;
        }
    }
}