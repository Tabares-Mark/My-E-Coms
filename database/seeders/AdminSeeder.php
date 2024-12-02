<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'Ian@gmail.com.com'], // Check if the admin already exists
            [
                'name' => 'Ian Tabares',
                'password' => Hash::make('IanIanIan'), // Hash the password
                'role' => 'admin', // Add 'role' if your table has this field
            ]
        );
        
    }
}
