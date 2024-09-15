<?php
// DB CONNECTION
$host = 'localhost';
$dbname = 'fitquest';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

// CONNECTION CHECK
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// POST METHOD CHECK
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $weight = $_POST['weight'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // SQL FOR DATA INPUT
    $sql = "INSERT INTO users (username, password, weight) VALUES ('$username', '$pass', '$weight')";

    if ($conn->query($sql) === TRUE) {
        $message = "Registration successful!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

<!-- HTML REGISTER FORM -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FitQuest - Register</title>
    <link rel="stylesheet" href="css/register.css" />
</head>

<body>
    <header>
        <h1><span class="fit">Fit</span><span class="quest">Quest</span></h1>
    </header>
    <form method="POST" action="register.php">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <label for="email">Weight:</label><br>
        <input type="text" id="weight" name="weight" required><br><br>
        <a href="login.php" class="login-link"><span>Log in</span></a>
        <button type="submit">Register</button>
    </form>
    <?php if (!empty($message)): ?>
        <div class="message">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
</body>

</html>