<?php
require_once("../database/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $learner_id = intval($_POST['learner_id']);
    $event_type = $_POST['event_type'];
    $event_value = floatval($_POST['event_value']);
    $source = $_POST['source'];

    $stmt = $conn->prepare("INSERT INTO learning_events 
        (learner_id, event_type, event_value, source, created_at)
        VALUES (?, ?, ?, ?, NOW())");

    $stmt->bind_param("isds", $learner_id, $event_type, $event_value, $source);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
}

$conn->close();
?>