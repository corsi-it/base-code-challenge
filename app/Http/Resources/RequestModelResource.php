<?php

namespace App\Http\Resources;

use App\Models\Inventory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property string $status
 * @property User $user
 * @property Inventory $inventory
 * @property int $id
 */
class RequestModelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
            'user' => $this->user,
            'inventory' => $this->inventory,
        ];
    }
}
