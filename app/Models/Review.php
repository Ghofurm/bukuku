<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'rating',
        'comment',
    ];

    /**
     * Booted function untuk mendaftarkan Eloquent events
     * Mengupdate rating rata-rata buku setiap kali review disimpan atau dihapus
     */
    protected static function booted(): void
    {
        static::saved(function (Review $review) {
            if ($review->book) {
                $review->book->recalculateAverageRating();
            }
        });

        static::deleted(function (Review $review) {
            if ($review->book) {
                $review->book->recalculateAverageRating();
            }
        });
    }

    /**
     * Relasi Many to One: review ini ditulis oleh satu user
     * Ini kebalikan dari User::hasMany(Review::class)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi Many to One: review ini ditujukan untuk satu buku
     * Ini kebalikan dari Book::hasMany(Review::class)
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
