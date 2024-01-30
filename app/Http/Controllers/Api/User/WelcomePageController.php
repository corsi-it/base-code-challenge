<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\GetInvetoryByCategoryRequest;
use App\Services\InventoryService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class WelcomePageController extends Controller
{
    //
    use ResponseTrait;
    public function __construct(protected InventoryService $inventoryService){}

    public function welcomePage()  : JsonResponse
    {
        $cars = $this->inventoryService->getInventory();
        return $this->successResponse($cars);
    }

    public function getCarsByCategoryId(GetInvetoryByCategoryRequest $request) : JsonResponse
    {
        $cars = $this->inventoryService->getByCategoryId($request->getCategoryId());
        return $this->successResponse($cars, 'Cars Fetched Successfully');
    }
}
