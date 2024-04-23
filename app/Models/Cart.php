<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cart extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','amount'];

    public function cartItems():HasMany
    {
        return $this->hasMany(CartItems::class,'cart_id','id');
    }

}
