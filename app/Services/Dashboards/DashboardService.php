<?php

namespace App\Services\Dashboards;

use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardService {
    public function getActiveInactiveItem() {
        return DB::table('user_items as ui')
                    ->select(
                        DB::raw('count(case when i.is_active = 1 then 1 end) as active'),
                        DB::raw('count(case when i.is_active = 0 then 1 end) as inactive')
                    )
                    ->join('items as i', 'i.id', 'ui.item_id')
                    ->where('user_id', Auth::user()->id)
                    ->first();
    }

    public function getCountCategories() {
        return DB::table('user_items as ui')
                    ->select(
                        'i.category',
                        DB::raw('count(*) as total')
                    )
                    ->join('items as i', 'i.id', 'ui.item_id')
                    ->where('user_id', Auth::user()->id)
                    ->groupBy('i.category')
                    ->get();
    }
}