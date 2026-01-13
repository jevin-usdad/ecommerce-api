<?php

namespace App\Http\Controllers\Seller;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\StoreProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $products = Product::with('brands')
            ->where('seller_id', auth()->id())
            ->latest()
            ->paginate($perPage);

        return response()->json([
            'message' => 'Product list fetched successfully',
            'data'    => $products
        ]);
    }

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

    public function destroy(Product $product)
    {
        if ($product->seller_id !== auth()->id()) {
            return response()->json([
                'message' => 'Unauthorized action'
            ], 403);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }


}
