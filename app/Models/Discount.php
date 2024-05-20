<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['discount_code','discount_price','discount_total','used_discount','end_date','show_hide','discount_now','discount_status'];
}
