# PRD-Frontend — Redesign UI Bukuku

## 0. Design Read

**"Reading this as: redesign-overhaul sebuah web review buku untuk pembaca kasual Indonesia, dengan bahasa visual minimalis-hangat bertema autumn, leaning toward Bootstrap 5.3 CDN + vanilla CSS custom properties + CSS animations. Pendekatan UX: warm, manis, menenangkan, tanpa tekanan."**

### Dial Settings (dari design-taste-frontend skill)

| Dial             | Nilai | Alasan                                                                            |
| ---------------- | ----- | --------------------------------------------------------------------------------- |
| DESIGN_VARIANCE  | 5     | Minimalis, clean, tapi tidak membosankan. Sedikit asimetri untuk karakter.        |
| MOTION_INTENSITY | 4     | Smooth dan modern tapi tidak berlebihan. CSS transitions + sedikit scroll-reveal. |
| VISUAL_DENSITY   | 3     | Airy, banyak whitespace. Memberi kesan tenang dan lapang. User tidak tertekan.    |

---

## 1. Latar Belakang dan Tujuan

### 1.1 Kondisi Saat Ini

Seluruh 16 file Blade view di Bukuku saat ini menggunakan **HTML polos tanpa styling**. Tampilan bergantung sepenuhnya pada default browser: tabel menggunakan atribut `border="1"`, layout admin menggunakan `<table>` sebagai grid, navigasi dipisahkan dengan `&nbsp;|&nbsp;`, dan tidak ada satu pun CSS class yang digunakan.

File `resources/css/app.css` berisi import Tailwind v4, tapi **tidak digunakan** oleh view manapun.

### 1.2 Tujuan Redesign

Mengubah tampilan Bukuku dari HTML polos menjadi antarmuka yang:

- **Minimalis** - bersih, tidak berantakan, focus pada konten (buku dan review)
- **Autumn-themed** - palet warna hangat musim gugur yang menenangkan
- **Clean look** - whitespace generous, tipografi yang rapi, visual hierarchy jelas
- **User-friendly UX** - user bisa menikmati browsing dan menulis review tanpa merasa tertekan
- **Warm dan manis** - pendekatan visual yang membuat hati tenang saat melihat UI
- **Animasi modern dan smooth** - transisi halus, hover states yang responsif, tanpa berlebihan

### 1.3 Batasan Teknis

- **Bootstrap 5.3 via CDN** - tidak perlu `npm install`, cukup `<link>` dan `<script>` di `<head>`
- **Vanilla CSS** untuk customisasi tema autumn di atas Bootstrap
- **Tidak mengubah logic Laravel** - hanya memodifikasi file Blade (.blade.php) dan menambahkan CSS
- **Tidak mengubah route, controller, atau model** - murni presentational layer

---

## 2. Tech Stack Frontend

| Layer          | Teknologi                               | Cara Pakai                              |
| -------------- | --------------------------------------- | --------------------------------------- |
| CSS Framework  | Bootstrap 5.3.x (CDN)                   | `<link>` di `<head>` layout             |
| Icons          | Bootstrap Icons (CDN)                   | `<link>` di `<head>` layout             |
| Custom Styling | Vanilla CSS (`public/css/bukuku.css`)   | CSS custom properties untuk tema autumn |
| Font           | Google Fonts CDN (Outfit + Inter Tight) | `<link>` di `<head>` layout             |
| Animasi        | CSS Transitions + Keyframes             | Didefinisikan di `bukuku.css`           |

### 2.1 CDN yang Digunakan

```html
<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
    href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Inter+Tight:wght@400;500&display=swap"
    rel="stylesheet"
/>

<!-- Bootstrap 5.3 CSS -->
<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
/>

<!-- Bootstrap Icons -->
<link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    rel="stylesheet"
/>

<!-- Custom Autumn Theme -->
<link href="{{ asset('css/bukuku.css') }}" rel="stylesheet" />

<!-- Bootstrap 5.3 JS Bundle (Popper included) -->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    defer
></script>
```

> **Catatan:** File `resources/css/app.css` (Tailwind) tidak lagi digunakan. Semua styling berpindah ke `public/css/bukuku.css` yang bisa diakses langsung tanpa build process.

---

## 3. Sistem Desain: Autumn Warm

### 3.1 Palet Warna

Warna terinspirasi oleh musim gugur: daun maple, madu hangat, kayu cokelat, langit senja keemasan.

