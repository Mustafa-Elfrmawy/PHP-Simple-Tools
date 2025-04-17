<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Repository</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background-color: #f9f9f9;
        }

        .container {
            width: 60%;
            margin: auto;
            background-color: white;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .btn {
            margin-top: 20px;
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 18px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #2980b9;
        }
    </style>
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
        </form>
    </div>

</body>
</html>
