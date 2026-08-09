<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bookshelf extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'status',
    ];

    /**
     * Relasi Many to One: data rak buku ini dimiliki oleh satu user
     * Ini kebalikan dari User::hasMany(Bookshelf::class)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi Many to One: data rak buku ini merujuk ke satu buku
     * Ini kebalikan dari Book::hasMany(Bookshelf::class)
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
