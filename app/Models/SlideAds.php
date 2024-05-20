<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlideAds extends Model
{
    use HasFactory;
    protected $primaryKey ='id';
    protected $fillable = ['title','content','image_url','image_path','link','position','slide_now','slide_status','start_date','end_date','show_hide'];
}
