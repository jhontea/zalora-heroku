<?php

namespace App\Console\Commands;

use App\Services\Items\ItemNewScrapeService;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class NewItemCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'item:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get daily new item link';

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
        $itemNewScrapeService = new ItemNewScrapeService();
        $url = 'https://www.zalora.co.id/women/baju-muslim/all-products/?sort=latest%20arrival&csa=shopwomenmuslimwear';

        // get all items link
        $itemsLink = $itemNewScrapeService->scrapeLinks($url);

        dd($itemsLink);
    }
}
