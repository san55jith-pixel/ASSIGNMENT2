# library-management-crud
This is a simple PHP-based Library Management System that connects to a MySQL database and allows users to perform CRUD (Create, Read, Update, Delete) operations on books and authors.

# 📘 Library Management System (PHP + MySQL CRUD App)

This project is a basic web application built using **PHP and MySQL** that manages a small library system. It allows you to perform **CRUD (Create, Read, Update, Delete)** operations on books and authors.

---

## 🔧 Technologies Used

- **PHP** (Core PHP, no frameworks)
- **MySQL** (Relational Database)
- **HTML** for front-end
- **XAMPP** / LAMP / WAMP for local server

---

## 🧱 Database Structure

The MySQL database is named `assignment` and contains the following tables:

### `authors`
| Field  | Type         | Description         |
|--------|--------------|---------------------|
| id     | INT, PK, AI  | Author ID           |
| name   | VARCHAR(100) | Author Name         |
| bio    | TEXT         | Short Biography     |

### `books`
| Field     | Type         | Description                    |
|-----------|--------------|--------------------------------|
| id        | INT, PK, AI  | Book ID                        |
| title     | VARCHAR(200) | Book Title                     |
| isbn      | VARCHAR(20)  | Unique ISBN number             |
| author_id | INT, FK      | References `authors(id)`       |

---

## 🚀 How to Run the Project

1. **Clone the repository**:
   ```bash
   git clone https://github.com/aadit-renjith/library-management-crud.git
   
2.Import the SQL schema:

Open phpMyAdmin or use MySQL CLI

Run the SQL commands from Database_Commands.txt 
Start your local server (XAMPP/WAMP/LAMP) and place all files inside the htdocs folder.

Access the project in your browser.

**Project Structure**

library-management-crud/
├── index.php        # Read all books
├── create.php       # Create new book
├── update.php       # Edit a book
├── delete.php       # Delete a book


