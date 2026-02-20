<?php
// Include database connection and start session
require_once("../database/db.php");

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['learner_id'])) {
    
    // Sanitize input for PHP 5.6 security
    $learner_id = mysqli_real_escape_string($conn, $_POST['learner_id']);
    
    // Store the selected user ID in a session variable
    $_SESSION['learner_id'] = $learner_id;
    
    // Log the login event for the "Real Account"
    $conn->query("INSERT INTO learning_events (learner_id, event_type) VALUES ($learner_id, 'USER_LOGIN')");
    
    // Redirect the user to their private dashboard
    header("Location: ../dashboard.php");
    exit();
} else {
    // If something went wrong, send back to login page
    header("Location: ../login.php?error=invalid_access");
    exit();
}
?>