```
AUTUMN PALETTE
--------------

Primary Colors (aksen utama):
  --autumn-amber:       #C4823A     Madu hangat, CTA utama
  --autumn-amber-light: #D4994F     Hover state
  --autumn-amber-dark:  #A66B2A     Active state

Neutral Warm (background + surface):
  --autumn-cream:       #FBF7F2     Background utama, seperti kertas tua yang lembut
  --autumn-linen:       #F5EDE3     Surface card, sedikit lebih gelap dari cream
  --autumn-sand:        #EBE0D3     Border halus, divider

Text Colors:
  --autumn-bark:        #3D2E22     Text utama, cokelat gelap kayu (bukan hitam murni)
  --autumn-wood:        #6B5344     Text sekunder, cokelat medium
  --autumn-dust:        #9C8A7C     Text tersier, placeholder, caption

Accent Sekunder (sparingly):
  --autumn-terracotta:  #B85C3A     Untuk rating bintang, badge "Sedang Dibaca"
  --autumn-sage:        #7A8C6E     Untuk status "Sudah Dibaca", sukses
  --autumn-rust:        #8B4A2F     Untuk peringatan, error ringan

Utility:
  --autumn-white:       #FFFFFF     Card background when needed
  --autumn-shadow:      rgba(61, 46, 34, 0.08)   Shadow tint ke warm
```

