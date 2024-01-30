<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\Inventory\GetInventoryResource;
use Illuminate\Support\Facades\Storage;
use App\Models\Inventory;

class InventoryService
{
    public function getInventory() : AnonymousResourceCollection
    {
        $inventory = Inventory::with(['category','request'])->get();
        return GetInventoryResource::collection($inventory);
    }
    public function create(array $data) : GetInventoryResource
    {
       $inventory = Inventory::create($data);
       return new GetInventoryResource($inventory);
    }
    public function update(array $data, int $id) : int
    {
        return Inventory::where('id', $id)->update($data);
    }
    public function saveImage($image) : string
    {
        $storage = Storage::disk("images")->put('',$image);
        return '/assets/images/cars/'.$storage;
    }
    public function getByCategoryId(int $categoryId) : array
    {
        return [];
    }

    public function deleteInventory(int $id) : int
    {
        $inventory = Inventory::where('id', $id);
        Storage::disk('images')->delete($inventory->first()->image);
        return $inventory->delete();
    }

}
