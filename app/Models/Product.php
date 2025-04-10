<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'category',
        'category_id',
        'quantity',
        'price',
        'discount_price'
    ];

    public function categoryRelation()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    protected static function booted()
    {
        static::saving(function ($product) {
            if ($product->category_id && empty($product->category)) {
                $product->category = $product->categoryRelation->category_name;
            }
        });
    }
}