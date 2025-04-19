<?php

class UploadCheckS
{
    private function puploadFile()

    {
        spl_autoload_register(function ($class) {
            $paths = [
                __DIR__ . "/$class.php",
                __DIR__ . "/../learning/$class.php"
            ];

            foreach ($paths as $file) {
                if (file_exists($file)) {
                    require_once $file;
                    return;
                }
            }
        });
    }
    private function pChechSessionStatus()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['status'])) {
            switch ($_SESSION['status']) {
                case 'success':
                    echo "<p style='color: green;'> Operation completed successfully.</p>";
                    break;
                case 'error':
                    echo "<p style='color: red;'> An error occurred during the operation.</p>";
                    break;
                default:
                    break;
            }
            unset($_SESSION['status']);
        }
    }

    public  function uploadFile()
    {
        $this->puploadFile();
    }

    public  function chechSessionStatus()
    {
        $this->pChechSessionStatus();
    }
}

$render = new UploadCheckS();
$render->uploadFile();
$render->chechSessionStatus();
