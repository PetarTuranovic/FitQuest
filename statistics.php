<?php
session_start();

require 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $month = $_POST['month'];
    $year = $_POST['year'];
    $user_id = $_SESSION['userid'];

    // SQL query to get training data for the selected month and year
    $sql = "SELECT t.training_date, e.exercise_type, SUM(e.number_of_series * e.number_of_reps) AS total_reps
            FROM training t
            JOIN exercise e ON t.training_id = e.training_id
            WHERE t.user_id = ? AND MONTH(t.training_date) = ? AND YEAR(t.training_date) = ?
            GROUP BY WEEK(t.training_date), e.exercise_type
            ORDER BY WEEK(t.training_date)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $user_id, $month, $year);
    $stmt->execute();
    $result = $stmt->get_result();

    $training_data = [];
    while ($row = $result->fetch_assoc()) {
        $week = date('W', strtotime($row['training_date']));
        $exercise_type = $row['exercise_type'];
        if (!isset($training_data[$week])) {
            $training_data[$week] = [];
        }
        if (!isset($training_data[$week][$exercise_type])) {
            $training_data[$week][$exercise_type] = 0;
        }
        $training_data[$week][$exercise_type] += $row['total_reps'];
    }

    $stmt->close();
    $conn->close();

    // Generate HTML for results
    if (!empty($training_data)) {
        foreach ($training_data as $week => $exercises) {
            echo '<div class="item">';
            echo "<h3>Week " . htmlspecialchars($week) . "</h3>";
            echo "<ul>";
            foreach ($exercises as $type => $total_reps) {
                echo "<li>" . htmlspecialchars($type) . ": " . htmlspecialchars($total_reps) . " reps</li>";
            }
            echo "</ul>";
            echo "</div>";
        }
    } else {
        echo "<p>No training data found for the selected month and year.</p>";
    }
}
