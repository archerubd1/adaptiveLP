<?php
include("../config/db.php");

$learner_id = 1;
$event_type = $_POST['event_type'] ?? '';
$event_value = 1;

$stmt = $conn->prepare("
    INSERT INTO learning_events
    (learner_id, event_type, event_value, source)
    VALUES (?, ?, ?, 'UI')
");

$stmt->bind_param("isd", $learner_id, $event_type, $event_value);
$stmt->execute();

echo "Event Logged";
?>
