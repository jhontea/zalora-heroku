<?php

namespace App\Jobs;

use App\Services\ItemPriceLogs\ItemPriceLogService;
use App\Services\Items\ItemScrapeService;
use App\Services\Items\ItemService;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Log;

class CheckFailedPriceLog implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $item;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($item)
    {
        $this->item = $item;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Initiation service
        $itemPriceLogService = new ItemPriceLogService();
        $itemService = new ItemService();
        $itemScrapeService = new ItemScrapeService();

        $dataScrape = $itemScrapeService->doGetScrape($this->item->url);

        if ($dataScrape) {
            // store data success
            $dataScrape['id'] = $this->item->id;
            // $itemPriceLogService->store($dataScrape);
        } else {
            // update item to inactive
            $itemService->setInactive($this->item->id);
        }
    }
}
