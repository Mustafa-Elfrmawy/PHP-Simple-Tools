<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'Actions/UploadCheckSession.php';/* return runder object ave a 2 function */

$resopnse = new Actions;
$data = $resopnse->getData();




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>GitHub Repositories</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php $render->chechSessionStatus() ?>

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