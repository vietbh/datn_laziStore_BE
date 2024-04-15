<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingProviders extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $fillable = ['name','address','phone_number','email','website'
    ,'operating_areas','shipping_policies','shipping_cost'];
    
}
