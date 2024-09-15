<?php
session_start();

var_dump($_SESSION);
// Proveri da li je korisnik ulogovan
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

// Povezivanje sa bazom podataka
$host = 'localhost';
$dbname = 'fitquest';
$username = 'root'; // Postavi prema tvojoj konfiguraciji
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

// Proveri da li je veza uspešna
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['userid'];
$training_type = $_POST['training_type'];
$fatigue = $_POST['fatigue'];
$duration = $_POST['duration'];
$weight = $_POST['weight'];
$training_date = $_POST['training_date'];

$sql = "INSERT INTO training (user_id, training_type, fatigue_level, duration_minutes, start_weight, training_date) 
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("isidi", $user_id, $training_type, $fatigue, $duration, $weight, $training_date);

if ($stmt->execute()) {
    $training_id = $conn->insert_id;

    $exercise_types = $_POST['exercise_type'];
    $series = $_POST['series'];
    $reps = $_POST['reps'];

    for ($i = 0; $i < count($exercise_types); $i++) {
        $exercise_type = $exercise_types[$i];
        $num_series = $series[$i];
        $num_reps = $reps[$i];

        $sql_exercise = "INSERT INTO exercise (training_id, exercise_type, number_of_series, number_of_reps) 
                         VALUES (?, ?, ?, ?)";
        $stmt_exercise = $conn->prepare($sql_exercise);

        if (!$stmt_exercise) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt_exercise->bind_param("isii", $training_id, $exercise_type, $num_series, $num_reps);
        if (!$stmt_exercise->execute()) {
            die("Execute failed: " . $stmt_exercise->error);
        }
    }

    print_r($_POST); // For debugging purposes
    exit();
} else {
    die("Execute failed: " . $stmt->error);
}

//$stmt->close();
//$conn->close();
