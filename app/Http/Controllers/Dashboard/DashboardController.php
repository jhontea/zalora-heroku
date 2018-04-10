<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Items\ItemService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $itemService = new ItemService();

        $userItems = $itemService->getUserItems();
        return view('dashboard.index', compact('userItems'));
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
