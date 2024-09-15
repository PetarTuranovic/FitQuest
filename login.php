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
            header("Location: index.php"); // REDIRECT TO index.php
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found!";
    }
}
$conn->close();
?>

<!-- HTML LOGIN FORM -->
<form method="POST" action="login.php">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>