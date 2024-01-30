<?php

namespace App\Http\Resources\Inventory;

use App\Models\Category;
use Carbon\Carbon;
use App\Models\Request as RequestModel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $name
 * @property double $price
 * @property string $image
 * @property string $description
 * @property Category $category
 * @property RequestModel request
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $id
 */
class GetInventoryResource extends JsonResource
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
            'name' => $this->name,
            'price' => $this->price,
            'image' => $this->image,
            'description' => $this->description,
            'status' => $this->request?$this->request->status:'',
            'category' => $this->category->name,
            'created_at' => $this->created_at->toString(),
            'updated_at' => $this->updated_at->toString(),
        ];
    }
}
