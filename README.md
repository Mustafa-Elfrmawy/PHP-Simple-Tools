# PHP-Simple-Tools

This repository contains a collection of simple and reusable PHP classes created for learning and practicing PHP fundamentals.

Each folder represents a standalone utility class that solves a common programming task:
- **Curl** – A class to simplify sending HTTP requests with cURL.
- **GitHubManager** – A class that interacts with the GitHub REST API (CRUD operations for repositories).
- **DatabaseHandler** – A PDO-based class for interacting with a MySQL database.

## Structure

- `Curl/` - Contains `Curl.php` with a class to send GET, POST, PATCH, and DELETE requests.
- `GitHubManager/` - Contains logic to create, edit, delete, and fetch GitHub repositories using GitHub API.
- `DatabaseHandler/` - Provides a simple abstraction for basic database operations (select, insert, update, delete).

Each folder includes its own `README.md` file explaining how to use the class inside.

---

## 💡 Purpose

The main goal of this repository is to help PHP learners understand:
- How to organize code in classes.
- How to use cURL in PHP.
- How to consume external APIs.
- How to interact with databases using PDO.

---

## 📌 Requirements

- PHP 7.4+
- Composer (if you plan to extend with packages)
