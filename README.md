<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Warehouse Management Backend API

Warehouse Management Backend API is a RESTful API built using Laravel 12 and MySQL.

This system supports multi-role access control for Manager and Keeper in managing warehouse operations, merchants, products, and transactions.

---

## 🚀 Features

- Authentication System
- Role-Based Access Control (Manager & Keeper)
- User & Role Management
- Category Management
- Product Management
- Warehouse Management
- Merchant Management
- Transaction Management
- RESTful API Architecture
- Secure Middleware Protection

---

## 👥 Roles & Permissions

### 👨‍💼 Manager (Full Access)

Manager has full CRUD access to:

- Users
- Roles
- Keepers
- Categories
- Products
- Warehouses
- Warehouse Products
- Merchants
- Merchant Products
- Transactions

### 👷 Keeper (Restricted Access)

Keeper can:

- Read Categories
- Read Assigned Merchant Data
- Read Assigned Product Data
- Create, Read, Update Transactions

---

## 🏗️ Tech Stack

- Laravel 12
- MySQL (MAMP)
- Eloquent ORM
- REST API
- Vite
- NPM

---

## 📦 Installation Guide

### 1️⃣ Clone Repository

```bash
git clone https://github.com/your-username/warehouse-management-backend.git
```

### 2️⃣ Navigate to Project Folder

```bash
cd warehouse-management-backend
```

### 3️⃣ Install Dependencies

```bash
composer install
npm install
```

### 4️⃣ Setup Environment File

```bash
cp .env.example .env
```

Update database configuration:

```
DB_DATABASE=warehouse_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5️⃣ Generate Application Key

```bash
php artisan key:generate
```

### 6️⃣ Run Migration

```bash
php artisan migrate
```

### 7️⃣ Run Server

```bash
php artisan serve
```

### 8️⃣ Run Vite

```bash
npm run dev
```

---

## 📡 API Architecture

This project follows RESTful principles:

- GET → Retrieve data
- POST → Create data
- PUT/PATCH → Update data
- DELETE → Remove data

All protected routes use authentication middleware.

---

## 🎯 Project Purpose

This project was developed as backend training to implement:

- Multi-role access control
- Complex relational database design
- API-based architecture
- Warehouse and inventory business logic
- Secure backend system design

---

## 👨‍💻 Author

Betran Arya Pramuja, S.kom

---

## 📄 License

This project is developed for educational purposes.
