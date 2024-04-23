<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderItems extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['quantity','price','order_id','product_id','amount'];
    protected $with =['order'];
    public function order():BelongsTo
    {
        return $this->belongsTo(Orders::class,'order_id','id');
    }
    public function productVariation():HasOne
    {
        return $this->hasOne(ProductVariation::class,'id','product_id');
    }
    
}
