# Graph Report - bukuku  (2026-08-09)

## Corpus Check
- 47 files · ~13,060 words
- Verdict: corpus is large enough that graph structure adds value.

## Summary
- 208 nodes · 230 edges · 37 communities (33 shown, 4 thin omitted)
- Extraction: 96% EXTRACTED · 4% INFERRED · 0% AMBIGUOUS · INFERRED: 9 edges (avg confidence: 0.81)
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `40eb4d12`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- composer.json
- scripts
- devDependencies
- User
- CheckAdmin.php
- Book
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
1. `User` - 10 edges
2. `scripts` - 9 edges
3. `Book` - 8 edges
4. `require-dev` - 8 edges
5. `setup` - 7 edges
6. `Review` - 6 edges
7. `Genre` - 5 edges
8. `config` - 5 edges
9. `Bookshelf` - 4 edges
10. `AppServiceProvider` - 4 edges

## Surprising Connections (you probably didn't know these)
- `Laravel Tech Stack` --semantically_similar_to--> `About Laravel Framework`  [INFERRED] [semantically similar]
  PRD.md → README.md
- `AuthController` --inherits--> `Controller`  [EXTRACTED]
  app/Http/Controllers/AuthController.php → app/Http/Controllers/Controller.php
- `ExampleTest` --inherits--> `TestCase`  [EXTRACTED]
  tests/Feature/ExampleTest.php → tests/TestCase.php

## Import Cycles
- None detected.

## Communities (37 total, 4 thin omitted)

### Community 0 - "composer.json"
Cohesion: 0.08
Nodes (25): autoload, autoload-dev, psr-4, psr-4, description, extra, laravel, keywords (+17 more)

### Community 1 - "scripts"
Cohesion: 0.08
Nodes (26): scripts, dev, post-autoload-dump, post-create-project-cmd, post-root-package-install, post-update-cmd, pre-package-uninstall, setup (+18 more)

### Community 2 - "devDependencies"
Cohesion: 0.11
Nodes (17): concurrently, laravel-vite-plugin, devDependencies, concurrently, laravel-vite-plugin, tailwindcss, @tailwindcss/vite, vite (+9 more)

### Community 3 - "User"
Cohesion: 0.12
Nodes (10): Genre, User, DatabaseSeeder, GenreSeeder, UserSeder, Illuminate\Database\Eloquent\Factories\HasFactory, Illuminate\Database\Eloquent\Relations\HasMany, Illuminate\Database\Seeder (+2 more)

### Community 5 - "CheckAdmin.php"
Cohesion: 0.44
Nodes (5): CheckAdmin, CheckLogin, Closure, Illuminate\Http\Request, Symfony\Component\HttpFoundation\Response

### Community 6 - "Book"
Cohesion: 0.16
Nodes (8): Book, Bookshelf, Review, BookSeder, ReviewSeder, Factory, Illuminate\Database\Eloquent\Model, Illuminate\Database\Eloquent\Relations\BelongsTo

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
- **Are the 2 inferred relationships involving `User` (e.g. with `.run()` and `.run()`) actually correct?**
  _`User` has 2 INFERRED edges - model-reasoned connections that need verification._
- **Are the 2 inferred relationships involving `Book` (e.g. with `.run()` and `.run()`) actually correct?**
  _`Book` has 2 INFERRED edges - model-reasoned connections that need verification._
- **What connects `$schema`, `name`, `type` to the rest of the system?**
  _59 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `composer.json` be split into smaller, more focused modules?**
  _Cohesion score 0.07692307692307693 - nodes in this community are weakly interconnected._