<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariation extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['color_type','price','price_sale','quantity','quantity_availible'];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}

