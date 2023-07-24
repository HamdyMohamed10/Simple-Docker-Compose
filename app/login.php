<?php
    

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Replace with your own database credentials
        $servername = 'db';
        $username_db = 'root';
        $password_db = 'password';
        $dbname = 'hamdydb';

        $conn = mysqli_connect($servername, $username_db, $password_db, $dbname);

        if (!$conn) {
            die('Connection failed: ' . mysqli_connect_error());
        }

        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['username'] = $username;
            header('Location: search.php');
            exit;
        } else {
            $error = 'Invalid username or password';
        }

        mysqli_close($conn);
    }
    ?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }
        .login-box {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            max-width: 400px;
            padding: 20px;
        }
        .login-box h2 {
            margin-top: 0;
        }
        .login-box label {
            display: block;
            margin-bottom: 5px;
        }
        .login-box input[type="text"],
        .login-box input[type="password"] {
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            display: block;
            margin-bottom: 20px;
            padding: 10px;
            width: 100%;
        }
        .login-box input[type="submit"] {
            background-color: #4CAF50;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            padding: 10px 20px;
        }
        .login-box input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error-message {
            color: #f00;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="login-box">
        <h2>Login</h2>
        <?php if (isset($_POST['submit'])){
            if ($error): ?>
        
            <p class="error-message"><?php echo $error ?></p>
        <?php endif ?>
        <?php }?>
        <form method="post">
            <label>Username:</label>
            <input type="text" name="username">
            <label>Password:</label>
            <input type="password" name="password">
            <input type="submit" name="submit" value="Log In">
        </form>
    </div>

</body>
</html>
