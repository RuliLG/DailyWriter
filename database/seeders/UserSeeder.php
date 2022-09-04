<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'user1@dailywriter.test',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'email' => 'user2@dailywriter.test',
            'password' => Hash::make('password'),
        ]);
    }
}
