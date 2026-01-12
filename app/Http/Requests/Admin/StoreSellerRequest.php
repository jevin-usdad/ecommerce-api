<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreSellerRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Allow only admin users
        return auth()->check() && auth()->user()->role->name === 'admin';
    }

    public function rules(): array
    {
        return [
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|min:6',
            'mobile_no'  => 'nullable|string|max:20',
            'country'    => 'nullable|string|max:100',
            'state'      => 'nullable|string|max:100',
            'skills'     => 'nullable|array',
            'skills.*'   => 'exists:skills,id',
        ];
    }
}
