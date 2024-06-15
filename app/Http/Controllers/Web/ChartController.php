<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function userRequests(Request $request)
    {
        $users = User::withCount('stockRequests')
            ->orderBy('stock_requests_count', 'desc')
            ->take(5)
            ->get();

        // return json response
        return response()->json($users);
    }

    public function itemRequests(Request $request)
    {
        $items = Item::withCount('stockRequests')
            ->orderBy('stock_requests_count', 'desc')
            ->take(5)
            ->get();

        // return json response
        return response()->json($items);
    }
}
