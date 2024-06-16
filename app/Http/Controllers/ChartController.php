<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function userRequests(Request $request)
    {
        $request->validate([
            'dateFrom' => 'required|date',
            'dateTo'   => 'required|date',
        ]);

        $dateFrom = $request->dateFrom;
        $dateTo = $request->dateTo;

        $users = User::withCount(['stockRequests' => function ($query) use ($dateFrom, $dateTo) {
            if ($dateFrom && $dateTo) {
                $query->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59']);
            }
        }])
            ->orderBy('stock_requests_count', 'desc')
            ->take(5)
            ->get();
        // return json response
        return response()->json($users);
    }

    public function itemRequests(Request $request)
    {
        $request->validate([
            'dateFrom' => 'required|date',
            'dateTo'   => 'required|date',
        ]);

        $dateFrom = $request->dateFrom;
        $dateTo = $request->dateTo;

        $items = Item::withCount(['stockRequests' => function ($query) use ($dateFrom, $dateTo) {
            if ($dateFrom && $dateTo) {
                $query->whereBetween('created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59']);
            }
        }])
            ->orderBy('stock_requests_count', 'desc')
            ->take(5)
            ->get();

        // return json response
        return response()->json($items);
    }
}
