<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'quantity',
        'status',
        'start_date',
        'end_date',
        'requested_by',
        'approved_by',
        'approved_at',
        'rejected_by',
        'rejected_at',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function rejectedBy()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }
}
