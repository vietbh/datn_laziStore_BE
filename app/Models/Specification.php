<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Specification extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['name','categories_product_id'];

    public function category():BelongsTo
    {
        return $this->belongsTo(CategoriesProduct::class,'categories_product_id','id');
    }
    
    public function specisProduct():HasMany
    {
        return $this->hasMany(SpecificationsProduct::class,'speci_id','id');
    }
}
