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
        $categories = $itemService->getCategoriesByUserItem($userItems);

        return view('dashboard.item', compact('userItems', 'categories'));
    }

    public function filter()
    {
        $itemService = new ItemService();

        $input = request()->all();
        $category = isset($input['category'])? $input['category']: '';
        $sorting = isset($input['sorting'])? $input['sorting']: '';

        $userItems = $itemService->getUserItemFilter($category, $sorting);
        
        return view('dashboard.items.item-ajax', compact('userItems'));
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
