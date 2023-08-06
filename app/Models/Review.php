<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static select(string $string)
 */
class Review extends Model
{
    use HasFactory;

    public $timestamps = ['created_at']; //Use only created_at column
    const UPDATED_AT = null; //and updated_by default null set

    protected $fillable = [
        'comment',
        'stars',
        'reviewed_user',
    ];
}
