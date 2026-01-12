<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role->name === 'seller';
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'brand_name' => 'required|string|max:255',
            'detail'     => 'nullable|string',
            'price'      => 'required|numeric|min:0',
            'image'      => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ];
    }
}
