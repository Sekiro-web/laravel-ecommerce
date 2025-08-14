<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    /** @use HasFactory<\Database\Factories\ProductsFactory> */
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductsImages::class);
    }

    public function firstImage()
    {
        return $this->hasOne(ProductsImages::class, 'products_id')->orderBy('created_at');
    }

    protected $fillable = [
        'name',
        'price',
        'quantity',
        'description',
        'imgpath',
        'category_id'
    ];
}
