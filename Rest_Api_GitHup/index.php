<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function chechSessionStatus()
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
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . "/Actions/$class.php",
        __DIR__ . "/../learning/$class.php"
    ];

    foreach ($paths as $file) {
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
$resopnse = new Actions;
$data = $resopnse->getData();
// if (isset($data['message'])) {

    // var_dump($data);
    // exit();
// }



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>GitHub Repositories</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background-color: #f9f9f9;
        }

        .create-btn {
            background-color: #2ecc71;
        }


        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        th,
        td {
            padding: 14px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            color: white;
            text-decoration: none;
            font-size: 14px;
        }


        .edit-btn {
            background-color: #3498db;
            margin-right: 8px;
            /* margin-bottom:30px; */

        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }


        .delete-btn {
            background-color: #e74c3c;
        }

        .danger {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            font-family: Arial, sans-serif;
            font-size: 16px;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <?php chechSessionStatus() ?>

    <h2 style="text-align:center;">GitHub Repositories</h2>

    <div style="text-align: center; margin-bottom: 20px;">
        <a href="Create.php" class="btn create-btn">+ Create New Repository</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (is_array($data) && $data != null && !isset($data['error']) && !isset($data['message'])):

                foreach ($data as $value):
            ?>
                    <tr>
                        <td><?= $value['full_name'] ?> </td>
                        <td><?= $value['name'] ?></td>
                        <td> <?= $value['description'] ?></td>
                        <td>
                            <div class="action-buttons">
                                <a class="btn edit-btn" href="Edit.php?full_name=<?= $value['full_name'] ?>">Edit</a>
                                <form action="Actions/Actions.php" method="post">
                                    <input type="hidden" name="full_name" value="<?= $value['full_name'] ?> ">
                                    <input type="hidden" id="hidden" name="status" value="delete">
                                    <button type="submit" class="btn delete-btn">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
                <!-- <tr>
                <td>Mustafa-Elfrmawy/traning</td>
                <td>traning</td>
                <td>Example project for practicing PHP curl requests.</td>
                <td>
                    <a href="#" class="btn edit-btn">Edit</a>
                    <a href="#" class="btn delete-btn">Delete</a>
                </td>
            </tr> -->
        </tbody>
    </table>

<?php
            elseif (isset($data["error"])):
                echo "<div  class='danger' role='alert'> .{$data['error']}. 
                 </div>";
                 elseif (isset($data["message"])):
                    // $data = $data["error"];
                    echo "<div  class='danger' role='alert'> .{$data['message']}. 
                     </div>";
            endif;
?>
</body>

</html>