<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpecificationsProduct extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['name','value','position','show_hide'];

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
