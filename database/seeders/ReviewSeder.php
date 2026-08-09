<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ReviewSeder extends Seeder
{
    /**
     * Jalankan seeder untuk membuat 60 data review acak.
     * Mengaitkan user secara acak dengan buku secara acak, dan memberikan rating 1-5.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $userIds = User::where('role', 'user')->pluck('id')->toArray();
        $bookIds = Book::pluck('id')->toArray();

        for ($i = 0; $i < 60; $i++) {
            Review::create([
                'user_id' => $faker->randomElement($userIds),
                'book_id' => $faker->randomElement($bookIds),
                'rating' => $faker->numberBetween(1, 5),
                'comment' => $faker->optional(0.8)->paragraph, // 80% kemungkinan ada komentar
            ]);
        }
    }
}
