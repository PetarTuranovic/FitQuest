<?php
session_start(); // START NEW SESSION

// DB CONNECTION
$host = 'localhost';
$dbname = 'fitquest';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

// DB CONNECTION CHECK
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // USERNAME SEARCH
    $sql = "SELECT * FROM users WHERE username='$user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // PASSWORD CHECK
        if (password_verify($pass, $row['password'])) {
            $_SESSION['username'] = $user; // STORING USERNAME IN SESSION
            $_SESSION['userid'] = $row['userid'];
            header("Location: index.php"); // REDIRECT TO index.php
            exit();
        } else {
            $message = "Invalid password!";
        }
    } else {
        $message = "No user found!";
    }
}
$conn->close();
?>

<!-- HTML LOGIN FORM -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log in</title>
    <link rel="stylesheet" href="css/login.css" />
</head>

<body>

    <header>
        <h1><span class="fit">Fit</span><span class="quest">Quest</span></h1>
    </header>
    <form method="POST" action="login.php">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <a href="register.php" class="signup-link"><span>Sign up</span></a>
        <button type="submit">Login</button>
    </form>
    <?php if (!empty($message)): ?>
        <div class="message">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
</body>

</html>