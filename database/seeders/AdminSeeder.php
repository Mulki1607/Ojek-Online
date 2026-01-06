<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::updateOrCreate(
            [
                // UNIQUE KEY
                'email' => 'admin@ojol.test',
            ],
            [
                'name'     => 'Super Admin',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}