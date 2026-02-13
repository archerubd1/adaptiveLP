<?php
include("../config/db.php");

$learner_id = $_POST['learner_id'];
$new_rec = $_POST['new_recommendation'];
$reason = $_POST['override_reason'];

$stmt = $conn->prepare("
INSERT INTO faculty_overrides
(learner_id, overridden_recommendation, reason, overridden_by, overridden_on)
VALUES (?, ?, ?, 1, NOW())
");

$stmt->bind_param("iss", $learner_id, $new_rec, $reason);
$stmt->execute();

echo "Override Saved";
?>
