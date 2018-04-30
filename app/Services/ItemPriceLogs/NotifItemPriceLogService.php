<?php

namespace App\Services\ItemPriceLogs;

use App\Models\ItemPriceLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class NotifItemPriceLogService {
    public function checkPriceUpdate($data) {
        $priceDiff = $data[0]->price - $data[1]->price;
        $priceDiscountDiff = $data[0]->price_discount - $data[1]->price_discount;
        
        // check difference price and price discount, if not 0 store data
        if ($priceDiff != 0 || $priceDiscountDiff != 0) {            
            // store to db
            $priceChangeId = $this->priceChange($data);

            // send notif to user
            $users = $this->getUserByItem($data[0]->item_id);
            $this->notifUser($users, $priceChangeId);
        }
    }

    public function priceChange($data) {
        // get id after insert
        return DB::table('price_changes')
                    ->insertGetId([
                        'item_id'               => $data[0]->item_id,
                        'price_now'             => $data[0]->price,
                        'price_prev'            => $data[1]->price,
                        'price_discount_now'    => $data[0]->price_discount,
                        'price_discount_prev'   => $data[1]->price_discount,
                        'discount_now'          => $data[0]->discount,
                        'discount_prev'         => $data[1]->discount,
                        'price_status'          => $this->checkStatus($data[0]->price, $data[1]->price),
                        'price_discount_status' => $this->checkStatus($data[0]->price_discount, $data[1]->price_discount),
                        'created_at'            => Carbon::now()
                    ]);     
    }

    public function checkStatus($now, $prev) {
        $status = '';

        if ($now > $prev) {
            $status = 'up';    
        } else if ($now < $prev) {
            $status = 'down';
        }

        return $status;
    }

    public function getUserByItem($itemId) {
        return DB::table('users as u')
                    ->join('user_items as ui', 'ui.user_id', '=', 'u.id')
                    ->where('ui.item_id', $itemId)
                    ->get();
    }

    public function notifUser($users, $priceChangeId) {
        foreach ($users as $user) {
            DB::table('notif_price_logs')
                ->insert([
                    'user_id'           => $user->user_id,
                    'price_change_id'   => $priceChangeId,
                    'created_at'        => Carbon::now()
                ]);
        }
    }
}