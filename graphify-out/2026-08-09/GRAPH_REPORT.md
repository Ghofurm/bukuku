# Graph Report - .  (2026-08-09)

## Corpus Check
- Corpus is ~12,327 words - fits in a single context window. You may not need a graph.

## Summary
- 193 nodes · 191 edges · 37 communities (33 shown, 4 thin omitted)
- Extraction: 99% EXTRACTED · 1% INFERRED · 0% AMBIGUOUS · INFERRED: 2 edges (avg confidence: 0.82)
- Token cost: 0 input · 0 output

## Community Hubs (Navigation)
- Composer Autoload & Core Config
- Composer scripts & Artisan tasks
- Front-end & Build tools
- Database Seeders
- User & Authentication Domain
- HTTP Middleware
- Core Models
- Composer Dev dependencies
- Composer package settings
- Service Providers & Bootstrap
- Feature Testing
- Project PRD & Tech Stack Specs
- HTTP Controllers
- Unit Testing
- Agentic Development guidelines

## God Nodes (most connected - your core abstractions)
1. `scripts` - 9 edges
2. `require-dev` - 8 edges
3. `setup` - 7 edges
4. `User` - 6 edges
5. `config` - 5 edges
6. `AppServiceProvider` - 4 edges
7. `require` - 4 edges
8. `psr-4` - 4 edges
9. `post-create-project-cmd` - 4 edges
10. `UserFactory` - 4 edges

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

### Community 0 - "Composer Autoload & Core Config"
Cohesion: 0.08
Nodes (25): autoload, autoload-dev, psr-4, psr-4, description, extra, laravel, keywords (+17 more)

### Community 1 - "Composer scripts & Artisan tasks"
Cohesion: 0.08
Nodes (26): scripts, dev, post-autoload-dump, post-create-project-cmd, post-root-package-install, post-update-cmd, pre-package-uninstall, setup (+18 more)

### Community 2 - "Front-end & Build tools"
Cohesion: 0.11
Nodes (17): concurrently, laravel-vite-plugin, devDependencies, concurrently, laravel-vite-plugin, tailwindcss, @tailwindcss/vite, vite (+9 more)

### Community 3 - "Database Seeders"
Cohesion: 0.21
Nodes (7): BookSeder, DatabaseSeeder, GenreSeeder, ReviewSeder, UserSeder, Illuminate\Database\Console\Seeds\WithoutModelEvents, Illuminate\Database\Seeder

### Community 4 - "User & Authentication Domain"
Cohesion: 0.19
Nodes (7): User, UserFactory, Illuminate\Database\Eloquent\Factories\Factory, Illuminate\Database\Eloquent\Factories\HasFactory, Illuminate\Foundation\Auth\User, Illuminate\Notifications\Notifiable, static

### Community 5 - "HTTP Middleware"
Cohesion: 0.44
Nodes (5): CheckAdmin, CheckLogin, Closure, Illuminate\Http\Request, Symfony\Component\HttpFoundation\Response

### Community 6 - "Core Models"
Cohesion: 0.33
Nodes (5): Book, Bookshelf, Genre, Review, Illuminate\Database\Eloquent\Model

### Community 7 - "Composer Dev dependencies"
Cohesion: 0.25
Nodes (8): require-dev, fakerphp/faker, laravel/pail, laravel/pao, laravel/pint, mockery/mockery, nunomaduro/collision, phpunit/phpunit

### Community 8 - "Composer package settings"
Cohesion: 0.29
Nodes (7): pestphp/pest-plugin, php-http/discovery, config, allow-plugins, optimize-autoloader, preferred-install, sort-packages

### Community 10 - "Feature Testing"
Cohesion: 0.40
Nodes (3): Illuminate\Foundation\Testing\TestCase, ExampleTest, TestCase

### Community 11 - "Project PRD & Tech Stack Specs"
Cohesion: 0.33
Nodes (6): Admin Dashboard Features, Bukuku, Custom Authentication & Middleware, Database Schema (Migrations), Laravel Tech Stack, About Laravel Framework

## Knowledge Gaps
- **59 isolated node(s):** `$schema`, `name`, `type`, `description`, `laravel` (+54 more)
  These have ≤1 connection - possible missing edges or undocumented components.
- **4 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `scripts` connect `Composer scripts & Artisan tasks` to `Composer Autoload & Core Config`?**
  _High betweenness centrality (0.070) - this node is a cross-community bridge._
- **Why does `require-dev` connect `Composer Dev dependencies` to `Composer Autoload & Core Config`?**
  _High betweenness centrality (0.024) - this node is a cross-community bridge._
- **Why does `config` connect `Composer package settings` to `Composer Autoload & Core Config`?**
  _High betweenness centrality (0.020) - this node is a cross-community bridge._
- **What connects `$schema`, `name`, `type` to the rest of the system?**
  _59 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `Composer Autoload & Core Config` be split into smaller, more focused modules?**
  _Cohesion score 0.07692307692307693 - nodes in this community are weakly interconnected._
- **Should `Composer scripts & Artisan tasks` be split into smaller, more focused modules?**
  _Cohesion score 0.08 - nodes in this community are weakly interconnected._
- **Should `Front-end & Build tools` be split into smaller, more focused modules?**
  _Cohesion score 0.1111111111111111 - nodes in this community are weakly interconnected._