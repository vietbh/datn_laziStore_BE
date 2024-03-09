<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagRelationNews extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $fillable = ['news_id','tag_id'];
}
