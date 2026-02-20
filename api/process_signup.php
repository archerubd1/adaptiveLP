<?php
require_once("../database/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // 1. Insert New Learner
    $sql_user = "INSERT INTO learners (name, email) VALUES ('$name', '$email')";
    
    if ($conn->query($sql_user)) {
        // Get the newly created ID
        $new_id = $conn->insert_id;

        // 2. Initialize Journey State (10% start)
        // Note: Using float values for decimal/percentage columns
        $sql_state = "INSERT INTO learner_journey_state (learner_id, skill_maturity, thinking_complexity, collaboration_index) 
                      VALUES ($new_id, 0.10, 0.10, 0.10)";
        $conn->query($sql_state);

        // 3. Log the Registration Event
        $conn->query("INSERT INTO learning_events (learner_id, event_type) VALUES ($new_id, 'USER_REGISTERED')");

        // 4. Set Session and Redirect to Dashboard
        $_SESSION['learner_id'] = $new_id;
        header("Location: ../dashboard.php?welcome=true");
        exit();
    } else {
        echo "Database Error: " . $conn->error;
    }
}
?>