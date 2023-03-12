<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\UserRole::create([
            'user_id' => 1,
            'role_id' => 1
        ]);

        \App\Models\UserRole::create([
            'user_id' => 2,
            'role_id' => 2
        ]);
    }
}
