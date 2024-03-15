<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Upload PHP and MySQL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #7335b7;
        }

        .container {
            width: 500px;
            height: 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-size: 20px;
        }

        .container h2 {
            margin-top: 0;
            text-align: center;
           
            
        }

        .container form {
            display: flex;
            flex-direction: column;
            font-size: 20px;
        }

        .container form input[type="file"],
        .container form input[type="text"],
        .container form input[type="submit"] {
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 20px;
        }

        .container form input[type="submit"] {
            background-color: #f8842b;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .container form input[type="submit"]:hover {
            background-color: #7335b7;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Video Upload</h2>
        <a href="view.php">View Videos</a>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?= $_GET['error'] ?></p>
        <?php } ?>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="my_video" required>
            <input type="text" name="caption" placeholder="Enter Caption" required>
            <input type="submit" name="submit" value="Upload">
        </form>
    </div>
</body>
</html>
