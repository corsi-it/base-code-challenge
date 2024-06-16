<?php

namespace App\Http\Controllers;

use App\Helpers\ItemsHelper;
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
            'categories' => 'array',
        ]);

        $item = Item::create($validatedData);

        $item->categories()->sync($validatedData['categories'] ?? []);

        return redirect()->route('items.index');
    }

    public function show(
        $id,
        ItemsHelper $itemsHelper
    )
    {
        $item = Item::with('categories')->findOrFail($id);
        if ($item) {
            $today = new \DateTime();
            $item->isInStock = $itemsHelper->isInStock($item, $today);
        }

        return Inertia::render('Items/Show', [
            'item' => $item,
        ]);
    }

    public function edit($id)
    {
        $item = Item::with('categories')->findOrFail($id);
        $categories = Category::all();
        return Inertia::render('Items/Edit', [
            'item'       => $item,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $validatedData = $request->validate([
            'name'       => 'required',
            'sku'        => 'required',
            'categories' => 'array',
        ]);

        $item->update($validatedData);
        $item->categories()->sync($validatedData['categories'] ?? []);

        return redirect()->route('items.index');
    }

}
