<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes;

    protected $table = 'brands';

    protected $fillable = [
        'product_id',
        'brand_name',
        'detail',
        'image',
        'price',
    ];

    /**
     * Brand belongs to a Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
