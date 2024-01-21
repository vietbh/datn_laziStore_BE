<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['name','seo_keywords','image_url','categories_product_id','brand_id','description','show_hide'];

    public function variations(): HasMany
    {
        return $this->hasMany(ProductVariation::class);
    }}
