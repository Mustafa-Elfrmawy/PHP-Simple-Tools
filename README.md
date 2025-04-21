# PHP Utility Toolkit

A collection of PHP tools for database handling, HTTP requests, and GitHub API management.

## 📦 Included Tools
1. **[DBHandler](/DBHandler/README.md)** - PDO-based database operations  
2. **[Curl](/Curl/README.md)** - HTTP client wrapper  
3. **[GitHub API Manager](/GitHubAPIManager/README.md)** - GitHub REST API interactions  

## 🚀 Quick Start
```bash
git clone https://github.com/yourusername/repo.git

⚙️ Requirements

    PHP 8.0+

    cURL extension

    GitHub Personal Access Token (for API tools)

📝 Documentation

Each tool has its own dedicated documentation:

    DBHandler

    Curl

    GitHub API Manager



---

### **1. `DBHandler/README.md`**
```markdown
# DBHandler - PDO Wrapper

Lightweight database handler for CRUD operations using PDO.

## 🔧 Methods
| Method | Signature | Description |
|--------|-----------|-------------|
| `select` | `select(PDO $pdo, string $query, array $params = []): array` | Executes SELECT queries |
| `insert` | `insert(PDO $pdo, string $table, array $data): bool` | Inserts records |
| `update` | `update(PDO $pdo, string $table, array $data, string $idColumn, $idValue): bool` | Updates records |
| `delete` | `delete(PDO $pdo, string $table, string $idColumn, $idValue): bool` | Deletes records |

## 💡 Example
```php
require_once 'DBHandler.php';

$pdo = new PDO('mysql:host=localhost;dbname=test', 'user', 'pass');
$users = DBHandler::select($pdo, "SELECT * FROM users WHERE status = ?", [1]);

🛡️ Error Handling

Throws Exception when:

    Column count doesn't match input data

    PDO operations fail


    
---

### **2. `Curl/README.md`**
```markdown
# Curl - HTTP Client

PSR-compatible HTTP request handler with JSON support.

## 🌟 Features
- Supports all HTTP methods (GET/POST/PUT/PATCH/DELETE)
- Automatic header formatting
- JSON/URL-encoded body handling

## 🛠️ Usage
```php
$curl = new Curl();
$response = $curl->curl(
    'POST',
    'https://api.example.com/data',
    ['Content-Type' => 'application/json'],
    ['key' => 'value']
);


📊 Response Handling

Returns:

    array for successful JSON responses

    string containing error message if request fails

⚠️ Notes

    Always closes cURL handle automatically

    Sets CURLOPT_HEADER to true by default




---

### **3. `GitHubAPIManager/README.md`**
```markdown
# GitHub API Manager

PHP class for GitHub REST API interactions.

## 🔑 Authentication
Replace `your_token_here` in:
```php
protected $headers = [
    "Authorization: token your_token_here"
];


📋 Available Methods
Method	Endpoint	HTTP Verb
getData()	/user/repos	GET
getRepositre()	/repos/{owner}/{repo}	GET
create()	/user/repos	POST
update()	/repos/{owner}/{repo}	PATCH
delete()	/repos/{owner}/{repo}	DELETE

🖥️ Web Integration Example

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $actions = new Actions();
    $response = match ($_POST['status']) {
        'create' => $actions->create($_POST),
        'edit' => $actions->update($_POST),
        'delete' => $actions->delete($_POST['full_name'])
    };
}

🔄 Response Format

Always returns associative array:
{
    "success": {"data": "..."},
    "error": {"error": "message"}
}