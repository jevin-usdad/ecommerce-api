<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'seller_id',
        'product_name',
        'product_description',
    ];

    /**
     * Product belongs to a Seller (User)
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }

    /**
     * Product has many Brands
     */
    public function brands()
    {
        return $this->hasMany(Brand::class, 'product_id', 'id');
    }
}
