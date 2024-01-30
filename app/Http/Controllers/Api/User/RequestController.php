<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Services\RequestService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class RequestController extends Controller
{
    use ResponseTrait;
    public function __construct(protected RequestService $requestService){}

    public function send(UserRequest $request) : JsonResponse
    {
        $data = $request->toArray();
        if(
            !$this->requestService->checkIfAvaliable(
                $request->getStartDate(),
                $request->getEndDate(),
                $request->getInventoryId()
            )
        )
        {
            return $this->errorResponse('Item is taken');
        }
        $data['user_id'] = auth()->id();
        return $this->successResponse($this->requestService->send($data), 'Item Requested Successfully');
    }

}
