<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Team;
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
        Team::factory(5)->create();
        \App\Models\User::factory(25)->create();

        foreach (Team::pluck('id') as $value) {
            User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => bcrypt("password"),
                'role' => 'approver',
                'approver_role' => 'team_leader',
                'team_id' => $value,
            ]);

            User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => bcrypt("password"),
                'role' => 'approver',
                'approver_role' => 'project_leader',
                'team_id' => $value,
            ]);
        }

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
