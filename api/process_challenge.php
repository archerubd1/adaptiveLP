<?php
require_once("../database/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $learner_id = $_SESSION['learner_id'];
    $answer = $_POST['answer'];

    if ($answer == "Success") {
        // Increase Skill Maturity by 3%
        $conn->query("UPDATE learner_journey_state SET skill_maturity = skill_maturity + 0.03 WHERE learner_id = $learner_id AND skill_maturity < 1.0");
        $conn->query("INSERT INTO learning_events (learner_id, event_type) VALUES ($learner_id, 'CHALLENGE_PASSED')");
        header("Location: ../dashboard.php?success=challenge_won");
    } else {
        header("Location: ../dashboard.php?error=challenge_failed");
    }
    exit();
}
?>