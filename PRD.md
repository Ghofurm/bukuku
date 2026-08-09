# PRD — Bukuku (Remake Goodreads.com dengan Laravel)

## 1. Latar Belakang & Tujuan

Bukuku adalah website review buku bergaya Goodreads.com, dibangun dengan Laravel sebagai proyek
latihan setelah mempelajari dasar Laravel: migration, controller, middleware, resource route,
layouting, dan seeding.

Dokumen ini adalah instruksi implementasi untuk AI model yang akan menuliskan kode. Tujuannya:
AI mengimplementasikan fitur inti secara efisien (hemat token), sementara pengerjaan yang sifatnya
konfigurasi lokal/sekali jalan dilakukan manual oleh developer (pemilik proyek).

**Prinsip pembagian kerja:**

- **[MANUAL]** = dikerjakan oleh developer sendiri di terminal/editor, tidak perlu AI generate kode.
- **[AI]** = diminta ke AI untuk digenerate/ditulis, karena butuh logika/kode spesifik.

---

## 2. Tech Stack

- Laravel (versi terbaru stabil, install via `composer create-project laravel/laravel bukuku`) — **[MANUAL]**
- Blade sebagai templating engine
- MySQL untuk database — **[MANUAL]** buat database kosong (`CREATE DATABASE bukuku;`), sesuaikan `.env`
- **Tidak menggunakan CSS framework** pada tahap ini. Semua view cukup HTML polos (semantic HTML).
  Styling dikerjakan di sesi AI terpisah setelah semua fungsi berjalan.
- **Tidak menggunakan Laravel Breeze.** Autentikasi dibangun custom dari nol (lihat Bagian 4).
- Eloquent ORM untuk relasi antar tabel.

---

## 3. Struktur Data (Database)

### 3.1 Migration

#### A. Command yang dijalankan developer — **[MANUAL]**

Jalankan langkah-langkah berikut di terminal **sebelum** `php artisan migrate`:

**Langkah 1 — Hapus migration bawaan Laravel yang tidak diperlukan:**

```
database/migrations/0001_01_01_000001_create_cache_table.php
database/migrations/0001_01_01_000002_create_jobs_table.php
```

> File `0001_01_01_000000_create_users_table.php` **JANGAN dihapus** — akan diedit di Langkah 2.

**Langkah 2 — Edit file `create_users_table` yang sudah ada:**
Buka `database/migrations/0001_01_01_000000_create_users_table.php`, ganti seluruh isi method
`up()` dan `down()` dengan kode dari Bagian 3.1.B di bawah. Tidak perlu kolom `email_verified_at`
atau `remember_token` karena tidak menggunakan Breeze.

**Langkah 3 — Buat file migration baru (satu per satu):**

```bash
php artisan make:migration create_genres_table
php artisan make:migration create_books_table
php artisan make:migration create_reviews_table
php artisan make:migration create_bookshelves_table
```

**Langkah 4 — Salin kode dari Bagian 3.1.B ke masing-masing file yang baru dibuat.**

**Langkah 5 — Jalankan migration:**

```bash
php artisan migrate
```

---

#### B. Kode migration (sudah diisi oleh AI, tinggal salin) — **[AI]**

---

**File: `create_users_table` (edit yang sudah ada)**

```php
public function up(): void
{
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password'); // disimpan plain text untuk keperluan dev
        $table->enum('role', ['user', 'admin'])->default('user');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('users');
}
```

---

**File: `create_genres_table`**

```php
public function up(): void
{
    Schema::create('genres', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('slug')->unique();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('genres');
}
```

---

**File: `create_books_table`**

```php
public function up(): void
{
    Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('author');
        $table->text('description')->nullable();
        $table->string('cover_image')->nullable();
        $table->foreignId('genre_id')->constrained()->onDelete('cascade');
        $table->integer('published_year')->nullable();
        $table->string('isbn')->nullable();
        $table->decimal('average_rating', 3, 2)->default(0);
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('books');
}
```

