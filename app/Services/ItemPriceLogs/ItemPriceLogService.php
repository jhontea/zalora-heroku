<?php

namespace App\Services\ItemPriceLogs;

use App\Models\ItemPriceLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ItemPriceLogService {
    public function getPriceLogById($itemId) {
        return DB::table('item_price_logs')
                    ->where('item_id', $itemId)
                    ->get();
    }

    // Store item price log
    public function store($item) {
        return DB::table('item_price_logs')
                ->insert([
                    'item_id'           => $item['id'],
                    'price'             => $item['price'],
                    'price_discount'    => $item['price_discount'],
                    'discount'          => $item['discount'],
                    'created_at'        => Carbon::now()
                ]);
    }

    // Store item price log failed
    public function storeFailed($itemId) {
        return DB::table('item_price_logs_failed')
                ->insert([
                    'item_id'           => $itemId,
                    'created_at'        => Carbon::now()
                ]);
    }
}