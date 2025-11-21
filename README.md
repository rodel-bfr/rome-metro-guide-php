# Rome by Metro: Tour Guide App

A dynamic, full-stack PHP and MySQL application that serves as a tour guide for Rome, organized by metro stations. This project features a public-facing guide and a secure, password-protected admin panel for managing attractions.

---

## ✨ Key Features

* **Interactive Station Guide:** Users can select specific metro stations to dynamically filter and view nearby tourist attractions.
* **Visual Data Presentation:** Features a custom CSS-driven image carousel to showcase attraction photos without relying on heavy JavaScript libraries.
* **Secure Admin Console:** A password-protected backend area restricted to authorized administrators. Passwords are securely hashed using `password_hash()` and verified with `password_verify()`.
* **Content Management System (CMS):** Full CRUD capabilities allowing admins to add, edit, and remove attractions directly from the UI.
* **Relational Database:** Built on a MySQL database with foreign key constraints to link attractions to stations.

---

## 🛠️ Tech Stack

* **Backend:** PHP (Vanilla - No Frameworks)
* **Database:** MySQL (Relational Design)
* **Frontend:** HTML5, CSS3 (Flexbox/Grid), JavaScript
* **Tooling:** Composer (Dependency Management)

---

## 📸 Application Preview

**See the application in action:**

![Home](https://github.com/user-attachments/assets/3115a0ba-7c9d-483e-b071-8d20282e0671)

![Attraction](https://github.com/user-attachments/assets/7f0ce977-c8be-478a-9a09-e9e5df980a13)

**Secure Admin Panel:**
![Admin](https://github.com/user-attachments/assets/20bf36dd-6811-4040-9402-1cdc411b5d7f)

---

## 💾 Database Schema (ERD)

Here is the Entity Relationship Diagram (ERD) for the database, showing the table structures and relationships.

![Database ERD](https://github.com/user-attachments/assets/f0ebcfce-ae32-43a1-9cc0-e8a6e5ee750d)

---

## 🎯 Technical Focus & Architecture

This project is a **functional prototype** designed to demonstrate core Full Stack fundamentals. It represents a "vertical slice" of a full application—meaning the essential features work perfectly, but it is not intended to be a complete commercial product.

**Why Vanilla PHP?**

The application was deliberately built using **Vanilla PHP (No Frameworks)** to demonstrate understanding of web building blocks without relying on pre-built tools.

**Key Engineering Concepts:**
* **Manual MVC Pattern:** Implemented a strict separation of concerns (Logic vs. Presentation) manually, organizing code into distinct PHP controllers and HTML views to ensure maintainability.
* **Raw SQL Security:** Wrote raw database queries using **Prepared Statements (`mysqli`)** to manually handle data sanitization and prevent SQL Injection attacks, rather than relying on an ORM.
* **Session State Management:** Built a custom authentication system handling login sessions, cookies, and password hashing (`password_hash`/`verify`) to demonstrate how stateless HTTP connections are managed securely.

---

## 🚀 Installation & Setup

### 📋 Prerequisites
* **PHP 7.4 or 8.x**
* **MySQL** (via XAMPP, MAMP, or standalone)
* **[Composer](https://getcomposer.org/)**

### 🔧 Installation

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/rodel-bfr/rome-metro-guide-php.git
    cd rome-metro-guide-php
    ```

2.  **Install Dependencies:**
    ```bash
    composer install
    ```

3.  **Database Setup:**
    * Start your Apache and MySQL server (e.g., using XAMPP).
    * Open phpMyAdmin (e.g., `http://localhost/phpmyadmin`).
    * Create a new database named `rome_guide`.
    * Select the `rome_guide` database, click the **"Import"** tab, and upload the `database/rome_guide.sql` file from this repository. This will create all the tables and import the attraction data.

4.  **Environment Variables:**
    * Create a `.env` file in the root directory.
    * Copy the contents of `.env.example` (or just add the lines below) into your new `.env` file and fill in your database details:
        ```
        DB_HOST=localhost
        DB_USER=root
        DB_PASS=
        DB_NAME=rome_guide
        ```

5.  **Create Your Admin User:**
    The `admin_users` table is currently empty for security. You must create your own admin account.

    * **Step 1:** In your code editor, open the `database/hash_password.php` file.
    * **Step 2:** Change the `$plain_password = 'changeme';` variable to your own secret password.
    * **Step 3:** Save the file and run it in your browser (e.g., `http://localhost/rome-guide/hash_password.php`).
    * **Step 4:** **Copy** the long hashed password that appears on the page.
    * **Step 5:** Go back to phpMyAdmin and click on your `admin_users` table.
    * **Step 6:** Click the **"Insert"** tab at the top.
    * **Step 7:** In the `username` field, type your desired username (e.g., `admin`).
    * **Step 8:** In the `password` field, **paste** the hashed password you copied.
    * **Step 9:** Click the "Go" button to create your user.

6.  **Run the application:**
    * Access the site at `http://localhost/rome-guide/`
    * Log into the admin panel at `http://localhost/rome-guide/admin.php`