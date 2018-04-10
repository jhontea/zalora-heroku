<?php

namespace App\Services\Items;

use App\Services\Items\ItemService;
use App\Traits\ScraperTrait;

use Carbon\Carbon;
use DB;

class ItemNewScrapeService {
    use ScraperTrait;

    private $newCount = 0;
    private $existCount = 0;

    public function scrapeLinks() {

        for ($page = 1; $page < 120; $page++) {
            try {
                $url = 'https://www.zalora.co.id/women/baju-muslim/semua-produk/?gender=women&dir=desc&sort=latest%20arrival&category_id=856&page='.$page.'&csa=shopwomenmuslimwear';
                $pageError = [];
                
                // get DOM element
                $scrape = $this->checkUrl($url);
                $script = preg_match('/"docs":\[{(.*)\]},"facet_counts":/siU', $scrape, $matchesScript);

                if ($script) {
                    $splitItem = explode('"meta":', $matchesScript[1]);
                    unset($splitItem[0]);
                    echo $page;
                    $this->createLink($splitItem);
                } else {
                    $page--;
                    break;
                }
                
            } catch (Exception $err) {
                if ($err->getCode() == 404) {
                    //url is gone
                    session()->put('errorURL', 'URL not available');
                } else {
                    if (array_key_exists('Host', $err->getRequest()->getHeaders())) {
                        //check connection
                        session()->put('errorURL', 'Time has running out. Please check the connection');
                    } else {
                        //url must be using http or https
                        session()->put('errorURL', 'Must be a valid URL.');
                    }
                }
                $pageError[] = $page;
            }
            // sleep(3);
        }

        return [
            'newCount' => $this->newCount,
            'existCount' => $this->existCount,
            'pageError' => $pageError
        ];
    }

    public function createLink($splitItem)
    {
        foreach ($splitItem as $key => $value) {
            preg_match('/"link":"(.*)","image":/siU', $value, $matchesLink);

            // check exist item
            $exist = $this->checkDataExist("https://www.zalora.co.id/".$matchesLink[1]);

            if ($exist) {
                // echo ($matchesLink[1]." is exist\n");
                $this->existCount++;
            } else {
                // store to db
                // echo ($matchesLink[1]." save to database\n");
                DB::table('link_items')
                        ->insert([
                            'url'           => "https://www.zalora.co.id/".$matchesLink[1],
                            'created_at'    => Carbon::now()
                        ]);
                $this->newCount++;
            }

            // new page start from count split item - 5
            if ($key == count($splitItem) - 5) {
                break;
            }
        }
    }
    
    public function checkDataExist($url)
    {
        //exist data
        $existItem = DB::table('items')->where('url', $url)->exists();
        $existLinkItem = DB::table('link_items')->where('url', $url)->exists();
        dd($existItem);
        return ($existItem || $existLinkItem);
    }
}