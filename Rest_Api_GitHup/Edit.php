<?php

declare(strict_types=1);
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


$resoponse =  new Actions;
$data = $resoponse->getRepositre($_GET['full_name']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Repository</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background-color: #f9f9f9;
        }

        .form-container {
            width: 50%;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            color: white;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }

        .save-btn {
            background-color: #2ecc71;
            margin-right: 10px;
        }

        .cancel-btn {
            background-color: #e74c3c;
        }

        .btn-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
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
    <?php 
    if( !isset($data['message']) && !isset($data['error']) ):

        ?>
    <div class="form-container">
        <h2>Edit Repository</h2>
        <form action="Actions/Actions.php" method="POST">
            <label for="name">Repository Name</label>
            <input type="text" id="name" name="name" value="<?=$data['name']?>">
            <input type="hidden" id="hidden" name="full_name" value="<?=$data['full_name']?>">
            <input type="hidden" id="hidden" name="status" value="edit">
            <label for="description">Description</label>    
            <textarea id="description" name="description" rows="4"><?= $data['description'] ?></textarea>
            <div class="btn-group">
                <button type="submit" class="btn save-btn">Save</button>
                <a href="index.php" class="btn cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
    <?php
    elseif (isset($data["error"])):
                echo "<div  class='danger' role='alert'> .{$data['error']}. 
                 </div>";
                 elseif (isset($data["message"])):
                    echo "<div  class='danger' role='alert'> .{$data['message']}. 
                     </div>";
            endif;
            ?>

</body>

</html>