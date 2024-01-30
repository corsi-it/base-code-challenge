<?php

namespace App\Http\Controllers\Api\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\AddItemRequest;
use App\Http\Requests\Inventory\DeleteInventoryRequest;
use App\Http\Requests\Inventory\UpdateItemRequest;
use App\Services\InventoryService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    use ResponseTrait;
    public function __construct(
        protected InventoryService $inventoryService
    ){}

    public function create(AddItemRequest $request) : JsonResponse
    {
        $image = $this->inventoryService->saveImage($request->file('image'));
        $data = $request->toArray();
        $data['image'] = $image;
        $this->inventoryService->create($data);
        return $this->successResponse($data);
    }
    public function update(UpdateItemRequest $request) : JsonResponse
    {
        $data = $request->toArray();
        if(is_file($request->getImage())){
            $image = $this->inventoryService->saveImage($request->file('image'));
            $data['image'] = $image;
        }
        $this->inventoryService->update($data, $request->getId());
        return $this->successResponse($data);
    }
    public function delete(DeleteInventoryRequest $request) : JsonResponse
    {
        $this->inventoryService->deleteInventory($request->getId());
        return $this->successResponse('Successfully deleted!');
    }
}
