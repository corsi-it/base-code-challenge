<?php

namespace App\Http\Controllers;

use App\Enums\StockRequestStatusEnum;
use App\Helpers\ItemsHelper;
use App\Helpers\StockRequestsHelper;
use App\Http\Requests\StoreStockRequest;
use App\Models\Item;
use App\Models\StockRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

// Make sure to use the correct model

class StockRequestsController extends Controller
{
    public function index()
    {
        $qb = StockRequest::with('item')
            ->with('requestedBy');
//            ->get();

        if (auth()->user()->role->name !== 'admin') {
            $qb->where('requested_by', auth()->user()->id);
        }

        $stockRequests = $qb->get();

        return Inertia::render('StockRequests/Index', [
            'stockRequests' => $stockRequests,
        ]);
    }

    public function create()
    {
        $items = Item::with('categories')->get();
        $categories = $items->pluck('categories')->flatten()->unique();
        return Inertia::render('StockRequests/Create', [
            'items'      => $items,
            'categories' => $categories,
        ]);
    }

    public function store(
        StoreStockRequest   $request,
        StockRequestsHelper $stockRequestsHelper,
        ItemsHelper         $itemsHelper
    )
    {
        $validatedData = $request->validated();

        $currentUser = auth()->user();
        $validatedData['requested_by'] = $currentUser->id;
        $validatedData['status'] = StockRequestStatusEnum::PENDING;
        if ($validatedData['requestType'] == 'sell' && $validatedData['quantity'] > 0) {
            $validatedData['quantity'] = $validatedData['quantity'] * -1;
        }

        $stockRequest = StockRequest::create($validatedData);
        return redirect()->route('stockRequests.index');
    }

    public function show(int $id)
    {
        $stockRequest = StockRequest::with('item')
            ->with('requestedBy')
            ->findOrFail($id);
        return Inertia::render('StockRequests/Show', [
            'stockRequest' => $stockRequest,
        ]);
    }

    public function edit(int $id)
    {
        $stockRequest = StockRequest::with('item')
            ->with('requestedBy')
            ->findOrFail($id);
        return Inertia::render('StockRequests/Edit', [
            'stockRequest' => $stockRequest,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $stockRequest = StockRequest::findOrFail($id);
        $validatedData = $request->validate([
            'status' => 'required',
        ]);

        $stockRequest->update(['status' => $validatedData['status']]);
        return redirect()->route('stockRequests.index');
    }

}
