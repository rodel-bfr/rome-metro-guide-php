# Rome by Metro: Tour Guide App

A dynamic, full-stack PHP and MySQL application that serves as a tour guide for Rome, organized by metro stations. This project features a public-facing guide and a secure, password-protected admin panel for managing attractions (full CRUD functionality).

---

## ✨ Key Features

* **Dynamic Frontend:** Users can select a metro station to see all nearby tourist attractions.
* **Interactive Carousel:** Attractions are displayed in a sleek, CSS-driven carousel.
* **Secure Admin Panel:** A password-protected backend (`/admin.php`) for site administrators.
* **Full CRUD:** Admins can Create, Read, Update, and Delete attractions.
* **Secure Authentication:** Admin passwords are securely hashed using `password_hash()` and verified with `password_verify()`.
* **Relational Database:** Built on a MySQL database with foreign key constraints to link attractions to stations.

---

## 🛠️ Tech Stack

* **Backend:** PHP (Vanilla)
* **Database:** MySQL (using the `mysqli` extension with prepared statements to prevent SQL injection)
* **Frontend:** HTML5, CSS3 (with Flexbox/Grid)
* **Tooling:** Composer (for package management)

---

## 📸 Application Preview

![Home](https://github.com/user-attachments/assets/3115a0ba-7c9d-483e-b071-8d20282e0671)

![Attraction](https://github.com/user-attachments/assets/7f0ce977-c8be-478a-9a09-e9e5df980a13)

![Admin](https://github.com/user-attachments/assets/20bf36dd-6811-4040-9402-1cdc411b5d7f)

---

## 💾 Database Schema (ERD)

Here is the Entity Relationship Diagram (ERD) for the database, showing the table structures and relationships.

![Database ERD](https://github.com/user-attachments/assets/f0ebcfce-ae32-43a1-9cc0-e8a6e5ee750d)

---

## Installation & Setup

1.  **Clone the repository:**
    ```bash
    git clone [https://github.com/rodel-bfr/rome-metro-guide-php.git](https://github.com/rodel-bfr/rome-metro-guide-php.git)
    cd your-repo-name
    ```

2.  **Install PHP dependencies:**
    (You are using `phpdotenv`, so this is still a required step)
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
    * You can now access the site at `http://localhost/rome-guide/`
    * You can log into the admin panel at `http://localhost/rome-guide/admin.php` with the credentials you just created.