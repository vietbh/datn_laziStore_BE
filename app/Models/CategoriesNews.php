<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoriesNews extends Model
{
    use HasFactory;
    protected $primaryKey="id";
    protected $fillable = ['name','slug','index','show_hide','parent_category_id'];

    public function parent() :BelongsTo
    {
        return $this->belongsTo(CategoriesNews::class,'parent_category_id','id');
    }

    public function news ():HasMany
    {
        return $this->hasMany(News::class);
    }
}
