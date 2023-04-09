<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'approved',
        'images',
        'user_id',
        'category_id'
    ];

    protected $casts = [
        'approved' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
