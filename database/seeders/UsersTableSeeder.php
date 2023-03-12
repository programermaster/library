<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            "first_name" => "Reader",
            "last_name" => "reader last",
            "email" => "reader@admin.com",
            "password" => \Illuminate\Support\Facades\Hash::make("reader123")
        ]);
        \App\Models\User::create([
            "first_name" => "Librarian",
            "last_name" => "Librarian last",
            "email" => "librarian@admin.com",
            "password" => \Illuminate\Support\Facades\Hash::make("librarian123")
        ]);
    }
}
