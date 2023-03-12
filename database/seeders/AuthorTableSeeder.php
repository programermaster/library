<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Author::create([
            "first_name" => "Meri",
            "last_name" => "Benedikt",
        ]);

        \App\Models\Author::create([
            "first_name" => "Jay ",
            "last_name" => "Shetty",
        ]);

    }
}
