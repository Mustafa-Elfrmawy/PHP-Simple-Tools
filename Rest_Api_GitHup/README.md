# GitHub API Manager - PHP Class

This PHP class `Actions` provides a simple interface to interact with the [GitHub REST API](https://docs.github.com/en/rest), allowing you to manage repositories with ease using cURL.

## ✨ Features

- ✅ List all repositories
- ✅ Get a specific repository
- ✅ Create new repository
- ✅ Edit repository details
- ✅ Delete a repository
- ✅ Basic response/error handling

## 📦 Requirements

- PHP >= 7.4
- A valid GitHub **Personal Access Token**
- `Curl` class (must be implemented separately)

## 📂 Folder Structure

Actions/ │ ├── Actions.php # Main class for GitHub repository operations ├── README.md # This file └── (depends on Curl.php file)


## 🚀 Usage Example

### 1. Initialize the class

```php
require_once 'Actions.php';
$actions = new Actions();

2. Get all repositories

$repos = $actions->getData();
print_r($repos);

3. Get a specific repository

$repo = $actions->getRepositre("username/repository-name");
print_r($repo);

4. Create a new repository

$newRepo = [
    "name" => "test-repo",
    "description" => "My test repository",
    "private" => false
];
$response = $actions->create($newRepo);
print_r($response);

5. Update a repository

$update = [
    "full_name" => "username/test-repo",
    "description" => "Updated description"
];
$response = $actions->update($update);
print_r($response);

6. Delete a repository

$response = $actions->delete("username/test-repo");
print_r($response);

🔒 Important Notes

    Make sure to replace "Authorization: token your_token" in the class with your actual GitHub personal access token.

    Avoid committing your token to a public repository.

    The class uses session-based status feedback — adapt it to your framework or project structure as needed.

    🧠 Author: You
    📅 Version: 1.0
    📘 License: MIT

