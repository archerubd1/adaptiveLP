<?php
require_once("../database/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $learner_id = $_SESSION['learner_id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    
    // 1. Log the Project Event
    $conn->query("INSERT INTO learning_events (learner_id, event_type) VALUES ($learner_id, 'PROJECT_SUBMITTED')");

    // 2. Reward: Increase Skill Maturity by 5% (0.05)
    $update_sql = "UPDATE learner_journey_state 
                   SET skill_maturity = skill_maturity + 0.05, 
                       thinking_complexity = thinking_complexity + 0.02 
                   WHERE learner_id = $learner_id AND skill_maturity < 1.00";
    
    if($conn->query($update_sql)) {
        header("Location: ../leaderboard.php?success=project_added");
        exit();
    }
}
?>