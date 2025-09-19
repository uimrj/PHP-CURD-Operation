# PHP CRUD Contact Management System

A simple **PHP CRUD (Create, Read, Update, Delete) application** for managing contacts. This project uses **PHP, MySQL, PDO, and Dotenv** for configuration. It’s lightweight, easy to use, and designed for beginners who want to practice full-stack PHP development.

---

## 🚀 Features

- Add new contacts with full details:
  - Full Name
  - Nickname
  - Email
  - Phone
  - Address
  - Contact Type (Friend / Business)
- List all contacts in a modern, responsive table.
- Edit existing contacts.
- Delete contacts with confirmation.
- User-friendly messages for success and errors.
- Modern UI with icons and hover effects.

---

## 🛠️ Technologies Used

- PHP 8.x
- MySQL / MariaDB
- PDO for database interactions
- Dotenv for environment configuration
- HTML, CSS, and Font Awesome for UI
- XAMPP (Apache + MySQL)

---

## 📁 Project Structure

```
PHP-CURD/
│
├─ assets/           # CSS and static files
├─ config/           # Database connection and config files
├─ modules/          # CRUD modules (list, create, edit, delete)
├─ vendor/           # Composer dependencies
├─ .env              # Environment variables (DB credentials)
├─ composer.json     # Composer configuration
└─ README.md         # Project documentation
```

---

## ⚡ Installation & Setup

1. **Clone the repository** into your XAMPP `htdocs` folder:

```bash
git clone https://github.com/your-username/PHP-CURD.git
```

2. **Create a MySQL database**:

```sql
CREATE DATABASE crud_db;
```

3. **Create the `contacts` table**:

```sql
CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    nickname VARCHAR(50),
    email VARCHAR(100),
    phone VARCHAR(20) NOT NULL,
    address VARCHAR(255),
    contact_type_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

4. **Create a `.env` file** in the root directory:

```
DB_HOST=localhost
DB_DATABASE=crud_db
DB_USERNAME=root
DB_PASSWORD=
```

5. **Start XAMPP** and enable **Apache** and **MySQL**.

6. **Install dependencies with Composer** (if used):

```bash
composer install
```

7. **Open the project in your browser**:

```
http://localhost/PHP-CURD/modules/contact/list-contact.php
```

---

## ✅ Usage

- **Add Contact:** `create-contact.php`
- **List Contacts:** `list-contact.php`
- **Edit Contact:** `edit-contact.php?id={id}`
- **Delete Contact:** `delete-contact.php?id={id}` (with confirmation)

---

## 📌 Notes

- Ensure **XAMPP’s PHP version >= 8.0** for compatibility.
- Make sure the **`vendor/` directory exists** if using Composer.
- Adjust database credentials in `.env` according to your setup.

---

## 💻 Author

**Rishabh Jain**  
Aspiring PHP & DevOps Engineer | Open-Source Contributor

---
