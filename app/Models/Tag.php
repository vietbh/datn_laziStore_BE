<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id';
    protected $fillable = ['name','position','show_hide'];

    public function tagRelaNews():HasMany
    {
        return $this->hasMany(TagRelationNews::class,'tag_id','id');
    }
}
