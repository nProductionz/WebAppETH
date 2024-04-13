<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $command = $_POST['command'];
    // Execute the command (unsafely)
    $output = shell_exec("ping -c 4 " . $command);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Command Injection Demo</title>
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
        input[type="text"] {
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
        .output {
            width: 70%;
            margin: 20px auto;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Command Injection Demo</h1>
    <form method="post" action="">
        <input type="text" name="command" placeholder="Enter a domain to ping">
        <input type="submit" value="Ping">
    </form>
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <div class="output">
            <h2>Output:</h2>
            <pre><?php echo htmlentities($output); ?></pre>
        </div>
    <?php endif; ?>
</body>
</html>
