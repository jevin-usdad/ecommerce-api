<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();

        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'     => 'System Admin',
                'role_id'  => $adminRole->id,
                'password' => Hash::make('admin@123')
            ]
        );
    }
}
