<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Abel',
            'last_name' => 'Mutua',
            'mobile' => '07000000000',
            'username' => 'amutua',
            'email' => 'amutua@gmail.com',
            'password' => Hash::make('Password@2030.'),
            'status' => 'activated',
        ]);

        // Get the "Administrator" role
        $adminRole = Role::where('name', 'Administrator')->first();

        // Assign the role to the user
        $user = User::where('email', 'amutua@gmail.com')->first();
        $user->assignRole($adminRole);
    }
}
