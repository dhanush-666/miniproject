<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('source/abstract-1264071_1920.png');
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.7); 
            width: 300px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 7px;
        }

        input[type="text"],
        input[type="password"] {
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 3px;
            cursor: pointer;
            width: 96%;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $host = "localhost";
            $username = "root";
            $password = "";
            $database = "test";

            // Create a database connection
            $conn = new mysqli($host, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Get user input
            $user = $_POST['username'];
            $pass = $_POST['password'];

            // Perform user authentication (replace with your actual authentication logic)
            $query = "SELECT * FROM user WHERE username = '$user' AND password = '$pass'";
            $result = $conn->query($query);

            if ($result->num_rows == 1) {
                echo '<h2>Login Successful</h2>';
                echo '<p>Welcome, ' . htmlspecialchars($user) . '!</p>';
                echo '<button onclick="location.href=\'footer.html\'">Continue</button>';
            } else {
                echo '<h2>Login Failed</h2>';
                echo '<p>Invalid username or password. Please try again.</p>';
                echo '<button onclick="location.href=\'login.php\'">Go to Login</button>';
            }

            $conn->close();
        } else {
        ?>
        <h2>Login</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <br>
            <button type="submit">Login</button>
        </form>
        <?php
        }
        ?>
    </div>
</body>
</html>