---

**File: `create_reviews_table`**

```php
public function up(): void
{
    Schema::create('reviews', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('book_id')->constrained()->onDelete('cascade');
        $table->integer('rating'); // nilai 1–5
        $table->text('comment')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('reviews');
}
```

---

**File: `create_bookshelves_table`**

```php
public function up(): void
{
    Schema::create('bookshelves', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('book_id')->constrained()->onDelete('cascade');
        $table->enum('status', ['want_to_read', 'reading', 'read']);
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('bookshelves');
}
```

---

### 3.2 Model & Relasi — **[AI]**

**[MANUAL]** Buat file model dengan perintah berikut:

```bash
php artisan make:model Genre
php artisan make:model Book
php artisan make:model Review
php artisan make:model Bookshelf
```

> Model `User` sudah ada bawaan Laravel, tidak perlu dibuat ulang.

**[AI]** Isi kode relasi di masing-masing model:

| Model       | Relasi & Method                                                                                  |
| ----------- | ------------------------------------------------------------------------------------------------ |
| `Book`      | `belongsTo(Genre)`, `hasMany(Review)`, `hasMany(Bookshelf)`, method `recalculateAverageRating()` |
| `Genre`     | `hasMany(Book)`                                                                                  |
| `Review`    | `belongsTo(User)`, `belongsTo(Book)`                                                             |
| `User`      | `hasMany(Review)`, `hasMany(Bookshelf)`, method `isAdmin(): bool`                                |
| `Bookshelf` | `belongsTo(User)`, `belongsTo(Book)`                                                             |

Tambahkan `$fillable` di setiap model sesuai kolom tabel masing-masing.

**Method `recalculateAverageRating()`** di model `Book`: hitung ulang `average_rating` dari rata-rata
semua review yang ada, lalu simpan. Panggil method ini dari model `Review` via Eloquent boot event
`saved` dan `deleted`, sehingga rating otomatis ter-update setiap kali review ditambah atau dihapus.

---

### 3.3 Seeder — **[AI]**

> Password **tetap di-hash** menggunakan `Hash::make()` saat disimpan ke database (seperti
> normalnya). Yang berbeda: **user tidak di-generate dengan Faker** — semua akun user ditulis
> hardcode di seeder, sehingga developer bisa melihat email dan password tiap akun langsung
> dari kode `UserSeeder.php` tanpa perlu membuka database.

**[MANUAL]** Buat file seeder:

```bash
php artisan make:seeder GenreSeeder
php artisan make:seeder BookSeeder
php artisan make:seeder UserSeeder
php artisan make:seeder ReviewSeeder
```

**[AI]** Isi kode masing-masing seeder:

- **`GenreSeeder`**: insert 10 genre — Fiction, Non-Fiction, Fantasy, Romance, Mystery, Biography,
  Sci-Fi, Horror, History, Self-Help. Kolom `slug` diisi dengan `Str::slug($name)`.

- **`BookSeeder`**: generate 30 buku dummy dengan Faker. Cover image gunakan URL placeholder:
  `"https://picsum.photos/seed/{$i}/300/450"`.

