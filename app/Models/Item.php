<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
    ];

    public function stockRequests()
    {
        return $this->hasMany(StockRequest::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_item');
    }

}
