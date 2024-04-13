<?php
session_start();

$request_method = $_SERVER["REQUEST_METHOD"] ?? '';

// Check if the user is already logged in
if(isset($_SESSION['username'])) {
    header("Location: welcome.php");
    exit;
}

// Check if the form is submitted
if($request_method == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Dummy authentication - Replace this with actual authentication logic
    if($username === 'admin' && $password === 'password') {
        // Store username in session and redirect to welcome page
        $_SESSION['username'] = $username;
        header("Location: welcome.php");
        exit;
    } else {
        $login_error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        h1 {
            text-align: center;
        }
        form {
            width: 50%;
            margin: 0 auto;
            text-align: center;
        }
        input[type="text"], input[type="password"] {
            width: 60%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Login</h1>
    <form method="post" action="">
        <input type="text" name="username" placeholder="Username"><br>
        <input type="password" name="password" placeholder="Password"><br>
        <input type="submit" value="Login">
    </form>
    <?php if(isset($login_error) && $login_error): ?>
        <p class="error">Invalid username or password</p>
    <?php endif; ?>
</body>
</html>
