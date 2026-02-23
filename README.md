# 🏠 EasyColoc – Colocation Expense Management Platform

EasyColoc is a full-stack web application designed to simplify shared housing financial management.  
It allows roommates to track shared expenses, automatically calculate balances, and clearly visualize “who owes who”, eliminating manual calculations and financial conflicts.

---

## 🎯 Project Objective

The goal of this project is to develop the backend of a web platform using Laravel MVC architecture, while implementing:

- Clean architecture (Model – View – Controller)
- Business logic implementation
- Role-based authorization
- Secure data validation
- Relational database modeling
- Git version control

---

## 🚀 Core Features

### 👤 User Management
- Registration & authentication
- Profile management
- Role system: Member / Owner / Global Admin
- Automatic promotion of first registered user as Global Admin
- Ban / Unban system

### 🏠 Colocation Management
- Create, update, cancel colocations
- Invitation system via secure token
- One active colocation per user restriction
- Member departure & owner removal logic

### 💸 Expense Management
- Add / delete shared expenses
- Categories management
- Monthly expense filtering
- Automatic balance calculation
- Simplified settlement view ("Who owes who")
- Mark payments as completed

### ⭐ Reputation System
- +1 / -1 based on financial behavior
- Automatic adjustment rules when members leave with debt

### 📊 Admin Dashboard
- Global statistics (users, colocations, expenses)
- User moderation system

---

## 🧠 Business Logic Highlights

- Automatic individual share calculation  
- Real-time debt balance recalculation  
- Settlement simplification algorithm  
- Debt redistribution rules for complex scenarios  

---

## 🛠️ Technical Stack

- **Backend:** Laravel 10 (PHP)
- **Architecture:** Monolithic MVC
- **Database:** MySQL / PostgreSQL
- **ORM:** Eloquent
- **Frontend:** Blade + TailwindCSS
- **Authentication:** Laravel Breeze / Jetstream
- **Version Control:** Git / GitHub

---

## 🔐 Security Implementation

- CSRF protection
- XSS protection via Blade escaping
- Server-side validation (Form Requests)
- Role-based authorization using Policies
- Prepared queries via Eloquent ORM

---

## 💻 Installation Guide

```bash
git clone https://github.com/ezraidimariam/EasyColoc-WebApp.git
cd EasyColoc-WebApp-Laravel
composer install
npm install && npm run dev
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve