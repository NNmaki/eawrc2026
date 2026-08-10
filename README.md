# 🏁 EAWRC Results Tracker

A custom-built web application for rallying enthusiasts — specifically tailored around **EA Sports WRC** — to record, manage, and analyze stage times. EAWRC Results Tracker serves as a centralized hub to track multi-driver events, compare performance across different car classes, and view real-world stage locations.

[![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=white)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat&logo=laravel&logoColor=white)](https://laravel.com/)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=flat&logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)

🔗 **Live Demo:** https://eawrc.nnmaki.com/
📦 **Repository:** https://github.com/NNmaki/eawrc2026

---

## 📖 Table of Contents

- [Overview](#overview)
- [Key Features](#-key-features)
- [Tech Stack](#-tech-stack)
- [Architecture & Technical Details](#️-architecture--technical-details)
- [Screenshots](#-screenshots)
- [Getting Started](#-getting-started)
- [Roadmap](#-roadmap)
- [License](#-license)

---

## Overview

EAWRC Results Tracker was built to bring structure and clarity to sim-rally time tracking. Whether you're running a full multi-stage event with several drivers and car classes, or just want to log a single stage time on the fly, the app provides a fast, mobile-friendly interface backed by a solid Laravel backend.

---

## 🚀 Key Features

- **Event Management** — Start a new multi-stage rally event, select a specific rally country, input competing drivers, and assign their cars/classes (e.g. WRC, WRC2, Junior WRC).
- **Dynamic Time Entry (Auto-Advance UX)** — JavaScript-enhanced inputs automatically format times (`Minutes'Seconds"Milliseconds`) and advance focus to the next field as you type, reducing input errors.
- **Single Time Logging** — An alternative entry mode for logging a single stage time for any driver, car, and rally without starting a full event.
- **Global & Stage Leaderboards** — Rank driver times globally for a rally event, or drill down to compare performance on individual stages.
- **Real-World Stage Locations** — An integrated map directory with interactive Google Maps links showing where each legendary virtual stage is located in the real world.
- **Fully Mobile-Optimized** — Built mobile-first, so drivers can input times comfortably from their sim rig or phone.

---

## 🧰 Tech Stack

| Layer      | Technology                     |
|------------|---------------------------------|
| Backend    | PHP, Laravel                   |
| Frontend   | JavaScript (Vanilla), Vanilla CSS |
| Database   | MySQL                          |

---

## 🛠️ Architecture & Technical Details

### Backend (Laravel)

The application leverages Laravel's MVC architecture to handle routing, database migrations, and business logic.

- Relational database structure connecting **Rallies**, **Stages**, **Events**, and **StageTimes**.
- RESTful API endpoints for loading stages dynamically and posting stage times via AJAX.
- Background logic for calculating cumulative event times and dynamically rendering leaderboard standings.

### Frontend (JavaScript & CSS)

- Vanilla JS handles dynamic DOM updates, asynchronous AJAX requests (saving times without reloading the page), and powers the auto-advance text-field behavior.
- Vanilla CSS with a custom dark-themed, rally-inspired design system — custom layouts, clip-paths, and micro-interactions for a premium, modern aesthetic.
- Responsive grid layouts and horizontal table scrolling ensure smooth usability on smaller screens.

---

## 📸 Screenshots

<img width="1293" height="918" alt="eawrc1" src="https://github.com/user-attachments/assets/ba1e991c-28e5-4718-8448-5847317c6572" />
<img width="1293" height="892" alt="eawrc2" src="https://github.com/user-attachments/assets/9304f875-a9f3-4846-bae4-a0374e040642" />
<img width="1295" height="914" alt="eawrc3" src="https://github.com/user-attachments/assets/f94fd5ba-c471-4e70-b085-e4cb529294d7" />
<img width="1279" height="913" alt="eawrc4" src="https://github.com/user-attachments/assets/e884e7c1-3b0a-4f58-ae2a-125527879eb4" />


---

## ⚙️ Getting Started

### Prerequisites

- PHP >= 8.1
- Composer
- MySQL
- Node.js & npm (for frontend assets, if applicable)

### Installation

```bash
# Clone the repository
git clone https://github.com/NNmaki/eawrc2026
cd eawrc2026

# Install PHP dependencies
composer install

# Copy environment file and configure database credentials
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# (Optional) Seed the database
php artisan db:seed

# Install and build frontend assets
npm install
npm run build

# Serve the application
php artisan serve
```

---

## 🗺️ Roadmap

- [ ] User authentication & driver profiles
- [ ] Season/championship point standings
- [ ] Data export (CSV/PDF results sheets)
- [ ] Live event mode with real-time leaderboard updates

---

## 📄 License

This project is open source. Add your preferred license here (e.g. MIT).

---

Built with 🏁 by Niko Nmaki 2026 — a hobby project combining a passion for rallying with hands-on Laravel development.

---


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
