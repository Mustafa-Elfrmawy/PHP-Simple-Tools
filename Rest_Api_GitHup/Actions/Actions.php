<?php

declare(strict_types=1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Actions
{
    protected $headers = [
        "Content-Type: application/json",
        "User-Agent: example rest api",
        "Authorization: token your_token_here",
    ];
    public function __construct()
    {
        require_once __DIR__ . "/../../learning/Curl.php";
    }

    public function getData(): array
    {
        $ch = new Curl();
        $response = $ch->curl("GET", "https://api.github.com/user/repos", $this->headers);
        return  $this->returnResponse($response);
    }
    public function getRepositre(string $full_name): array
    {
        $ch = new Curl();
        $full_name = $this->validate($full_name);
        $response = $ch->curl("GET", "https://api.github.com/repos/{$full_name['owner']}/{$full_name['repo']}", $this->headers);
        return $this->returnResponse($response);
    }
    public function update(array $post): array
    {

        $ch = new Curl();
        $full_name = $this->validate($post['full_name']);
        $response = $ch->curl("patch", "https://api.github.com/repos/{$full_name['owner']}/{$full_name['repo']}", $this->headers, $post);
        return $this->returnResponse($response);
    }
    public function delete(string $post): null | array
    {
        $ch = new Curl();
        $full_name = $this->validate($post);
        $response = $ch->curl("delete", "https://api.github.com/repos/{$full_name['owner']}/{$full_name['repo']}", $this->headers);
        return $response;
    }

    public function create(array $post): array
    {
        $ch = new Curl();
        $response = $ch->curl("post", "https://api.github.com/user/repos", $this->headers, $post);
        return $this->returnResponse($response);
    }

    public function return(array $response)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($response['error']) && !isset($response['message'])) {
            session_start();
            $_SESSION["status"] = "success";
            header("Location: ../index.php");
            exit();
        } else {
            $_SESSION["status"] = "error";
            header("Location: ../index.php");
            exit();
        }
    }

    public function validate(string $full_name): array
    {
        $full_name = trim($full_name);
        list($owner, $repo) = explode("/", $full_name);
        $owner = urlencode($owner);
        $repo = urlencode($repo);
        return ["owner" => $owner, "repo" => $repo];
    }

    public function returnResponse(array | string | null $response): array
    {
        return (is_array($response)) ? $response :  ["error" => "Sorry, an error occurred while retrieving the data or The link may be incorrect. Please try again later."];
    }
}








if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $Actions = new Actions;
    switch ($_POST['status']) {
        case "create":
            $response = $Actions->create($_POST);
            $Actions->return($response);
            break;
        case "edit":
            $response = $Actions->update($_POST);
            $Actions->return($response);
            break;
        case "delete":
            $response = $Actions->delete($_POST['full_name']);
            $response["must_be"] = "123"; /* becouse the function parameters must be to array we need to check the response */
            $Actions->return($response);
            break;
        default:
            break;
    }
}
