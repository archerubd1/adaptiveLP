<?php
require_once("../database/db.php");
header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['learner_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Session expired. Please login.']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $learner_id = $_SESSION['learner_id'];
    $project_name = $conn->real_escape_string($_POST['project_name']);
    $language = $conn->real_escape_string($_POST['language']);

    // Check if name is empty
    if (empty($project_name)) {
        echo json_encode(['status' => 'error', 'message' => 'Project name is required.']);
        exit();
    }

    // Insert into database
    $sql = "INSERT INTO learner_projects (learner_id, project_name, language) VALUES ('$learner_id', '$project_name', '$language')";

    if ($conn->query($sql)) {
        echo json_encode([
            'status' => 'success', 
            'message' => 'Project saved successfully!',
            'new_id' => $conn->insert_id
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $conn->error]);
    }
}
?>