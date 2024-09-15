<?php
// Povezivanje sa bazom podataka
$host = 'localhost';
$dbname = 'fitquest';
$username = 'root'; // tvoj phpMyAdmin username
$password = ''; // tvoja phpMyAdmin lozinka

$conn = new mysqli($host, $username, $password, $dbname);

// Proveri da li je povezan
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Provera da li je formu poslao POST metod
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $weight = $_POST['weight'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripcija lozinke

    // SQL upit za unos podataka
    $sql = "INSERT INTO users (username, password, weight) VALUES ('$username', '$pass', '$weight')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

<!-- HTML forma za registraciju -->
<form method="POST" action="register.php">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>
    <label for="email">Weight:</label><br>
    <input type="text" id="weight" name="weight" required><br><br>
    <button type="submit">Register</button>
</form>