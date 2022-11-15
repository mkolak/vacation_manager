<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => "Matej",
            'email' => "matej@email.com",
            'password' => bcrypt('password'),
            'role' => 'employee',
            'remaining_vacation_days' => 20
        ]);
        User::create([
            'name' => "Slavko",
            'email' => "slavko@email.com",
            'password' => bcrypt('password'),
            'role' => 'approver',
        ]);
        User::create([
            'name' => "Mirko",
            'email' => "mirko@email.com",
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
    }
}
