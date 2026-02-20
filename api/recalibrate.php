<?php
require_once("../database/db.php");
$learner_id = 1;

// 1. Record the activity in 'learning_events' table
$event_sql = "INSERT INTO learning_events (learner_id, event_type, metadata) 
              VALUES ($learner_id, 'RECALIBRATE_CLICKED', 'User manually triggered update')";
$conn->query($event_sql);

// 2. Simulate AI Update: Increase Skill Maturity by 1%
$update_sql = "UPDATE learner_journey_state SET skill_maturity = skill_maturity + 0.01 WHERE learner_id = $learner_id";
$conn->query($update_sql);

// 3. Redirect back to dashboard to see the real change
header("Location: ../dashboard.php?status=updated");
exit();
?>