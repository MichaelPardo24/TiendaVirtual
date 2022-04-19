<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'tax',
        'status',
        'image'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function sale()
    {
        return $this->hasOne(Sale::class);
    }
}
