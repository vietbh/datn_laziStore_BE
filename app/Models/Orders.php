<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Orders extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = ['order_number', 'full_name', 'phone_number', 'address', 'amount', 'note', 'total', 'user_id', 'date_create', 'time_create'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItems::class,'order_id','id');
    }
    public function getCountItemsAttribute()
    {
        return $this->orderItems()->count();
    }
    public function getAmountItemsAttribute()
    {
        return $this->orderItems()->sum('price');
    }

    public function getTotalItemsAttribute()
    {
        // $initial = 0;
        return $this->getAmountItemsAttribute();
    }
}