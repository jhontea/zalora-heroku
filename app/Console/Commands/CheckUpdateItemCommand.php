<?php

namespace App\Console\Commands;

use App\Services\ItemPriceLogs\PriceChangeService;
use App\User;
use Illuminate\Console\Command;

class CheckUpdateItemCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check updated item for more than 7 days';

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
        $priceChangeService = new PriceChangeService();
        
        // Display Script Start time
        $time_start = microtime(true);

        $users = User::all();
        
        foreach ($users as $user) {
            $updateItems = $priceChangeService->getUserItemPriceChange($user->id, 7);
            
            // update is read = 1
            if (count($updateItems)) {
                $priceChangeService->updateReadUpdateItem($updateItems);
            }
        }
    }
}
