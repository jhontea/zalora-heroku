<?php

namespace App\Console\Commands;

use App\Jobs\CheckFailedPriceLog;
use App\Services\ItemPriceLogs\ItemPriceLogService;
use App\Services\Items\ItemScrapeService;
use App\Services\Items\ItemService;
use Illuminate\Console\Command;
use Log;
use Mail;

class PriceLogCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'price:log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape for price log daily';

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
        // Initiation service
        $itemPriceLogService = new ItemPriceLogService();
        $itemService = new ItemService();
        $itemScrapeService = new ItemScrapeService();

        $result = [];
        $success = [];
        $failed = [];

        // get all items
        $items = $itemService->getAll();

        foreach ($items as $key => $item) {
            if ($item->is_active) {
                // get data from scrape item
                $dataScrape = $itemScrapeService->doGetScrape($item->url);

                if ($dataScrape) {
                    // store data success
                    $dataScrape['id'] = $item->id;
                    $itemPriceLogService->store($dataScrape);
                    $success[] = $dataScrape;
                } else {
                    // store data failed
                    // it can be caused by in active item on zalora website
                    $failed[] = $item;
                    CheckFailedPriceLog::dispatch($item);
                    $itemPriceLogService->storeFailed($item->id);
                }

                // for preventing robot detection
                if ($key % 10 == 0) sleep(1);
            }
        }

        $this->info('success');
        print_r($success);
        $this->alert('failed');
        print_r($failed);
    }
}