- **`UserSeeder`**: tulis **hardcode** (tidak pakai Faker), 1 admin + 8 user. Password di-hash
  dengan `Hash::make()` tapi nilainya tertulis eksplisit di kode sehingga developer tahu
  password apa yang harus dipakai. Gunakan format array seperti ini:

    ```php
    use Illuminate\Support\Facades\Hash;

    $users = [
        ['name' => 'Admin Bukuku',   'email' => 'admin@bukuku.test', 'password' => Hash::make('password'),  'role' => 'admin'],
        ['name' => 'Budi Santoso',   'email' => 'budi@test.com',     'password' => Hash::make('budi123'),   'role' => 'user'],
        ['name' => 'Siti Rahayu',    'email' => 'siti@test.com',     'password' => Hash::make('siti123'),   'role' => 'user'],
        ['name' => 'Ahmad Fauzi',    'email' => 'ahmad@test.com',    'password' => Hash::make('ahmad123'),  'role' => 'user'],
        ['name' => 'Dewi Lestari',   'email' => 'dewi@test.com',     'password' => Hash::make('dewi123'),   'role' => 'user'],
        ['name' => 'Rizky Pratama',  'email' => 'rizky@test.com',    'password' => Hash::make('rizky123'),  'role' => 'user'],
        ['name' => 'Nurul Hidayah',  'email' => 'nurul@test.com',    'password' => Hash::make('nurul123'),  'role' => 'user'],
        ['name' => 'Fajar Wijaya',   'email' => 'fajar@test.com',    'password' => Hash::make('fajar123'),  'role' => 'user'],
        ['name' => 'Rina Anggraini', 'email' => 'rina@test.com',     'password' => Hash::make('rina123'),   'role' => 'user'],
    ];
    ```

    AI boleh mengganti nama/email selama tetap natural dan mudah diingat. Pola passwordnya
    bebas, yang penting terlihat jelas di kode (contoh: `namauser123`).

- **`ReviewSeeder`**: generate 60 review acak dari user dummy ke buku acak, rating antara 1–5.

**[AI]** Daftarkan seeder di `DatabaseSeeder.php` dengan urutan:

```
GenreSeeder → BookSeeder → UserSeeder → ReviewSeeder
```

**[MANUAL]** Jalankan seeder:

```bash
php artisan db:seed
```

---

### 3.4 ERD — **[MANUAL]**

