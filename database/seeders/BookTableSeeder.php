<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Book::create([
            "title" => "Drugi Ajnstajn",
            "description" => "opis opis",
            "book_number" => "12345",
            "author_id" => 1
        ]);

        \App\Models\Book::create([
            "title" => "Ziveti poput monaha",
            "description" => "opis1 opis1",
            "book_number" => "54321",
            "author_id" => 2
        ]);


    }
}
