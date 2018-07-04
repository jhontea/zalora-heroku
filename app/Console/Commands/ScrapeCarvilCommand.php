<?php

namespace App\Console\Commands;

use App\Services\Items\ItemScrapeService;
use Illuminate\Console\Command;

class ScrapeCarvilCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:carvil';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape product zalora by brand';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $itemScrapeService = new ItemScrapeService();

        // scrap brand carvil
        $url = 'https://www.zalora.co.id/carvil/';
        $result = $itemScrapeService->brandScrape($url);
        dd($result);
    }
}