Salin kode DBML di bawah ke [dbdiagram.io](https://dbdiagram.io) untuk melihat visualisasi relasi:

```dbml
Table users {
  id bigint [pk, increment]
  name varchar
  email varchar [unique]
  password varchar
  role enum('user', 'admin') [default: 'user']
  created_at timestamp
  updated_at timestamp
}

Table genres {
  id bigint [pk, increment]
  name varchar
  slug varchar [unique]
  created_at timestamp
  updated_at timestamp
}

Table books {
  id bigint [pk, increment]
  title varchar
  author varchar
  description text
  cover_image varchar
  genre_id bigint [ref: > genres.id]
  published_year int
  isbn varchar [null]
  average_rating decimal
  created_at timestamp
  updated_at timestamp
}

Table reviews {
  id bigint [pk, increment]
  user_id bigint [ref: > users.id]
  book_id bigint [ref: > books.id]
  rating int
  comment text
  created_at timestamp
  updated_at timestamp
}

Table bookshelves {
  id bigint [pk, increment]
  user_id bigint [ref: > users.id]
  book_id bigint [ref: > books.id]
  status enum('want_to_read', 'reading', 'read')
  created_at timestamp
  updated_at timestamp
}
```

---

## 4. Autentikasi Custom & Middleware

> **Tidak menggunakan Laravel Breeze.** Sistem login dibangun sendiri menggunakan session Laravel
> agar developer memahami alur autentikasi dari nol.

### 4.1 Cara Kerja Autentikasi

| Fitur              | Mekanisme                                                                                                                |
| ------------------ | ------------------------------------------------------------------------------------------------------------------------ |
| **Login**          | Cari user by email → verifikasi dengan `Hash::check($request->password, $user->password)` → simpan ke session jika cocok |
| **Session**        | Simpan `user_id`, `user_role`, `user_name` ke session saat login                                                         |
| **Logout**         | `session()->flush()` → redirect ke `/login`                                                                              |
| **Ganti Password** | Verifikasi email + password lama → update kolom `password` dengan password baru (plain text)                             |

### 4.2 File yang Dibuat

**[MANUAL]** Jalankan perintah berikut:

```bash
php artisan make:controller AuthController
php artisan make:middleware CheckLogin
php artisan make:middleware CheckAdmin
```

**[AI]** Isi `AuthController` dengan method:

- `showLogin()` — return view form login
- `login(Request $request)` — validasi email+password, simpan ke session, redirect ke `/`
- `logout()` — flush session, redirect ke `/login`
- `showChangePassword()` — return view form ganti password (hanya untuk user yang sudah login)
- `changePassword(Request $request)` — verifikasi email + password lama, update password baru,
  redirect kembali dengan pesan sukses

**[AI]** Isi `CheckLogin` middleware:

```
Cek apakah session('user_id') ada.
  → Jika TIDAK ada: redirect ke '/login' dengan flash message 'Silakan login terlebih dahulu.'
  → Jika ADA: load $user = User::find(session('user_id'))
              share ke semua view via View::share('authUser', $user)
              lanjutkan request
```

**[AI]** Isi `CheckAdmin` middleware:

```
Cek apakah session('user_role') === 'admin'.
  → Jika BUKAN admin: redirect ke '/' dengan flash message 'Akses ditolak.'
  → Jika admin: lanjutkan request
```

### 4.3 Registrasi Alias Middleware — **[AI]**

Daftarkan alias berikut agar bisa dipakai di `routes/web.php`:

**Laravel 11+ (`bootstrap/app.php`):**

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'check.login' => \App\Http\Middleware\CheckLogin::class,
        'check.admin' => \App\Http\Middleware\CheckAdmin::class,
    ]);
})
```

**Laravel 10 (`app/Http/Kernel.php`):**

```php
protected $middlewareAliases = [
    // ... alias bawaan laravel ...
    'check.login' => \App\Http\Middleware\CheckLogin::class,
    'check.admin' => \App\Http\Middleware\CheckAdmin::class,
];
```

### 4.4 Aturan Bisnis

- Halaman daftar buku & detail buku → **boleh diakses tanpa login**
- Menulis review, rating, menambah ke rak → **wajib login** (middleware `check.login`)
- Semua route `/admin/*` → **wajib login + role admin** (middleware `check.login`, `check.admin`)
- User biasa yang mencoba akses `/admin/*` → redirect ke `/` dengan pesan error
- User belum login yang mencoba aksi auth → redirect ke `/login` dengan pesan error

---

## 5. Routing — **[AI]**

File: `routes/web.php`

```php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookshelfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminBookController;
use App\Http\Controllers\Admin\AdminGenreController;
use App\Http\Controllers\Admin\AdminUserController;

// ── Auth (tidak butuh login) ──────────────────────────────────────────────────
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ── Ganti password (butuh login) ─────────────────────────────────────────────
Route::middleware('check.login')->group(function () {
    Route::get('/change-password', [AuthController::class, 'showChangePassword'])
        ->name('change-password');
    Route::post('/change-password', [AuthController::class, 'changePassword'])
        ->name('change-password.submit');
});

// ── Halaman publik (tanpa login) ──────────────────────────────────────────────
Route::get('/', [BookController::class, 'index'])->name('home');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
Route::get('/genres/{genre}', [GenreController::class, 'show'])->name('genres.show');

// ── Butuh login ───────────────────────────────────────────────────────────────
Route::middleware('check.login')->group(function () {
    // Profil user & rak buku
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    // Review (store / update / destroy)
    Route::resource('reviews', ReviewController::class)->only(['store', 'update', 'destroy']);

    // Rak buku (tambah / hapus / ganti status)
    Route::post('/books/{book}/shelf', [BookshelfController::class, 'store'])
        ->name('bookshelf.store');
    Route::delete('/books/{book}/shelf', [BookshelfController::class, 'destroy'])
        ->name('bookshelf.destroy');
});

// ── Admin only ────────────────────────────────────────────────────────────────
Route::middleware(['check.login', 'check.admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');
        Route::resource('books', AdminBookController::class);
        Route::resource('genres', AdminGenreController::class);
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])
            ->name('users.destroy');
    });
```

---

## 6. Fitur & Halaman

> ⚠️ **Semua view dibuat sebagai HTML polos tanpa CSS apapun** (tidak ada Bootstrap, Tailwind,
> stylesheet, atau `<style>` tag). Gunakan elemen HTML semantik (`<h1>`, `<ul>`, `<form>`,
> `<table>`, `<a>`, `<button>`, dll.). Tujuannya sistem bisa berjalan dan diuji terlebih dahulu.
> **Styling akan dikerjakan oleh AI di sesi terpisah.**

### 6.1 Halaman Publik (tanpa login) — **[AI]**

- **Home (`/`)**: daftar semua buku (judul, author, rating rata-rata, gambar cover), filter per
  genre via query string `?genre_id=`, search judul via `?search=` (query builder `where LIKE`).
- **Detail Buku (`/books/{book}`)**: cover, deskripsi, author, genre, tahun terbit, ISBN,
  rating rata-rata, daftar semua review. Tombol "Tulis Review" dan "Tambah ke Rak" — jika belum
  login tampilkan link ke `/login`.
- **Per Genre (`/genres/{genre}`)**: daftar buku dalam satu genre tertentu.

### 6.2 Fitur User (login) — **[AI]**

- Form tulis review (rating 1–5 + komentar teks) di halaman detail buku, submit via POST.
- Tombol edit & hapus review, hanya tampil jika `$review->user_id === session('user_id')`.
- Tombol tambah ke rak buku (want_to_read / reading / read) di halaman detail buku.
- **Halaman Profil (`/profile`)**: tampilkan nama user, email, dan daftar rak buku miliknya
  (dikelompokkan per status: sedang dibaca, ingin dibaca, selesai dibaca).
- **Halaman Ganti Password (`/change-password`)**: form dengan field email, password lama,
  password baru, konfirmasi password baru.

### 6.3 Dashboard Admin — **[AI]**

- **`/admin/dashboard`**: ringkasan — total buku, total user, total review (query `count()`).
- **`/admin/books`**: tabel daftar buku + link tambah/edit/hapus. Form tambah/edit buku
  menyertakan upload file cover (simpan ke `storage/app/public/covers` via
  `Storage::disk('public')`). Jalankan `php artisan storage:link` **[MANUAL]** agar bisa diakses
  dari browser.
- **`/admin/genres`**: tabel daftar genre + form tambah/edit/hapus. Slug di-generate otomatis
  dari nama genre (`Str::slug($request->name)`).
- **`/admin/users`**: tabel semua user (nama, email, role, jumlah review) + tombol hapus.

### 6.4 Layouting — **[AI]** untuk kerangka Blade, **[MANUAL]** untuk branding

Buat dua layout utama:

- **`resources/views/layouts/app.blade.php`** — layout publik:
    - Navbar: nama website "Bukuku", link Home, link per genre, link Login (jika belum login) atau
      nama user + link Profil + tombol Logout (jika sudah login).
    - `@yield('content')` untuk slot konten utama.
    - Footer sederhana.

- **`resources/views/layouts/admin.blade.php`** — layout admin:
    - Sidebar: link Dashboard, Kelola Buku, Kelola Genre, Lihat User, tombol Logout.
    - `@yield('content')` untuk slot konten utama.

Gunakan `@extends('layouts.app')`, `@section('content')`, `@endsection` di setiap view.
**Tanpa CSS apapun** — cukup struktur HTML yang berfungsi.

---

## 7. Pembagian Tugas Manual vs AI (Ringkasan)

### **[MANUAL]** Developer kerjakan sendiri di terminal/editor:

```
1.  Install Laravel:
      composer create-project laravel/laravel bukuku

2.  Setup .env:
      DB_CONNECTION=mysql
      DB_DATABASE=bukuku
      DB_USERNAME=root      ← sesuaikan
      DB_PASSWORD=          ← sesuaikan

3.  Buat database di MySQL:
      CREATE DATABASE bukuku;

4.  Hapus migration yang tidak perlu:
      - 0001_01_01_000001_create_cache_table.php
      - 0001_01_01_000002_create_jobs_table.php

5.  Edit create_users_table, salin kode dari Bagian 3.1.B

6.  Buat migration baru:
      php artisan make:migration create_genres_table
      php artisan make:migration create_books_table
      php artisan make:migration create_reviews_table
      php artisan make:migration create_bookshelves_table

7.  Salin kode migration dari Bagian 3.1.B ke file yang baru dibuat

8.  Buat model:
      php artisan make:model Genre
      php artisan make:model Book
      php artisan make:model Review
      php artisan make:model Bookshelf

9.  Buat seeder:
      php artisan make:seeder GenreSeeder
      php artisan make:seeder BookSeeder
      php artisan make:seeder UserSeeder
      php artisan make:seeder ReviewSeeder

10. Buat controller:
      php artisan make:controller AuthController
      php artisan make:controller BookController
      php artisan make:controller GenreController
      php artisan make:controller ReviewController
      php artisan make:controller BookshelfController
      php artisan make:controller ProfileController
      php artisan make:controller Admin/AdminDashboardController
      php artisan make:controller Admin/AdminBookController --resource
      php artisan make:controller Admin/AdminGenreController --resource
      php artisan make:controller Admin/AdminUserController

11. Buat middleware:
      php artisan make:middleware CheckLogin
      php artisan make:middleware CheckAdmin

12. Setelah semua kode [AI] sudah dipaste:
      php artisan migrate
      php artisan db:seed
      php artisan storage:link
```

### **[AI]** Minta ke AI per bagian (jangan sekaligus semua dalam satu prompt):

```
Urutan yang disarankan:
1. Isi kode model + relasi (Bagian 3.2)
2. Isi kode seeder (Bagian 3.3)
3. Isi kode AuthController (Bagian 4.2)
4. Isi kode CheckLogin & CheckAdmin + registrasi alias (Bagian 4.2–4.3)
5. Isi routes/web.php (Bagian 5)
6. Controller publik: BookController, GenreController
7. Controller auth: ReviewController, BookshelfController, ProfileController
8. Controller admin: AdminDashboardController, AdminBookController,
                     AdminGenreController, AdminUserController
9. Layout Blade: layouts/app.blade.php, layouts/admin.blade.php
10. View per halaman: home, detail buku, genre, login, ganti password,
                      profil, dashboard admin, form CRUD admin
```

> **Tips hemat token:** selesaikan dan cek satu bagian sebelum lanjut ke bagian berikutnya.
> Jika ada error, perbaiki dulu sebelum minta bagian berikutnya.

---

## 8. Kriteria Selesai (Definition of Done)

- [x] User bisa login dengan email + password plain text, session tersimpan
- [x] User bisa logout, session dihapus sepenuhnya
- [x] User bisa ganti password dengan verifikasi email + password lama
- [x] User belum login tetap bisa lihat daftar & detail buku
- [x] User belum login yang mencoba review/tambah rak → diarahkan ke `/login`
- [x] User login bisa menulis, mengedit, menghapus review miliknya sendiri
- [x] Rating rata-rata buku ter-update otomatis saat review baru ditambah atau dihapus
- [x] User login bisa menambah/mengubah status rak buku di halaman profil
- [x] Admin bisa akses `/admin/dashboard` dan melakukan CRUD buku & genre
- [x] User biasa yang mencoba akses route `/admin/*` → diredirect ke `/` dengan pesan error
- [x] Database ter-seed: 10 genre, 30 buku, 1 admin + 8 user (email & password masing-masing terlihat di `UserSeeder.php`), 60 review
- [x] Semua halaman bisa diakses dan form berfungsi (HTML polos, belum ada styling)
