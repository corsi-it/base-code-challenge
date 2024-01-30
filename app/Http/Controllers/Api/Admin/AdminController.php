<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StatusRequest;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\RequestModelResource;
use App\Services\RequestService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminController extends Controller
{
    use ResponseTrait;
    public function __construct(protected RequestService $requestService){}

    public function getUserRequests() : AnonymousResourceCollection
    {
        $data = $this->requestService->getRequests();
        return RequestModelResource::collection($data);
    }
    public function setStatus(StatusRequest $request) : JsonResponse
    {
        $data = $this->requestService->setStatus($request->getId(), $request->getStatus());
        return $this->successResponse($data);
    }
}
