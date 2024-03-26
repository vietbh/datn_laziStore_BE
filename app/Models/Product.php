<?php

namespace App\Models;

use App\Http\Controllers\productSpecificationController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['name','seo_keywords','image_url','categories_product_id','brand_id','description','show_hide'];

    public function variations(): HasMany
    {
        return $this->hasMany(ProductVariation::class);
    }
    public function specifications(): HasMany
    {
        return $this->hasMany(SpecificationsProduct::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoriesProduct::class,'categories_product_id','id');
    }
}
