<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BookSeder extends Seeder
{
    /**
     * Jalankan seeder untuk membuat 30 data buku dummy.
     * Menggunakan Faker untuk data dummy dan mengambil random genre yang sudah ada.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $genreIds = Genre::pluck('id')->toArray();

        for ($i = 1; $i <= 30; $i++) {
            Book::create([
                'title' => $faker->sentence(3),
                'author' => $faker->name,
                'description' => $faker->paragraph,
                'cover_image' => "https://picsum.photos/seed/{$i}/300/450",
                'genre_id' => $faker->randomElement($genreIds),
                'published_year' => $faker->numberBetween(1990, 2026),
                'isbn' => $faker->isbn13,
                'average_rating' => 0.00, // rating awal, akan diupdate oleh ReviewSeeder
            ]);
        }
    }
}
