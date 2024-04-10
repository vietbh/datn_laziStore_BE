<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlideAds extends Model
{
    use HasFactory;
    protected $primaryKey ='id';
    protected $fillable = ['title','content','image_url','image_path','link','position','show_hide'];
}
