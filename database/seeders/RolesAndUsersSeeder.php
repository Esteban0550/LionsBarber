<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class RolesAndUsersSeeder extends Seeder
{
    public function run()
    {
        // admin
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin12345'),
                'role_id' => Role::where('name', 'admin')->first()->id
            ]
        );

        // staff
        User::firstOrCreate(
            ['email' => 'staff@demo.com'],
            [
                'name' => 'Empleado Staff',
                'password' => Hash::make('12345678'),
                'role_id' => Role::where('name', 'staff')->first()->id
            ]
        );

        // client
        User::firstOrCreate(
            ['email' => 'client@demo.com'],
            [
                'name' => 'Cliente Demo',
                'password' => Hash::make('12345678'),
                'role_id' => Role::where('name', 'client')->first()->id
            ]
        );
    }
}
