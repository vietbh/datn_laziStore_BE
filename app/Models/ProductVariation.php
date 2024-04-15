<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductVariation extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['color_type','price','price_sale','quantity','quantity_available'];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function orderItem():HasOne
    {
        return $this->hasOne(OrderItems::class);
    }
}

