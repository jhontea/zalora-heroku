<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Items\ItemScrapeService;
use App\Services\Items\ItemService;
use Illuminate\Http\Request;

class ScrapeItemController extends Controller
{
    protected $itemScrapeService;

    public function __construct(ItemScrapeService $itemScrapeService) {
        $this->itemScrapeService = $itemScrapeService;
    }

    public function scrape() {
        $this->itemScrapeService->getItemScrape(request()->url);
        return redirect('dashboard/scrape#scrape');
    }

    public function store() {
        $itemService = new ItemService();
        $result = $itemService->store(request()->except('_token'));
        return response()->json($result, $result['status']);
        
    }
}
