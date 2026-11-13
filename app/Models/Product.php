<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'price', 'stock'];

    // Satu produk milik satu kategori
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
