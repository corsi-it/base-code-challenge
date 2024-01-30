<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $status
 * @method static create(array $data)
 * @method static where(string $string, int $inventory_id)
 * @method static get()
 */
class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'user_id',
        'inventory_id',
        'start_date',
        'end_date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class,'inventory_id','id');
    }
}
