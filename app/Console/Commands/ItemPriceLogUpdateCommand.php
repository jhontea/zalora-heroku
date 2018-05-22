<?php

namespace App\Console\Commands;

use App\Services\ItemPriceLogs\ItemPriceLogService;
use App\Services\ItemPriceLogs\NotifItemPriceLogService;
use App\Services\Items\ItemService;
use Illuminate\Console\Command;

class ItemPriceLogUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'price:notif';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update notification of different price';

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
        $itemPriceLogService = new ItemPriceLogService();
        $notifItemPriceLogService = new NotifItemPriceLogService();
        $itemService = new ItemService();
        
        // Display Script Start time
        $time_start = microtime(true);

        // get all items
        $items = $itemService->getAll();

        foreach ($items as $item) {
            if ($item->is_active) {
                // get 2 row of every items on price log
                $data = $itemPriceLogService->getPriceLogByIdLimit($item->id);
                
                if (count($data) > 1) {
                    // checking change of price
                    $data = $notifItemPriceLogService->checkPriceUpdate($data);
                }
            }
        }

        // Display Script End time
        $time_end = microtime(true);

        //dividing with 60 will give the execution time in minutes other wise seconds
        $execution_time = ($time_end - $time_start)/60;

        //execution time of the script
        echo 'Total Execution Time: '.$execution_time.' Mins';
    }
}
