<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi One to Many: satu user punya banyak review
     * Ini kebalikan dari Review::belongsTo(User::class)
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Relasi One to Many: satu user punya banyak data di rak buku (bookshelf)
     * Ini kebalikan dari Bookshelf::belongsTo(User::class)
     */
    public function bookshelves(): HasMany
    {
        return $this->hasMany(Bookshelf::class);
    }

    /**
     * Method helper untuk memeriksa apakah user memiliki role admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
