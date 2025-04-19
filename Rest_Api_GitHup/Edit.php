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
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    if (!isset($data['message']) && !isset($data['error'])):

    ?>
        <div class="form-container">
            <h2>Edit Repository</h2>
            <form action="Actions/Actions.php" method="POST">
                <label for="name">Repository Name</label>
                <input type="text" id="name" name="name" value="<?= $data['name'] ?>">
                <input type="hidden" id="hidden" name="full_name" value="<?= $data['full_name'] ?>">
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