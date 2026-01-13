<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSellerRequest;

class SellerController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $sellers = User::with('skills')
            ->whereHas('role', function ($query) {
                $query->where('name', 'seller');
            })
            ->latest()
            ->paginate($perPage);

        return response()->json([
            'message' => 'Seller list fetched successfully',
            'data'    => $sellers
        ]);
    }

    public function store(StoreSellerRequest $request)
    {
        $sellerRole = Role::where('name', 'seller')->firstOrFail();

        $seller = User::create([
            'role_id'   => $sellerRole->id,
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'mobile_no' => $request->mobile_no,
            'country'   => $request->country,
            'state'     => $request->state,
        ]);

        if ($request->filled('skills')) {
            $skillIds = collect($request->skills)
                ->map(fn($name) => Skill::firstOrCreate(['name' => $name])->id)
                ->toArray();

            $seller->skills()->sync($skillIds);
        }

        return response()->json([
            'message' => 'Seller created successfully',
            'id' => $seller->id,
        ], 201);
    }
}
