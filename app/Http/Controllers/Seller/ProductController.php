<?php

namespace App\Http\Controllers\Seller;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\StoreProductRequest;

class ProductController extends Controller
{
    public function store(StoreProductRequest $request)
    {
        $product = Product::create([
            'seller_id' => auth()->id(),
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
        ]);

        foreach ($request->brands as $brand) {
            $product->brands()->create($brand);
        }

        return response()->json(['message' => 'Product created'], 201);
    }
}
