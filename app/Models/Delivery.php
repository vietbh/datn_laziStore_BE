<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['delivery_number','delivery_name','delivery_phone',
    'delivery_address','delivery_fee','delivery_note','delivery_status',
    'estimated_delivery_time','completed_at','delivered_at','order_id'];
}
