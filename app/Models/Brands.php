<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['name','slug','country','show_hide'];
}

