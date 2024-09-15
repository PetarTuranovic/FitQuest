<?php
session_start(); // Pokretanje sesije

// Povezivanje sa bazom podataka
$host = 'localhost';
$dbname = 'fitquest';
$username = 'root'; 
$password = ''; 

$conn = new mysqli($host, $username, $password, $dbname);

// Provera povezivanja sa bazom
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Pretraga korisnika po username
    $sql = "SELECT * FROM users WHERE username='$user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Provera lozinke
        if (password_verify($pass, $row['password'])) {
            $_SESSION['username'] = $user; // Čuvanje korisničkog imena u sesiji
            header("Location: index.php"); // Redirekcija na glavnu stranicu
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

<!-- HTML forma za login -->
<form method="POST" action="login.php">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>