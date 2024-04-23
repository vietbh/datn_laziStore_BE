<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CartItems extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['cart_id','product_id','quantity'];

    public function cart():BelongsTo
    {
        return $this->BelongsTo(Cart::class,'cart_id','id');
    }
    public function productVariation():HasOne
    {
        return $this->hasOne(ProductVariation::class,'id','product_id');
    }
}
