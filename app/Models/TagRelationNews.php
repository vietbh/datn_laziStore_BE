<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TagRelationNews extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $fillable = ['news_id','tag_id'];

    public function tag():BelongsTo
    {
        return $this->belongsTo(Tag::class,'tag_id','id');
    }
    public function news():BelongsTo
    {
        return $this->belongsTo(News::class,'news_id','id');
    }
}
