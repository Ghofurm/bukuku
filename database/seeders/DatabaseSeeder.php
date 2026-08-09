<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * Memanggil seeder pendukung secara berurutan.
     */
    public function run(): void
    {
        $this->call([
            GenreSeeder::class,
            BookSeder::class,
            UserSeder::class,
            ReviewSeder::class,
        ]);
    }
}
