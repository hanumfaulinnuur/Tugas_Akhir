<?php

namespace Database\Seeders;

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
        $admin = User::create([
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('12345678'),
            ]);
        
        $kepalasekolah = User::create([
                'name' => 'kepala sekolah',
                'email' => 'kepala@example.com',
                'password' => bcrypt('12345678'),
            ]);
    }
}
