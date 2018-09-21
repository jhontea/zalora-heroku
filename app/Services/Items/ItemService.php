<?php

namespace App\Services\Items;

use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ItemService {
    public function getAll() {
        return DB::table('items')->get();
    }

    public function getFromSku($sku) {
        return DB::table('items')->where('sku', $sku)->first();
    }

    public function store ($data) {
        try {
            if ($this->userHasItem($data['url'])) {
                // check if user already has the item
                $response = [
                    'message' => request()->get('title') . ' - ' . request()->get('brand') . ' has already saved by you',
                    'alert'   => 'warning',
                    'icon'    => 'ti-na',
                    'status'  => 200
                ];
            } else {
                // if not, store to db
                $response = [
                    'message' => 'Success save ' . request()->get('title') . ' - ' . request()->get('brand') . ' to DB',
                    'alert'   => 'success',
                    'icon'    => 'ti-face-smile',
                    'status'  => 200
                ];

                $this->doStore($data);
            }
            
            return $response;
        } catch (\Exception $err) {
            $response = [
                'message' => $err->getMessage(),
                'alert'   => 'danger',
                'icon'    => 'ti-face-sad',
                'status'  => 500
            ];

            return $response;
        }
    }

    // check for duplicate data
    public function hasItem($url) {
        return Item::where('url', $url)->first();
    }

    // check for user has the item
    public function userHasItem($url) {
        return DB::table('users as u')
                    ->join('user_items as ui', 'ui.user_id', '=', 'u.id')
                    ->join('items as i', 'ui.item_id', '=', 'i.id')
                    ->where('u.id', \Auth::user()->id)
                    ->where('i.url', $url)
                    ->first();
    }

    // store item to db
    public function doStore($data) {
        $item = $this->hasItem($data['url']);
        // if item not in db, create new item
        if (!$item) {
            $item = Item::create($data);

            // store for first price log
            DB::table('item_price_logs')
                ->insert([
                    'item_id'           => $item->id,
                    'price'             => $item->price,
                    'price_discount'    => $item->price_discount,
                    'discount'          => $item->discount,
                    'created_at'        => Carbon::now()
                ]);
        }
        
        // store to pivot table
        DB::table('user_items')
            ->insert([
                'user_id'       => \Auth::user()->id,
                'item_id'       => $item->id,
                'created_at'    => Carbon::now()
            ]);
    }

    // Get all user items
    public function getUserItems() {
        return DB::table('users as u')
                    ->select('i.sku', 'i.image_link', 'i.discount', 'i.title', 'i.brand', 'i.price', 'i.price_discount', 'i.is_active')
                    ->join('user_items as ui', 'ui.user_id', '=', 'u.id')
                    ->join('items as i', 'ui.item_id', '=', 'i.id')
                    ->where('u.id', \Auth::user()->id)
                    ->orderBy('i.is_active', 'desc')
                    ->orderBy('i.created_at', 'desc')
                    ->get();
    }

    /**
     * getUserItemByPriceLog
     *
     * @return void
     */
    public function getUserItemByPriceLog() {
        return \Cache::remember('user-item-'.\Auth::user()->id, 24*60, function () {
            return DB::table('item_price_logs as ipl')
                        ->select('i.sku', 'i.image_link', 'ipl.discount', 'i.title', 'i.brand', 'ipl.price', 'ipl.price_discount', 'i.is_active', 'i.category')
                        ->join('user_items as ui', 'ui.item_id', '=', 'ipl.item_id')
                        ->join('items as i', 'i.id', '=', 'ipl.item_id')
                        ->where('user_id', \Auth::user()->id)
                        ->whereRaw('ipl.id IN (SELECT MAX(id) FROM item_price_logs GROUP BY item_id)')
                        ->orderBy('i.is_active', 'desc')
                        ->orderBy('i.created_at', 'desc')
                        ->paginate(20);
        });
    }

    public function getUserItemFilter($category, $sorting) {
        $model = DB::table('item_price_logs as ipl')
                ->select('i.sku', 'i.image_link', 'ipl.discount', 'i.title', 'i.brand', 'ipl.price', 'ipl.price_discount', 'i.is_active', 'i.category')
                ->join('user_items as ui', 'ui.item_id', '=', 'ipl.item_id')
                ->join('items as i', 'i.id', '=', 'ipl.item_id')
                ->where('user_id', \Auth::user()->id)
                ->whereRaw('ipl.id IN (SELECT MAX(id) FROM item_price_logs GROUP BY item_id)');

        if ($category) $model->where('i.category', $category);
        if ($sorting) $model->orderBy('ipl.discount', $sorting);
                
        return $model->orderBy('i.is_active', 'desc')
                ->orderBy('i.created_at', 'desc')
                ->paginate(20);
    }

    public function getCategoriesByUserItem($items)
    {
        $categories = [];

        foreach ($items as $item) {
            if (array_key_exists($item->category, $categories)) {

            } else {
                $categoryName = implode(" ", explode("-", $item->category));
                $categories[$item->category] = ucwords($categoryName);
            }
        }

        return $categories;
    } 

    public function setInactive($id) {
        return DB::table('items')
                    ->where('id', $id)
                    ->update([
                        'is_active'     => 0,
                        'updated_at'    => Carbon::now()
                    ]);
    }
}