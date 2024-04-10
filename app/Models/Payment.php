<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $primaryKey ='id';
    protected $fillable = ['payment_number','payment_method','amount','total','count_items','order_id','user_id','date_create','time_create'];
    protected $casts = [
    'status' => 'enum',
];
}
