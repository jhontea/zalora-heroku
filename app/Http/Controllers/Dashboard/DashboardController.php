<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Items\ItemService;
use App\Services\Dashboards\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $itemService = new ItemService();
        $dashboardService = new DashboardService();

        $actIn = $dashboardService->getActiveInactiveItem();
        $countCategories = $dashboardService->getCountCategories();
        $userItems = $itemService->getUserItems();
        return view('dashboard.index', compact('userItems', 'actIn', 'countCategories'));
    }

    public function user() {
        $user = \Auth::user();
        return view('dashboard.user', compact('user'));
    }

    public function scrape() {
        $user = \Auth::user();
        $data = \Session::has('item-data')? \Session::pull('item-data') : '';
        return view('dashboard.scrape', compact('user', 'data'));
    }
}
