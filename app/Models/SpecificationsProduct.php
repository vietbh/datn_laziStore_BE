<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpecificationsProduct extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['value','position','type_speci','speci_id','product_id','rep_speci_product_id','show_hide'];
    // protected $with = ['type_speci','speci_id'];

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function speci():BelongsTo
    {
        return $this->belongsTo(Specification::class,'speci_id','id');
    }
}
