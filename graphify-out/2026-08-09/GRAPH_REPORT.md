# Graph Report - bukuku  (2026-08-09)

## Corpus Check
- 47 files · ~13,551 words
- Verdict: corpus is large enough that graph structure adds value.

## Summary
- 213 nodes · 244 edges · 34 communities (31 shown, 3 thin omitted)
- Extraction: 95% EXTRACTED · 5% INFERRED · 0% AMBIGUOUS · INFERRED: 12 edges (avg confidence: 0.8)
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `fb4f034a`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- composer.json
- scripts
- devDependencies
- User
- AuthController
- Illuminate\Database\Seeder
- config
- AppServiceProvider
- TestCase
- Bukuku
- ExampleTest
- Agentic Development with Laravel Boost
- UserFactory

## God Nodes (most connected - your core abstractions)
1. `User` - 13 edges
2. `scripts` - 9 edges
3. `Book` - 8 edges
4. `require-dev` - 8 edges
5. `AuthController` - 7 edges
6. `setup` - 7 edges
7. `Review` - 6 edges
8. `Genre` - 5 edges
9. `config` - 5 edges
10. `Bookshelf` - 4 edges

## Surprising Connections (you probably didn't know these)
- `Laravel Tech Stack` --semantically_similar_to--> `About Laravel Framework`  [INFERRED] [semantically similar]
  PRD.md → README.md
- `AuthController` --inherits--> `Controller`  [EXTRACTED]
  app/Http/Controllers/AuthController.php → app/Http/Controllers/Controller.php
- `ExampleTest` --inherits--> `TestCase`  [EXTRACTED]
  tests/Feature/ExampleTest.php → tests/TestCase.php

## Import Cycles
- None detected.

## Communities (34 total, 3 thin omitted)

### Community 0 - "composer.json"
Cohesion: 0.06
Nodes (33): autoload, autoload-dev, psr-4, psr-4, description, extra, laravel, keywords (+25 more)

### Community 1 - "scripts"
Cohesion: 0.08
Nodes (26): scripts, dev, post-autoload-dump, post-create-project-cmd, post-root-package-install, post-update-cmd, pre-package-uninstall, setup (+18 more)

### Community 2 - "devDependencies"
Cohesion: 0.11
Nodes (17): concurrently, laravel-vite-plugin, devDependencies, concurrently, laravel-vite-plugin, tailwindcss, @tailwindcss/vite, vite (+9 more)

### Community 3 - "User"
Cohesion: 0.18
Nodes (6): User, UserSeder, Illuminate\Database\Eloquent\Factories\HasFactory, Illuminate\Database\Eloquent\Relations\HasMany, Illuminate\Foundation\Auth\User, Illuminate\Notifications\Notifiable

### Community 5 - "AuthController"
Cohesion: 0.16
Nodes (7): AuthController, Controller, CheckAdmin, CheckLogin, Closure, Illuminate\Http\Request, Symfony\Component\HttpFoundation\Response

### Community 6 - "Illuminate\Database\Seeder"
Cohesion: 0.11
Nodes (12): Book, Bookshelf, Genre, Review, BookSeder, DatabaseSeeder, GenreSeeder, ReviewSeder (+4 more)

### Community 8 - "config"
Cohesion: 0.29
Nodes (7): pestphp/pest-plugin, php-http/discovery, config, allow-plugins, optimize-autoloader, preferred-install, sort-packages

### Community 10 - "TestCase"
Cohesion: 0.40
Nodes (3): Illuminate\Foundation\Testing\TestCase, ExampleTest, TestCase

### Community 11 - "Bukuku"
Cohesion: 0.33
Nodes (6): Admin Dashboard Features, Bukuku, Custom Authentication & Middleware, Database Schema (Migrations), Laravel Tech Stack, About Laravel Framework

### Community 37 - "UserFactory"
Cohesion: 0.38
Nodes (3): UserFactory, Illuminate\Database\Eloquent\Factories\Factory, static

## Knowledge Gaps
- **59 isolated node(s):** `$schema`, `name`, `type`, `description`, `laravel` (+54 more)
  These have ≤1 connection - possible missing edges or undocumented components.
- **3 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `scripts` connect `scripts` to `composer.json`?**
  _High betweenness centrality (0.057) - this node is a cross-community bridge._
- **Why does `User` connect `User` to `AuthController`, `Illuminate\Database\Seeder`?**
  _High betweenness centrality (0.031) - this node is a cross-community bridge._
- **Are the 5 inferred relationships involving `User` (e.g. with `.changePassword()` and `.login()`) actually correct?**
  _`User` has 5 INFERRED edges - model-reasoned connections that need verification._
- **Are the 2 inferred relationships involving `Book` (e.g. with `.run()` and `.run()`) actually correct?**
  _`Book` has 2 INFERRED edges - model-reasoned connections that need verification._
- **What connects `$schema`, `name`, `type` to the rest of the system?**
  _59 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `composer.json` be split into smaller, more focused modules?**
  _Cohesion score 0.058823529411764705 - nodes in this community are weakly interconnected._
- **Should `scripts` be split into smaller, more focused modules?**
  _Cohesion score 0.08 - nodes in this community are weakly interconnected._