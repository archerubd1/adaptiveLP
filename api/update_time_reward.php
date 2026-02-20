<?php
// Refresh the session lifetime to 1 hour on every call
session_set_cookie_params(3600);
require_once("../database/db.php");
header('Content-Type: application/json');

if (!isset($_SESSION['learner_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit();
}

$learner_id = $_SESSION['learner_id'];
$language = isset($_GET['lang']) ? $conn->real_escape_string($_GET['lang']) : 'unknown';

// Increase maturity by 0.5% every heartbeat (30 seconds)
$increment = 0.005; 

$update_sql = "UPDATE learner_journey_state 
               SET skill_maturity = skill_maturity + $increment 
               WHERE learner_id = $learner_id";

if ($conn->query($update_sql)) {
    $res = $conn->query("SELECT skill_maturity FROM learner_journey_state WHERE learner_id = $learner_id");
    $row = $res->fetch_assoc();
    
    echo json_encode([
        'status' => 'success',
        'new_maturity' => $row['skill_maturity'],
        'language' => $language
    ]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Sync failed']);
}
?>