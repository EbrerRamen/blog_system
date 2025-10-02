## Blog System (PHP + MySQL)

Simple blog application built with PHP and MySQL (XAMPP compatible). Includes a public blog with post listings and single post pages, plus a basic admin panel for creating, editing, and deleting posts.

### Features
- Public blog index with post cards and single post view
- Admin authentication (session-based)
- Create, edit, delete posts
- Consistent, responsive styles with a sticky footer

### Requirements
- PHP 7.4+ (works with XAMPP on Windows)
- MySQL / MariaDB
- XAMPP (recommended)

### Getting Started (XAMPP)
1. Clone or copy this repo into your XAMPP htdocs directory:
   - `C:\xampp\htdocs\blog_system`
2. Create a database and import schema:
   - Start Apache and MySQL from XAMPP Control Panel
   - Open phpMyAdmin → create a database (e.g., `blog_db`)
   - Create the required tables (example):
     ```sql
     CREATE TABLE `posts` (
       `id` int NOT NULL AUTO_INCREMENT,
       `title` varchar(255) NOT NULL,
       `content` text NOT NULL,
       `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
       PRIMARY KEY (`id`)
     );

     CREATE TABLE `admin` (
       `id` int NOT NULL AUTO_INCREMENT,
       `username` varchar(100) NOT NULL,
       `password` varchar(255) NOT NULL,
       PRIMARY KEY (`id`)
     );
     ```
   - Insert an admin user (password stored as MD5 in this example app):
     ```sql
     INSERT INTO admin (username, password) VALUES ('admin', MD5('admin'));
     ```
3. Configure database connection:
   - Edit `includes/db.php` and set your MySQL host, user, password, and database name.

4. Visit the app:
   - Public blog: `http://localhost/blog_system/`
   - Single post: `http://localhost/blog_system/post.php?id=1`
   - Admin login: `http://localhost/blog_system/admin/login.php`

### Project Structure
```
blog_system/
├─ admin/
│  ├─ create.php
│  ├─ dashboard.php
│  ├─ delete.php
│  ├─ edit.php
│  ├─ login.php
│  └─ logout.php
├─ assets/
│  └─ css/
│     └─ style.css
├─ includes/
│  ├─ db.php
│  ├─ footer.php
│  └─ header.php
├─ index.php
├─ post.php
└─ README.md
```

### Notes
- For simplicity, the admin password uses MD5 to match the existing schema. For production, use `password_hash`/`password_verify` and HTTPS.
- If CSS changes don’t show up, hard refresh (Ctrl+F5) due to caching.


