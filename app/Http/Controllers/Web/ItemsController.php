<?php

namespace App\Http\Controllers\Web;

use App\Helpers\ItemsHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Inertia\Inertia;

// Make sure to use the correct model

class ItemsController extends Controller
{
    public function index(ItemsHelper $itemsHelper)
    {
        $items = Item::with('categories')->get();

        $today = new \DateTime();
        foreach ($items as $item) {
            $item->isInStock = $itemsHelper->isInStock($item, $today);
        }

        return Inertia::render('Items/Index', [
            'items' => $items,
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return Inertia::render('Items/Create', [
            'categories' => $categories,
        ]);
    }

    public function store(
        Request $request
    )
    {
        $validatedData = $request->validate([
            'name'       => 'required',
            'sku'        => 'required',
            'categories' => 'required|array',
        ]);

        $item = Item::create($validatedData);
        return redirect()->route('items.index');
    }

    public function show($id)
    {
        return Inertia::render('Items/Show', [
            'item' => Item::with('categories')->findOrFail($id),
        ]);
    }

    public function edit($id)
    {
        return Inertia::render('Items/Edit', [
            'item' => Item::findOrFail($id),
        ]);
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
