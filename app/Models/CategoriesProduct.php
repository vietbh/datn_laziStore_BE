<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoriesProduct extends Model
{
    use HasFactory;
    protected $primaryKey="id";
    protected $fillable = ['name','slug','position','show_hide','parent_category_id'];
    public function products() :HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function specis() :HasMany
    {
        return $this->hasMany(Specification::class,'categories_product_id','id');
    }
    public function parent() : BelongsTo
    {
        return $this->belongsTo(CategoriesProduct::class,'parent_category_id','id');
    }
    public function children(): HasMany
    {
        return $this->hasMany(CategoriesProduct::class, 'parent_category_id', 'id');
    }
    
}
