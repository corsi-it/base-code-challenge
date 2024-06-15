<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ItemsHelper;
use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

// Make sure to use the correct model

class ItemsController extends Controller
{
    public function index(ItemsHelper $itemsHelper)
    {
        $items = Item::all();

        // TODO: Implement day change
        $today = new \DateTime();

        foreach ($items as $item) {
            $item->isInStock = $itemsHelper->isInStock($item, $today);
        }

        return response()->json($items);
    }

    public function store(Request $request)
    {
        $item = Item::create($request->all());
        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = Item::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
