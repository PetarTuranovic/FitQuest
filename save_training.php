<?php
session_start();

// USER LOGIN CHECK
if (!isset($_SESSION['userid'])) {
    echo "You must be logged in to save training.";
    exit();
}

require 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['userid'];
    $training_type = $_POST['training_type'];
    $fatigue = $_POST['fatigue'];
    $duration = $_POST['duration'];
    $weight = isset($_POST['start_weight']) ? $_POST['start_weight'] : null;
    $training_date = $_POST['training_date'];

    $sql = "INSERT INTO training (user_id, training_type, fatigue_level, duration_minutes, start_weight, training_date) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "Prepare failed: " . $conn->error;
        exit();
    }

    // Bind parameters
    $stmt->bind_param("isiiis", $user_id, $training_type, $fatigue, $duration, $weight, $training_date);

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
                echo "Prepare failed: " . $conn->error;
                exit();
            }

            $stmt_exercise->bind_param("isii", $training_id, $exercise_type, $num_series, $num_reps);
            if (!$stmt_exercise->execute()) {
                echo "Execute failed: " . $stmt_exercise->error;
                exit();
            }
        }

        echo "Training finished successfully!";
    } else {
        echo "An error occurred while saving the training. Please try again.";
    }

    $stmt->close();
}

$conn->close();
