<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Orders extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['order_number', 'full_name', 'phone_number', 'address', 'note', 'amount', 'count_items', 'total', 'user_id', 'date_create', 'time_create'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class,'order_id','id');
    }
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItems::class,'order_id','id');
    }
    public function getCountItemsAttribute()
    {
        return $this->orderItems()->sum('quantity');
    }
    public function getAmountItemsAttribute()
    {
        return $this->orderItems()->sum('amount');
    }

    public function getTotalItemsAttribute()
    {
        return $this->getAmountItemsAttribute();
    }
}