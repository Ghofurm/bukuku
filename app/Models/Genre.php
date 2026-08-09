<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Genre extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Relasi One to Many: satu genre mempunyai banyak buku
     * Ini kebalikan dari Book::belongsTo(Genre::class)
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
