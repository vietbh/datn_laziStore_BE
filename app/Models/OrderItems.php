<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItems extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['quantity','price','order_id','product_id'];
    protected $with =['order'];
    public function order():BelongsTo
    {
        return $this->belongsTo(Orders::class,'order_id','id');
    }
}
