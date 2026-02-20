<?php
require_once("../database/db.php");
header('Content-Type: application/json');

if (!isset($_SESSION['learner_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $learner_id = $_SESSION['learner_id'];
    $project_id = intval($_POST['project_id']);

    // Ensure the project belongs to the logged-in user before deleting
    $sql = "DELETE FROM learner_projects WHERE id = $project_id AND learner_id = $learner_id";

    if ($conn->query($sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Project deleted']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error']);
    }
}
?>