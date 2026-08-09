<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'description',
        'cover_image',
        'genre_id',
        'published_year',
        'isbn',
        'average_rating',
    ];

    /**
     * Relasi Many to One: sebuah buku termasuk dalam satu genre
     * Ini kebalikan dari Genre::hasMany(Book::class)
     */
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    /**
     * Relasi One to Many: sebuah buku memiliki banyak review
     * Ini kebalikan dari Review::belongsTo(Book::class)
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Relasi One to Many: sebuah buku dapat berada di banyak rak buku (bookshelf) user
     * Ini kebalikan dari Bookshelf::belongsTo(Book::class)
     */
    public function bookshelves(): HasMany
    {
        return $this->hasMany(Bookshelf::class);
    }

    /**
     * Method untuk menghitung ulang rating rata-rata dari semua review buku ini
     */
    public function recalculateAverageRating(): void
    {
        $average = $this->reviews()->avg('rating') ?? 0;
        $this->update([
            'average_rating' => $average,
        ]);
    }
}
