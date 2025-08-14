<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['zeyad', 'sheko', 'ogaga'];
        $roles = ['owner', 'admin', 'user'];
        foreach (array_map(null, $names, $roles) as [$name, $role]) {
            User::factory()->create([
                'name' => $name,
                'email' => $name . '@gmail.com',
                'email_verified_at' => null,
                'password' => Hash::make('ss123456'),
                'role' => $role,
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
