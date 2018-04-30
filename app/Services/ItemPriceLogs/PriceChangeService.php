<?php

namespace App\Services\ItemPriceLogs;

use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PriceChangeService {
    public function getUserItemPriceChange() {
        return DB::table('notif_price_logs as npl')
                    ->select('i.brand', 'i.title', 'i.image_link', 'pc.price_now', 'pc.price_prev', 'pc.price_discount_now', 'pc.price_discount_prev', 'pc.discount_now', 'pc.discount_prev', 'npl.created_at', 'pc.price_status', 'pc.price_discount_status')
                    ->join('price_changes as pc', 'pc.id', '=', 'npl.price_change_id')
                    ->join('items as i', 'i.id', '=', 'pc.item_id')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('npl.created_at', 'desc')
                    ->get();
    }
}