> **Kontras WCAG AA terjamin:** `--autumn-bark` (#3D2E22) di atas `--autumn-cream` (#FBF7F2) memberikan contrast ratio 10.2:1, jauh di atas minimum 4.5:1.

### 3.2 Tipografi

| Elemen          | Font        | Weight | Size             | Line Height | Keterangan                         |
| --------------- | ----------- | ------ | ---------------- | ----------- | ---------------------------------- |
| Display / H1    | Outfit      | 600    | 2rem (32px)      | 1.2         | Judul halaman, nama buku di detail |
| H2              | Outfit      | 600    | 1.5rem (24px)    | 1.3         | Sub-section heading                |
| H3              | Outfit      | 500    | 1.25rem (20px)   | 1.3         | Card heading, sidebar heading      |
| Body            | Outfit      | 400    | 1rem (16px)      | 1.6         | Paragraf, deskripsi, review        |
| Small / Caption | Inter Tight | 400    | 0.875rem (14px)  | 1.5         | Metadata, tanggal, author name     |
| Micro           | Inter Tight | 500    | 0.75rem (12px)   | 1.4         | Badge, label kecil                 |
| Nav link        | Outfit      | 500    | 0.9375rem (15px) | 1           | Menu navigasi                      |

### 3.3 Spacing System

Menggunakan skala kelipatan 4px yang konsisten:

| Token     | Nilai | Penggunaan                     |
| --------- | ----- | ------------------------------ |
| `--sp-1`  | 4px   | Gap antar elemen inline        |
| `--sp-2`  | 8px   | Padding internal kecil         |
| `--sp-3`  | 12px  | Padding card internal          |
| `--sp-4`  | 16px  | Gap standar                    |
| `--sp-6`  | 24px  | Section padding internal       |
| `--sp-8`  | 32px  | Antar section                  |
| `--sp-12` | 48px  | Section gap besar              |
| `--sp-16` | 64px  | Section padding vertikal utama |

### 3.4 Corner Radius (Shape Consistency Lock)

Satu sistem radius untuk seluruh halaman:

| Elemen     | Radius | Keterangan            |
| ---------- | ------ | --------------------- |
| Card       | 12px   | Rounded lembut        |
| Button     | 8px    | Sedikit lebih kecil   |
| Input      | 8px    | Sama dengan button    |
| Badge/Pill | 20px   | Full-pill untuk badge |
| Image      | 8px    | Konsisten dengan card |
| Avatar     | 50%    | Bulat penuh           |

### 3.5 Shadow System

Shadow di-tint ke warna warm, bukan hitam murni:

```css
--shadow-sm: 0 1px 3px rgba(61, 46, 34, 0.06);
--shadow-md: 0 4px 12px rgba(61, 46, 34, 0.08);
--shadow-lg: 0 8px 24px rgba(61, 46, 34, 0.1);
--shadow-hover: 0 8px 28px rgba(61, 46, 34, 0.14);
```

---

## 4. Animasi dan Motion

### 4.1 Prinsip Motion

- **Motivated motion only** - setiap animasi punya tujuan: feedback, hierarchy, atau state transition
- **Spring-like easing** - menggunakan `cubic-bezier(0.16, 1, 0.3, 1)` untuk kesan organik dan lembut
- **Durasi pendek** - 200-400ms untuk interaksi, 500-700ms untuk reveal
- **Reduced motion support** - semua animasi dihormati via `prefers-reduced-motion: reduce`

### 4.2 Katalog Motion

| Interaksi            | Efek                                             | Durasi | Tujuan                  |
| -------------------- | ------------------------------------------------ | ------ | ----------------------- |
| Hover card buku      | `translateY(-4px)` + shadow naik                 | 280ms  | Feedback: bisa diklik   |
| Hover button         | Background color shift + `scale(1.02)`           | 200ms  | Feedback: interaktif    |
| Active button        | `scale(0.98)` + `translateY(1px)`                | 100ms  | Feedback: ditekan       |
| Page load cards      | Fade-in + `translateY(16px)` dengan stagger 60ms | 500ms  | Hierarchy: urutan baca  |
| Flash message masuk  | Slide dari atas + fade-in                        | 400ms  | State: notifikasi baru  |
| Flash message keluar | Fade-out ke atas setelah 4 detik                 | 300ms  | State: selesai dibaca   |
| Rating star hover    | `scale(1.15)` + warna berubah                    | 150ms  | Feedback: pilihan aktif |
| Navbar scroll        | Background opacity meningkat + subtle shadow     | 200ms  | Context: scrolled state |
| Focus input          | Border warna berubah + subtle glow warm          | 200ms  | Feedback: aktif         |

### 4.3 CSS Implementation Pattern

```css
/* Easing global */
:root {
    --ease-out-expo: cubic-bezier(0.16, 1, 0.3, 1);
    --ease-spring: cubic-bezier(0.34, 1.56, 0.64, 1);
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}

/* Fade-in stagger pada load */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(16px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in-up {
    animation: fadeInUp 0.5s var(--ease-out-expo) both;
}

/* Stagger delay via CSS variable */
.stagger-item {
    animation-delay: calc(var(--index, 0) * 60ms);
}
```

---

## 5. Komponen UI dan Mapping ke Halaman

### 5.1 Komponen Shared (digunakan di banyak halaman)

#### A. Navbar Publik

- **Posisi:** Sticky top, height 64px
- **Background:** `--autumn-cream` dengan opacity yang meningkat saat scroll
- **Konten kiri:** Logo "Bukuku" (teks, font Outfit bold, warna `--autumn-amber`)
- **Konten tengah:** Link Home, genre dropdown (Bootstrap dropdown)
- **Konten kanan:**
    - Jika belum login: Button "Masuk" (outline style)
    - Jika sudah login: Avatar circle dengan initial nama + dropdown (Profil, Ganti Password, Logout)
    - Jika admin: tambahan link "Dashboard" sebelum dropdown
- **Mobile:** Collapse ke hamburger menu (Bootstrap navbar-toggler)
- **Class Bootstrap:** `navbar`, `navbar-expand-lg`, `fixed-top`

#### B. Sidebar Admin

- **Posisi:** Fixed left, width 260px, full height
- **Background:** `--autumn-linen`
- **Konten atas:** Logo "Bukuku Admin" dengan icon `bi-journal-bookmark-fill`
- **Menu items:** Vertical nav pills, icon + label per item
    - Dashboard (`bi-speedometer2`)
    - Kelola Buku (`bi-book`)
    - Kelola Genre (`bi-tags`)
    - Kelola User (`bi-people`)
- **Konten bawah:** Username + tombol Logout
- **Active state:** Background `--autumn-amber` dengan text putih
- **Mobile:** Off-canvas dari kiri (Bootstrap offcanvas)
- **Class Bootstrap:** `nav`, `nav-pills`, `flex-column`

#### C. Footer Publik

- **Background:** `--autumn-bark` (cokelat gelap)
- **Text:** `--autumn-sand` (krem terang)
- **Layout:** 3 kolom di desktop, stack di mobile
    - Kolom 1: Logo + tagline pendek ("Temukan bacaan favoritmu")
    - Kolom 2: Link navigasi (Home, Login, Profil)
    - Kolom 3: Info singkat ("Dibuat dengan cinta untuk pecinta buku")
- **Copyright:** Bottom bar tipis, `--autumn-dust` color
- **Class Bootstrap:** `container`, `row`, `col-md-4`

#### D. Card Buku

- **Background:** `--autumn-white`
- **Border:** 1px `--autumn-sand`
- **Shadow:** `--shadow-sm`, meningkat ke `--shadow-hover` saat hover
- **Layout:**
    - Cover image (aspect ratio 2:3, `border-radius: 8px`, object-fit cover)
    - Judul buku (H3, Outfit 500, max 2 baris dengan line-clamp)
    - Author (Inter Tight, `--autumn-wood`)
    - Genre badge (pill, background `--autumn-linen`, text `--autumn-wood`)
    - Rating (bintang `--autumn-terracotta` + angka)
- **Hover:** `translateY(-4px)` + shadow naik
- **Class Bootstrap:** `card`, `card-body`, `border-0`
- **Ukuran cover:** min-height 200px pada card grid

#### E. Flash Message / Alert

- **Sukses:** Background `--autumn-sage` soft (15% opacity) + border kiri 3px solid `--autumn-sage`
- **Error:** Background `--autumn-rust` soft (15% opacity) + border kiri 3px solid `--autumn-rust`
- **Animasi:** Slide-in dari atas, auto-dismiss 4 detik
- **Close button:** Bootstrap dismiss
- **Class Bootstrap:** `alert`, `alert-dismissible`, `fade`, `show`

#### F. Form Styling

- **Input/Select/Textarea:**
    - Background: `--autumn-white`
    - Border: 1px `--autumn-sand`
    - Border-radius: 8px
    - Padding: 12px 16px
    - Focus: border `--autumn-amber` + box-shadow warm glow
    - Placeholder: `--autumn-dust`
- **Label:** `--autumn-bark`, Outfit 500, margin-bottom 6px
- **Helper text:** `--autumn-dust`, Inter Tight 14px
- **Error text:** `--autumn-rust`, Inter Tight 14px, di bawah input
- **Class Bootstrap:** `form-control`, `form-label`, `form-select`, `form-text`

#### G. Button Styles

| Variant   | Background       | Text             | Hover                   | Penggunaan        |
| --------- | ---------------- | ---------------- | ----------------------- | ----------------- |
| Primary   | `--autumn-amber` | `#FFFFFF`        | `--autumn-amber-light`  | CTA utama         |
| Secondary | `--autumn-linen` | `--autumn-bark`  | `--autumn-sand`         | Aksi sekunder     |
| Outline   | Transparent      | `--autumn-amber` | `--autumn-amber` bg 10% | Login, Cancel     |
| Danger    | `--autumn-rust`  | `#FFFFFF`        | Darken 10%              | Hapus             |
| Ghost     | Transparent      | `--autumn-wood`  | `--autumn-linen` bg     | Link-style button |

Semua button: `border-radius: 8px`, `padding: 10px 20px`, `font-weight: 500`, active state `scale(0.98)`.

#### H. Rating Stars

- **Visual:** 5 bintang menggunakan Bootstrap Icons (`bi-star-fill`, `bi-star`)
- **Filled:** `--autumn-terracotta`
- **Empty:** `--autumn-sand`
- **Interactive (form):** Hover berubah warna, klik memilih rating
- **Display only:** Static, non-interactive
- **Size:** 18px untuk display, 24px untuk form input

---

### 5.2 Mapping Halaman ke Komponen

Berikut adalah daftar semua halaman dan bagaimana masing-masing akan di-redesign:

---

#### Halaman 1: Home / Daftar Buku (`/`)

**File:** `resources/views/books/index.blade.php`
**Layout:** `layouts.app`

**Struktur:**

```
[Navbar - sticky top]
[Hero Section - opsional, welcome area]
[Search + Filter Bar]
[Book Grid - 4 kolom desktop, 2 tablet, 1 mobile]
[Footer]
```

**Detail desain:**

1. **Hero mini** (hanya di homepage):
    - Background: gradient lembut dari `--autumn-cream` ke `--autumn-linen`
    - Heading: "Temukan Buku Favoritmu" (Outfit 600, `--autumn-bark`)
    - Sub-text: "Jelajahi, review, dan simpan buku yang kamu suka." (Outfit 400, `--autumn-wood`, max 15 kata)
    - Tidak ada CTA button di hero (search bar sudah cukup)
    - Padding: `py-12` (48px) atas-bawah

2. **Search + Filter Bar:**
    - Satu baris horizontal, dikelompokkan dalam card lembut
    - Input search dengan icon `bi-search` di kiri
    - Dropdown genre filter
    - Tombol "Cari" primary
    - Tombol "Reset" ghost (hanya muncul jika ada filter aktif)
    - Class Bootstrap: `input-group`, `form-select`

3. **Book Grid:**
    - Grid: `row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4`
    - Setiap item: Card Buku (komponen D)
    - Empty state: Ilustrasi ringan + teks "Belum ada buku yang cocok. Coba kata kunci lain."
    - Stagger animation pada load
    - Pagination: Bootstrap pagination style, centered, di bawah grid

---

#### Halaman 2: Detail Buku (`/books/{book}`)

**File:** `resources/views/books/show.blade.php`
**Layout:** `layouts.app`

**Struktur:**

```
[Navbar]
[Breadcrumb - Home > Genre > Judul Buku]
[Book Detail Section - 2 kolom]
    [Kiri: Cover Image besar]
    [Kanan: Info buku + action buttons]
[Review Section]
    [Form tulis review - jika login]
    [Daftar review]
[Footer]
```

**Detail desain:**

1. **Breadcrumb:**
    - Style minimal, separator `/`, text `--autumn-dust`
    - Active item: `--autumn-bark` bold
    - Class Bootstrap: `breadcrumb`

2. **Book Detail - 2 kolom:**
    - Layout: `col-md-4` (cover) + `col-md-8` (info)
    - **Cover:** Max-width 320px, shadow-md, border-radius 12px, aspect-ratio 2:3
    - **Info panel:**
        - Judul (H1, Outfit 600, 2rem)
        - Author (Inter Tight, `--autumn-wood`, dengan icon `bi-pen`)
        - Genre badge (pill)
        - Tahun terbit + ISBN (satu baris, `--autumn-dust`)
        - Rating display (bintang + angka besar)
        - Deskripsi (Outfit 400, `--autumn-bark`, line-height 1.7)
        - **Bookshelf actions** (jika login):
            - Dropdown select status (Ingin Dibaca, Sedang Dibaca, Sudah Dibaca)
            - Button "Simpan ke Rak" (primary)
            - Button "Hapus dari Rak" (outline danger, jika sudah di rak)
        - Jika belum login: Link halus "Masuk untuk menyimpan buku ini"

3. **Review Section:**
    - Heading: "Ulasan Pembaca" (H2)
    - Jumlah review + rata-rata rating
    - **Form tulis review** (jika login):
        - Card dengan background `--autumn-linen`
        - Interactive rating stars (klik untuk pilih 1-5)
        - Textarea untuk komentar
        - Button "Kirim Ulasan" (primary)
    - **Daftar review:**
        - Setiap review: card ringan (border-bottom saja, tanpa box)
        - Avatar circle (initial nama), nama user, tanggal, rating stars
        - Teks komentar
        - Jika milik user login: button Edit (ghost) + Hapus (ghost danger)
        - **Edit form:** Inline expand (bukan modal, bukan `<details>`), smooth open animation
    - Empty state: "Belum ada ulasan. Jadilah yang pertama menulis ulasan."

---

#### Halaman 3: Genre (`/genres/{genre}`)

**File:** `resources/views/genres/show.blade.php`
**Layout:** `layouts.app`

**Struktur:**

```
[Navbar]
[Genre Header - nama genre + jumlah buku]
[Book Grid - sama dengan home]
[Link kembali ke Home]
[Footer]
```

**Detail desain:**

- Header genre: Background `--autumn-linen`, padding generous
    - Nama genre (H1)
    - Sub-text: "{n} buku dalam genre ini"
    - Breadcrumb: Home > Genre
- Book grid: identik dengan halaman Home
- Link "Kembali ke semua buku" di bawah grid

---

#### Halaman 4: Login (`/login`)

**File:** `resources/views/auth/login.blade.php`
**Layout:** `layouts.app`

**Struktur:**

```
[Navbar]
[Centered Login Card]
[Footer]
```

**Detail desain:**

- Card di tengah layar, max-width 420px
- Background `--autumn-white`, shadow-md, border-radius 12px
- Logo "Bukuku" di atas form
- Heading: "Selamat Datang Kembali" (Outfit 600)
- Sub-text: "Masuk untuk mulai menjelajah" (Outfit 400, `--autumn-wood`)
- Form: Email + Password + Button "Masuk" (primary, full-width)
- Padding generous di dalam card
- Background halaman: `--autumn-cream` dengan subtle pattern

---

#### Halaman 5: Ganti Password (`/change-password`)

**File:** `resources/views/auth/change-password.blade.php`
**Layout:** `layouts.app`

**Struktur:**

```
[Navbar]
[Centered Form Card]
[Footer]
```

**Detail desain:**

- Card serupa dengan login, max-width 480px
- Heading: "Ganti Password"
- Form fields: Email, Password Lama, Password Baru, Konfirmasi Password Baru
- Button "Simpan Password Baru" (primary, full-width)
- Link "Kembali ke Profil" (ghost)

---

#### Halaman 6: Profil User (`/profile`)

**File:** `resources/views/profile/index.blade.php`
**Layout:** `layouts.app`

**Struktur:**

```
[Navbar]
[Profile Header]
[Bookshelf Tabs - 3 tab]
[Footer]
```

**Detail desain:**

1. **Profile Header:**
    - Avatar besar (80px, circle, initial nama, background `--autumn-amber`)
    - Nama user (H1)
    - Email (Inter Tight, `--autumn-wood`)
    - Role badge (jika admin, pill `--autumn-terracotta`)
    - Link "Ganti Password" (outline button kecil)

2. **Bookshelf dengan Tabs:**
    - 3 tab: "Sedang Dibaca", "Ingin Dibaca", "Sudah Dibaca"
    - Tab styling: Bootstrap nav-tabs, custom ke autumn theme
    - Active tab: border-bottom `--autumn-amber`
    - Setiap tab berisi list buku (card horizontal: cover kecil + judul + author + link detail)
    - Counter di setiap tab label: "Sedang Dibaca (3)"
    - Empty state per tab: "Belum ada buku di rak ini."
    - Class Bootstrap: `nav-tabs`, `tab-content`, `tab-pane`

---

#### Halaman 7: Admin Dashboard (`/admin/dashboard`)

**File:** `resources/views/admin/dashboard.blade.php`
**Layout:** `layouts.admin`

**Struktur:**

```
[Sidebar]
[Main Content]
    [Heading]
    [Stat Cards - 3 kolom]
    [Quick Links]
```

**Detail desain:**

- **Stat Cards** (3 buah, horizontal):
    - Total Buku (icon `bi-book`, warna `--autumn-amber`)
    - Total User (icon `bi-people`, warna `--autumn-sage`)
    - Total Review (icon `bi-chat-square-text`, warna `--autumn-terracotta`)
    - Setiap card: icon besar + angka besar + label
    - Background `--autumn-white`, border 1px `--autumn-sand`
    - Class Bootstrap: `row`, `col-md-4`

- **Quick Links:** Compact list ke Kelola Buku, Kelola Genre, Kelola User

---

#### Halaman 8-10: Admin CRUD Buku (`/admin/books/*`)

**File:** `resources/views/admin/books/index.blade.php`, `create.blade.php`, `edit.blade.php`
**Layout:** `layouts.admin`

**Tabel daftar buku (index):**

- Bootstrap table: `table`, `table-hover`
- Background header: `--autumn-linen`
- Kolom: Cover (thumbnail 40px), Judul, Author, Genre, Rating, Aksi
- Aksi: Button icon Edit (`bi-pencil`) + Hapus (`bi-trash`)
- Hover row: background `--autumn-cream` subtle
- Empty state: "Belum ada buku. Tambahkan buku pertama."
- Tombol "Tambah Buku" di atas tabel (primary)

**Form create/edit:**

- Card form, max-width 680px
- Fields sesuai PRD utama: title, author, genre (select), description (textarea), published_year, ISBN, cover_image (file upload)
- File upload: Custom styled area dengan icon `bi-cloud-upload`
- Preview cover saat edit (thumbnail kecil)
- Button "Simpan" (primary) + "Batal" (outline, link ke index)

---

#### Halaman 11-13: Admin CRUD Genre (`/admin/genres/*`)

**File:** `resources/views/admin/genres/index.blade.php`, `create.blade.php`, `edit.blade.php`
**Layout:** `layouts.admin`

- Struktur identik dengan admin buku tapi lebih sederhana
- Tabel: Nama Genre, Slug, Jumlah Buku, Aksi
- Form: hanya field "Nama Genre" + info slug auto-generate

---

#### Halaman 14: Admin Kelola User (`/admin/users`)

**File:** `resources/views/admin/users/index.blade.php`
**Layout:** `layouts.admin`

- Tabel: Nama, Email, Role (badge), Jumlah Review, Terdaftar Sejak, Aksi
- Role badge: "admin" = pill `--autumn-terracotta`, "user" = pill `--autumn-linen`
- Hapus user: confirmation modal (Bootstrap modal) menggantikan `confirm()` JS
- User yang sedang login tidak bisa dihapus (tombol disabled)

---

## 6. Layout System

### 6.1 Layout Publik (`layouts/app.blade.php`)

```
+----------------------------------------------+
|              Navbar (sticky)                  |
+----------------------------------------------+
|                                               |
|         Flash Messages (jika ada)             |
|                                               |
|            Main Content Area                  |
|       (container, max-width 1200px)           |
|                                               |
+----------------------------------------------+
|              Footer                           |
+----------------------------------------------+
```

- Container utama: `max-width: 1200px`, `margin: 0 auto`, `padding: 0 16px`
- Min-height body: menggunakan flexbox agar footer selalu di bawah
- Background: `--autumn-cream`

### 6.2 Layout Admin (`layouts/admin.blade.php`)

```
+----------+-----------------------------------+
|          |                                   |
| Sidebar  |         Main Content              |
| (260px)  |    (padding: 32px)                |
| fixed    |                                   |
|          |                                   |
|          |                                   |
+----------+-----------------------------------+
```

- Sidebar: Fixed left, width 260px, height 100vh
- Main content: `margin-left: 260px`, padding 32px
- Background sidebar: `--autumn-linen`
- Background main: `--autumn-cream`
- Mobile: Sidebar menjadi offcanvas, main content full-width

---

## 7. Responsive Breakpoints

Mengikuti breakpoint Bootstrap 5:

| Breakpoint | Size    | Layout                           |
| ---------- | ------- | -------------------------------- |
| xs         | < 576px | 1 kolom, stack semua             |
| sm         | 576px+  | 2 kolom grid buku                |
| md         | 768px+  | Sidebar admin muncul             |
| lg         | 992px+  | 3 kolom grid buku, navbar expand |
| xl         | 1200px+ | 4 kolom grid buku                |

### 7.1 Mobile-Specific Rules

- Navbar collapse ke hamburger di bawah `lg`
- Admin sidebar menjadi offcanvas di bawah `md`
- Book detail: cover di atas, info di bawah (stack vertikal)
- Form cards: full-width, padding dikurangi
- Tabel admin: horizontal scroll (`table-responsive`)
- Font size H1 berkurang: 2rem menjadi 1.5rem

---

## 8. File yang Akan Dimodifikasi

### 8.1 File Baru

| File                    | Deskripsi                                     |
| ----------------------- | --------------------------------------------- |
| `public/css/bukuku.css` | Custom CSS theme autumn + animasi + overrides |

### 8.2 File yang Dimodifikasi

| File                                             | Perubahan                                           |
| ------------------------------------------------ | --------------------------------------------------- |
| `resources/views/layouts/app.blade.php`          | CDN links, navbar Bootstrap, footer, flash messages |
| `resources/views/layouts/admin.blade.php`        | CDN links, sidebar Bootstrap, offcanvas mobile      |
| `resources/views/books/index.blade.php`          | Hero mini, search bar, book grid cards              |
| `resources/views/books/show.blade.php`           | 2-kolom layout, review cards, interactive elements  |
| `resources/views/genres/show.blade.php`          | Genre header + book grid                            |
| `resources/views/auth/login.blade.php`           | Centered card form                                  |
| `resources/views/auth/change-password.blade.php` | Centered card form                                  |
| `resources/views/profile/index.blade.php`        | Profile header + tabbed bookshelf                   |
| `resources/views/admin/dashboard.blade.php`      | Stat cards + quick links                            |
| `resources/views/admin/books/index.blade.php`    | Bootstrap table + action buttons                    |
| `resources/views/admin/books/create.blade.php`   | Styled form card                                    |
| `resources/views/admin/books/edit.blade.php`     | Styled form card + cover preview                    |
| `resources/views/admin/genres/index.blade.php`   | Bootstrap table                                     |
| `resources/views/admin/genres/create.blade.php`  | Styled form card                                    |
| `resources/views/admin/genres/edit.blade.php`    | Styled form card                                    |
| `resources/views/admin/users/index.blade.php`    | Bootstrap table + role badges + delete modal        |

### 8.3 File yang TIDAK Diubah

- Semua Controller (logic tetap sama)
- Semua Model
- Routes (`web.php`)
- Migration dan Seeder
- `resources/css/app.css` (tetap ada tapi tidak digunakan oleh view)
- `vite.config.js` (tidak perlu build process)

---

## 9. Urutan Implementasi

Implementasi dilakukan bertahap agar bisa diperiksa per fase:

### Fase 1: Foundation (3 file)

```
1. public/css/bukuku.css          - Seluruh design tokens, variables, animasi, overrides
2. resources/views/layouts/app.blade.php    - Layout publik dengan CDN + navbar + footer
3. resources/views/layouts/admin.blade.php  - Layout admin dengan sidebar
```

**Checkpoint:** Buka semua halaman, pastikan navbar, sidebar, footer muncul benar.

### Fase 2: Halaman Publik Utama (3 file)

```
4. resources/views/books/index.blade.php    - Homepage dengan book grid
5. resources/views/books/show.blade.php     - Detail buku + review
6. resources/views/genres/show.blade.php    - Halaman genre
```

**Checkpoint:** Browsing buku, lihat detail, filter genre semua berfungsi dengan styling baru.

### Fase 3: Auth dan Profil (3 file)

```
7. resources/views/auth/login.blade.php
8. resources/views/auth/change-password.blade.php
9. resources/views/profile/index.blade.php
```

**Checkpoint:** Login, ganti password, lihat profil + rak buku semua berfungsi.

### Fase 4: Admin Panel (7 file)

```
10. resources/views/admin/dashboard.blade.php
11. resources/views/admin/books/index.blade.php
12. resources/views/admin/books/create.blade.php
13. resources/views/admin/books/edit.blade.php
14. resources/views/admin/genres/index.blade.php
15. resources/views/admin/genres/create.blade.php
16. resources/views/admin/genres/edit.blade.php
17. resources/views/admin/users/index.blade.php
```

**Checkpoint:** Semua CRUD admin berfungsi, tabel rapi, form usable.

---

## 10. Aturan dan Larangan

### 10.1 Yang HARUS Dilakukan

- Semua warna menggunakan CSS custom properties (bukan hardcode hex)
- Semua button dan link interaktif punya hover + active + focus state
- Semua form punya label di atas input (bukan placeholder sebagai label)
- Semua tabel punya `table-responsive` wrapper untuk mobile
- Semua gambar punya `alt` text deskriptif
- Flash message bisa di-dismiss manual + auto-dismiss
- Confirmation hapus menggunakan Bootstrap Modal (bukan `confirm()`)
- `prefers-reduced-motion` di-support di semua animasi

### 10.2 Yang DILARANG

- Tidak boleh mengubah logic PHP di controller/model
- Tidak boleh menambahkan route baru
- Tidak boleh menggunakan `npm install` atau build process
- Tidak boleh menggunakan warna hitam murni (#000000) atau putih murni sebagai background
- Tidak boleh menggunakan shadow hitam murni (harus di-tint warm)
- Tidak boleh menambahkan animasi tanpa tujuan yang jelas
- Tidak boleh menggunakan em-dash di teks manapun

### 10.3 Konsistensi

- Satu accent color (`--autumn-amber`) digunakan secara konsisten di SELURUH halaman
- Satu radius system (12px card, 8px button/input, 20px badge)
- Satu shadow system (warm-tinted)
- Satu font stack (Outfit display + Inter Tight small)
- Light mode only (konsisten satu theme, sesuai warm autumn vibe)

---

## 11. Kriteria Selesai (Definition of Done)

- [x] Semua 16 file Blade view sudah di-redesign sesuai spesifikasi
- [x] File `public/css/bukuku.css` berisi design system lengkap
- [x] Navbar publik responsif dan sticky
- [x] Sidebar admin responsif (desktop fixed, mobile offcanvas)
- [x] Book grid tampil 4 kolom (xl), 3 kolom (lg), 2 kolom (sm), 1 kolom (xs)
- [x] Semua form memiliki styling konsisten (label di atas, focus state, error state)
- [x] Rating stars visual menggunakan Bootstrap Icons
- [x] Flash messages memiliki animasi masuk/keluar dan auto-dismiss
- [x] Card buku memiliki hover animation (lift + shadow)
- [x] Fade-in stagger animation pada book grid load
- [x] Halaman login dan ganti password menggunakan centered card
- [x] Profil user menggunakan tabbed bookshelf
- [x] Admin dashboard menggunakan stat cards
- [x] Tabel admin menggunakan Bootstrap table dengan hover
- [x] Delete confirmation menggunakan Bootstrap Modal / Confirm Dialog
- [x] `prefers-reduced-motion` di-support
- [x] Semua halaman lulus WCAG AA contrast check
- [x] Responsive di semua breakpoint (xs sampai xl)
- [x] Tidak ada build process yang dibutuhkan (CDN only)
- [x] Semua fitur fungsional dari PRD utama tetap berjalan normal
