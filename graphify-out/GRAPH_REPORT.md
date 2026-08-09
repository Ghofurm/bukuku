# Graph Report - bukuku  (2026-08-09)

## Corpus Check
- 72 files · ~16,605 words
- Verdict: corpus is large enough that graph structure adds value.

## Summary
- 272 nodes · 358 edges · 53 communities (50 shown, 3 thin omitted)
- Extraction: 97% EXTRACTED · 3% INFERRED · 0% AMBIGUOUS · INFERRED: 12 edges (avg confidence: 0.8)
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `2df2de3b`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- composer.json
- scripts
- devDependencies
- Book
- Illuminate\Http\Request
- User
- Illuminate\Database\Seeder
- Genre
- config
- AppServiceProvider
- TestCase
- Bukuku
- CheckLogin.php
- ExampleTest
- Agentic Development with Laravel Boost
- UserFactory

## God Nodes (most connected - your core abstractions)
1. `User` - 26 edges
2. `Book` - 21 edges
3. `Genre` - 16 edges
4. `Controller` - 15 edges
5. `Review` - 13 edges
6. `scripts` - 9 edges
7. `AdminBookController` - 8 edges
8. `AdminGenreController` - 8 edges
9. `require-dev` - 8 edges
10. `AuthController` - 7 edges

## Surprising Connections (you probably didn't know these)
- `Laravel Tech Stack` --semantically_similar_to--> `About Laravel Framework`  [INFERRED] [semantically similar]
  PRD.md → README.md
- `AdminBookController` --inherits--> `Controller`  [EXTRACTED]
  app/Http/Controllers/Admin/AdminBookController.php → app/Http/Controllers/Controller.php
- `AdminGenreController` --inherits--> `Controller`  [EXTRACTED]
  app/Http/Controllers/Admin/AdminGenreController.php → app/Http/Controllers/Controller.php
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
Cohesion: 0.16
Nodes (4): AdminBookController, BookController, Book, Illuminate\Database\Eloquent\Relations\HasMany

### Community 4 - "Illuminate\Http\Request"
Cohesion: 0.17
Nodes (7): BookshelfController, ReviewController, Bookshelf, Review, Illuminate\Database\Eloquent\Model, Illuminate\Database\Eloquent\Relations\BelongsTo, Illuminate\Http\Request

### Community 5 - "User"
Cohesion: 0.11
Nodes (9): AdminDashboardController, AdminUserController, AuthController, Controller, ProfileController, User, Illuminate\Database\Eloquent\Factories\HasFactory, Illuminate\Foundation\Auth\User (+1 more)

### Community 6 - "Illuminate\Database\Seeder"
Cohesion: 0.16
Nodes (7): BookSeder, DatabaseSeeder, GenreSeeder, ReviewSeder, UserSeder, Factory, Illuminate\Database\Seeder

### Community 7 - "Genre"
Cohesion: 0.23
Nodes (4): AdminGenreController, Request, GenreController, Genre

### Community 8 - "config"
Cohesion: 0.29
Nodes (7): pestphp/pest-plugin, php-http/discovery, config, allow-plugins, optimize-autoloader, preferred-install, sort-packages

### Community 10 - "TestCase"
Cohesion: 0.40
Nodes (3): Illuminate\Foundation\Testing\TestCase, ExampleTest, TestCase

### Community 11 - "Bukuku"
Cohesion: 0.33
Nodes (6): Admin Dashboard Features, Bukuku, Custom Authentication & Middleware, Database Schema (Migrations), Laravel Tech Stack, About Laravel Framework

### Community 12 - "CheckLogin.php"
Cohesion: 0.43
Nodes (4): CheckAdmin, CheckLogin, Closure, Symfony\Component\HttpFoundation\Response

### Community 37 - "UserFactory"
Cohesion: 0.38
Nodes (3): UserFactory, Illuminate\Database\Eloquent\Factories\Factory, static

## Knowledge Gaps
- **59 isolated node(s):** `$schema`, `name`, `type`, `description`, `laravel` (+54 more)
  These have ≤1 connection - possible missing edges or undocumented components.
- **3 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `User` connect `User` to `Book`, `CheckLogin.php`, `UserFactory`, `Illuminate\Database\Seeder`?**
  _High betweenness centrality (0.056) - this node is a cross-community bridge._
- **Why does `scripts` connect `scripts` to `composer.json`?**
  _High betweenness centrality (0.035) - this node is a cross-community bridge._
- **Why does `Controller` connect `User` to `Book`, `Illuminate\Http\Request`, `Genre`?**
  _High betweenness centrality (0.031) - this node is a cross-community bridge._
- **Are the 3 inferred relationships involving `Book` (e.g. with `.index()` and `.run()`) actually correct?**
  _`Book` has 3 INFERRED edges - model-reasoned connections that need verification._
- **Are the 5 inferred relationships involving `Genre` (e.g. with `.create()` and `.edit()`) actually correct?**
  _`Genre` has 5 INFERRED edges - model-reasoned connections that need verification._
- **What connects `$schema`, `name`, `type` to the rest of the system?**
  _59 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `composer.json` be split into smaller, more focused modules?**
  _Cohesion score 0.058823529411764705 - nodes in this community are weakly interconnected._