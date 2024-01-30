<?php

namespace App\Services;

use App\Http\Resources\RequestModelResource;
use App\Models\Request;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;

class RequestService
{
    public function getRequests() : AnonymousResourceCollection
    {
        $data = Request::with(['user','inventory'])->get();
        return RequestModelResource::collection($data);
    }

    public function send(array $data) : RequestModelResource
    {
        $request = Request::create($data);
        return new RequestModelResource($request);
    }

    public function setStatus(int $id, string $status) : int
    {
        Log::info($id);
        return Request::where('id', $id)->update([
            'status' => $status
        ]);
    }

    public function checkIfAvaliable(Carbon $start_date, Carbon $end_date, int $inventory_id) : Bool
    {
        $data = Request::where('inventory_id',$inventory_id)
            ->whereRaw("'$start_date' BETWEEN start_date AND end_date AND status='accepted' ")
            ->orWhereRaw("'$end_date' BETWEEN start_date AND end_date AND status='accepted'");
        return $data->count() === 0;
    }
}
