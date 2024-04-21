<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailUser extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['full_name','phone_number','address','set_default','google_map','user_id'];
    
}
