<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasFactory;
    protected $primaryKey ='id';
    protected $fillable = ['payment_number','payment_method','payment_status','amount','total','count_items','order_id','user_id','date_create','time_create'];
    protected $casts = [
    'status' => 'string',
    ];
    public function order(): HasOne
    {
        return $this->hasOne(Orders::class,'id','order_id');
    }
}
