<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSellerRequest;

class SellerController extends Controller
{
    public function store(StoreSellerRequest $request)
    {
        $sellerRole = Role::where('name', 'seller')->first();

        $seller = User::create([
            'role_id'  => $sellerRole->id,
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'mobile_no' => $request->mobile_no,
            'country'  => $request->country,
            'state'    => $request->state,
        ]);

        if ($request->skills) {
            $seller->skills()->sync($request->skills);
        }

        return response()->json(['message' => 'Seller created'], 201);
    }
}
