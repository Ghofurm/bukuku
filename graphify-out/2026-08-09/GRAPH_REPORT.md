# Graph Report - bukuku  (2026-08-09)

## Corpus Check
- 47 files · ~12,740 words
- Verdict: corpus is large enough that graph structure adds value.

## Summary
- 208 nodes · 222 edges · 38 communities (34 shown, 4 thin omitted)
- Extraction: 99% EXTRACTED · 1% INFERRED · 0% AMBIGUOUS · INFERRED: 3 edges (avg confidence: 0.82)
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `ece0dd77`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- composer.json
- scripts
- devDependencies
- Illuminate\Database\Seeder
- User
- CheckAdmin.php
- Illuminate\Database\Eloquent\Model
- require-dev
- config
- AppServiceProvider
- TestCase
- Bukuku
- AuthController
- ExampleTest
- Agentic Development with Laravel Boost
- UserFactory

## God Nodes (most connected - your core abstractions)
1. `User` - 9 edges
2. `scripts` - 9 edges
3. `require-dev` - 8 edges
4. `setup` - 7 edges
5. `Book` - 6 edges
6. `Review` - 5 edges
7. `config` - 5 edges
8. `Bookshelf` - 4 edges
9. `AppServiceProvider` - 4 edges
10. `require` - 4 edges

## Surprising Connections (you probably didn't know these)
- `Laravel Tech Stack` --semantically_similar_to--> `About Laravel Framework`  [INFERRED] [semantically similar]
  PRD.md → README.md
- `AuthController` --inherits--> `Controller`  [EXTRACTED]
  app/Http/Controllers/AuthController.php → app/Http/Controllers/Controller.php
- `ExampleTest` --inherits--> `TestCase`  [EXTRACTED]
  tests/Feature/ExampleTest.php → tests/TestCase.php

## Import Cycles
- None detected.

## Communities (38 total, 4 thin omitted)

### Community 0 - "composer.json"
Cohesion: 0.08
Nodes (25): autoload, autoload-dev, psr-4, psr-4, description, extra, laravel, keywords (+17 more)

### Community 1 - "scripts"
Cohesion: 0.08
Nodes (26): scripts, dev, post-autoload-dump, post-create-project-cmd, post-root-package-install, post-update-cmd, pre-package-uninstall, setup (+18 more)

### Community 2 - "devDependencies"
Cohesion: 0.11
Nodes (17): concurrently, laravel-vite-plugin, devDependencies, concurrently, laravel-vite-plugin, tailwindcss, @tailwindcss/vite, vite (+9 more)

### Community 3 - "Illuminate\Database\Seeder"
Cohesion: 0.19
Nodes (7): BookSeder, DatabaseSeeder, GenreSeeder, ReviewSeder, UserSeder, Illuminate\Database\Console\Seeds\WithoutModelEvents, Illuminate\Database\Seeder

### Community 4 - "User"
Cohesion: 0.24
Nodes (4): User, Illuminate\Database\Eloquent\Factories\HasFactory, Illuminate\Foundation\Auth\User, Illuminate\Notifications\Notifiable

### Community 5 - "CheckAdmin.php"
Cohesion: 0.44
Nodes (5): CheckAdmin, CheckLogin, Closure, Illuminate\Http\Request, Symfony\Component\HttpFoundation\Response

### Community 6 - "Illuminate\Database\Eloquent\Model"
Cohesion: 0.18
Nodes (7): Book, Bookshelf, Genre, Review, Illuminate\Database\Eloquent\Model, Illuminate\Database\Eloquent\Relations\BelongsTo, Illuminate\Database\Eloquent\Relations\HasMany

### Community 7 - "require-dev"
Cohesion: 0.25
Nodes (8): require-dev, fakerphp/faker, laravel/pail, laravel/pao, laravel/pint, mockery/mockery, nunomaduro/collision, phpunit/phpunit

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
- **4 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `scripts` connect `scripts` to `composer.json`?**
  _High betweenness centrality (0.060) - this node is a cross-community bridge._
- **Why does `require-dev` connect `require-dev` to `composer.json`?**
  _High betweenness centrality (0.020) - this node is a cross-community bridge._
- **Why does `config` connect `config` to `composer.json`?**
  _High betweenness centrality (0.017) - this node is a cross-community bridge._
- **What connects `$schema`, `name`, `type` to the rest of the system?**
  _59 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `composer.json` be split into smaller, more focused modules?**
  _Cohesion score 0.07692307692307693 - nodes in this community are weakly interconnected._
- **Should `scripts` be split into smaller, more focused modules?**
  _Cohesion score 0.08 - nodes in this community are weakly interconnected._
- **Should `devDependencies` be split into smaller, more focused modules?**
  _Cohesion score 0.1111111111111111 - nodes in this community are weakly interconnected._