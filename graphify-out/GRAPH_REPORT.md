# Graph Report - bukuku  (2026-08-09)

## Corpus Check
- 73 files · ~21,096 words
- Verdict: corpus is large enough that graph structure adds value.

## Summary
- 331 nodes · 417 edges · 53 communities (50 shown, 3 thin omitted)
- Extraction: 97% EXTRACTED · 3% INFERRED · 0% AMBIGUOUS · INFERRED: 12 edges (avg confidence: 0.8)
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `2866325d`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- composer.json
- scripts
- devDependencies
- Book
- Review
- User
- Illuminate\Database\Seeder
- Genre
- config
- AppServiceProvider
- TestCase
- Bukuku
- PRD-Frontend — Redesign UI Bukuku
- ExampleTest
- Agentic Development with Laravel Boost
- 5.2 Mapping Halaman ke Komponen
- UserFactory

## God Nodes (most connected - your core abstractions)
1. `User` - 26 edges
2. `Book` - 21 edges
3. `Genre` - 16 edges
4. `Controller` - 15 edges
5. `Review` - 13 edges
6. `PRD-Frontend — Redesign UI Bukuku` - 13 edges
7. `5.2 Mapping Halaman ke Komponen` - 11 edges
8. `scripts` - 9 edges
9. `5.1 Komponen Shared (digunakan di banyak halaman)` - 9 edges
10. `AdminBookController` - 8 edges

## Surprising Connections (you probably didn't know these)
- `Laravel Tech Stack` --semantically_similar_to--> `About Laravel Framework`  [INFERRED] [semantically similar]
  PRD.md → README.md
- `AdminBookController` --inherits--> `Controller`  [EXTRACTED]
  app/Http/Controllers/Admin/AdminBookController.php → app/Http/Controllers/Controller.php
- `AuthController` --inherits--> `Controller`  [EXTRACTED]
  app/Http/Controllers/AuthController.php → app/Http/Controllers/Controller.php
- `BookController` --inherits--> `Controller`  [EXTRACTED]
  app/Http/Controllers/BookController.php → app/Http/Controllers/Controller.php
- `BookshelfController` --inherits--> `Controller`  [EXTRACTED]
  app/Http/Controllers/BookshelfController.php → app/Http/Controllers/Controller.php

## Import Cycles
- None detected.

## Communities (53 total, 3 thin omitted)

### Community 0 - "composer.json"
Cohesion: 0.06
Nodes (33): autoload, autoload-dev, psr-4, psr-4, description, extra, laravel, keywords (+25 more)

### Community 1 - "scripts"
Cohesion: 0.08
Nodes (26): scripts, dev, post-autoload-dump, post-create-project-cmd, post-root-package-install, post-update-cmd, pre-package-uninstall, setup (+18 more)

### Community 2 - "devDependencies"
Cohesion: 0.11
Nodes (17): concurrently, laravel-vite-plugin, devDependencies, concurrently, laravel-vite-plugin, tailwindcss, @tailwindcss/vite, vite (+9 more)

### Community 3 - "Book"
Cohesion: 0.15
Nodes (4): AdminBookController, BookController, Book, Illuminate\Database\Eloquent\Relations\HasMany

### Community 4 - "Review"
Cohesion: 0.16
Nodes (6): BookshelfController, ReviewController, Bookshelf, Review, Illuminate\Database\Eloquent\Model, Illuminate\Database\Eloquent\Relations\BelongsTo

### Community 5 - "User"
Cohesion: 0.14
Nodes (10): AuthController, CheckAdmin, CheckLogin, User, Closure, Illuminate\Database\Eloquent\Factories\HasFactory, Illuminate\Foundation\Auth\User, Illuminate\Http\Request (+2 more)

### Community 6 - "Illuminate\Database\Seeder"
Cohesion: 0.16
Nodes (7): BookSeder, DatabaseSeeder, GenreSeeder, ReviewSeder, UserSeder, Factory, Illuminate\Database\Seeder

### Community 7 - "Genre"
Cohesion: 0.13
Nodes (8): AdminDashboardController, AdminGenreController, Request, AdminUserController, Controller, GenreController, ProfileController, Genre

### Community 8 - "config"
Cohesion: 0.29
Nodes (7): pestphp/pest-plugin, php-http/discovery, config, allow-plugins, optimize-autoloader, preferred-install, sort-packages

### Community 10 - "TestCase"
Cohesion: 0.40
Nodes (3): Illuminate\Foundation\Testing\TestCase, ExampleTest, TestCase

### Community 11 - "Bukuku"
Cohesion: 0.33
Nodes (6): Admin Dashboard Features, Bukuku, Custom Authentication & Middleware, Database Schema (Migrations), Laravel Tech Stack, About Laravel Framework

### Community 12 - "PRD-Frontend — Redesign UI Bukuku"
Cohesion: 0.04
Nodes (48): 0. Design Read, 10.1 Yang HARUS Dilakukan, 10.2 Yang DILARANG, 10.3 Konsistensi, 10. Aturan dan Larangan, 11. Kriteria Selesai (Definition of Done), 1.1 Kondisi Saat Ini, 1.2 Tujuan Redesign (+40 more)

### Community 34 - "5.2 Mapping Halaman ke Komponen"
Cohesion: 0.18
Nodes (11): 5.2 Mapping Halaman ke Komponen, Halaman 11-13: Admin CRUD Genre (`/admin/genres/*`), Halaman 14: Admin Kelola User (`/admin/users`), Halaman 1: Home / Daftar Buku (`/`), Halaman 2: Detail Buku (`/books/{book}`), Halaman 3: Genre (`/genres/{genre}`), Halaman 4: Login (`/login`), Halaman 5: Ganti Password (`/change-password`) (+3 more)

### Community 37 - "UserFactory"
Cohesion: 0.38
Nodes (3): UserFactory, Illuminate\Database\Eloquent\Factories\Factory, static

## Knowledge Gaps
- **104 isolated node(s):** `$schema`, `name`, `type`, `description`, `laravel` (+99 more)
  These have ≤1 connection - possible missing edges or undocumented components.
- **3 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `User` connect `User` to `Book`, `UserFactory`, `Illuminate\Database\Seeder`, `Genre`?**
  _High betweenness centrality (0.037) - this node is a cross-community bridge._
- **Why does `scripts` connect `scripts` to `composer.json`?**
  _High betweenness centrality (0.024) - this node is a cross-community bridge._
- **Are the 3 inferred relationships involving `Book` (e.g. with `.index()` and `.run()`) actually correct?**
  _`Book` has 3 INFERRED edges - model-reasoned connections that need verification._
- **Are the 5 inferred relationships involving `Genre` (e.g. with `.create()` and `.edit()`) actually correct?**
  _`Genre` has 5 INFERRED edges - model-reasoned connections that need verification._
- **What connects `$schema`, `name`, `type` to the rest of the system?**
  _104 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `composer.json` be split into smaller, more focused modules?**
  _Cohesion score 0.058823529411764705 - nodes in this community are weakly interconnected._
- **Should `scripts` be split into smaller, more focused modules?**
  _Cohesion score 0.08 - nodes in this community are weakly interconnected._