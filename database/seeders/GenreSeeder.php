<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GenreSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk mengisi tabel genres dengan 10 genre default.
     * Kolom slug digenerate otomatis menggunakan Str::slug().
     */
    public function run(): void
    {
        $genres = [
            'Fiction',
            'Non-Fiction',
            'Fantasy',
            'Romance',
            'Mystery',
            'Biography',
            'Sci-Fi',
            'Horror',
            'History',
            'Self-Help'
        ];

        foreach ($genres as $name) {
            Genre::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
    }
}
