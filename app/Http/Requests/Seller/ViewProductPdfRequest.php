<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;

class ViewProductPdfRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (!auth()->check()) {
            return false;
        }

        $product = $this->route('product');

        return $product
            && $product->seller_id === auth()->id();
    }


    public function rules(): array
    {
        return [];
    }
}
