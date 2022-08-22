<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator Web',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
            'level' => 'admin',
        ]);
    }
}
