<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role->name === 'seller';
    }

    public function rules(): array
    {
        return [
            'product_name'        => 'required|string|max:255',
            'product_description'=> 'nullable|string',

            'brands'              => 'required|array|min:1',

            'brands.*.brand_name' => 'required|string|max:255',
            'brands.*.detail'     => 'nullable|string',
            'brands.*.price'      => 'required|numeric|min:0',
            'brands.*.image'      => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ];
    }
}
