<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Specification extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['name','categories_product_id'];

    public function category():BelongsTo
    {
        return $this->belongsTo(CategoriesProduct::class,'categories_product_id','id');
    }
}
