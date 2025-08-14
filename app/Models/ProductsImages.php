<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsImages extends Model
{
    /** @use HasFactory<\Database\Factories\ProductsImagesFactory> */
    use HasFactory;

    public function products()
    {
        return $this->belongsTo(products::class);
    }

    protected $fillable = [
        'name',
        'products_id'
    ];
}
