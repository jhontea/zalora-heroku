<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\ItemPriceLogs\ItemPriceLogService;
use App\Services\Items\ItemService;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index() {
        $itemService = new ItemService();

        $userItems = $itemService->getUserItemByPriceLog();
        return view('dashboard.item', compact('userItems'));
    }

    public function show($sku) {
        $itemPriceLogService = new ItemPriceLogService();
        $itemService = new ItemService();

        $userItems = $itemService->getFromSku($sku);
        
        if ($userItems) {
            $itemPriceLogs = $itemPriceLogService->getPriceLogById($userItems->id);
            return view('dashboard.items.show', ['data' => $userItems, 'priceLogs' => $itemPriceLogs]);
        }

        abort(404);
    }
}
