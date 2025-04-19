<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create New Repository</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <h2>Create New GitHub Repository</h2>
        <form action="Actions/Actions.php" method="POST">
            <label for="name">Repository Name:</label>
            <input type="text" id="name" name="name" required>
            <input type="hidden" id="name" name="status" value="create">
            <label for="description">Description:</label>
            <textarea id="description" name="description" placeholder="What is this repo about?"></textarea>

            <button type="submit" class="btn">Create</button>
            <a href="index.php" class="btn cancel-btn">Cancel</a>
        </form>
    </div>

</body>

</html>