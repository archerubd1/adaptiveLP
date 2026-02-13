<?php
session_start();
include("database/db.php");

/**
 * In production replace with authenticated session user.
 */
$learner_id = 1;

/**
 * Fetch latest journey state
 */
$state_query = $conn->prepare("
    SELECT * FROM learner_journey_state
    WHERE learner_id = ?
");
$state_query->bind_param("i", $learner_id);
$state_query->execute();
$state_result = $state_query->get_result();
$state = $state_result->fetch_assoc();

/**
 * Fetch top recommendations
 */
$rec_query = $conn->prepare("
    SELECT recommendation_text, rank_score, rationale
    FROM adaptive_recommendations
    WHERE learner_id = ?
    ORDER BY rank_score DESC
    LIMIT 3
");
$rec_query->bind_param("i", $learner_id);
$rec_query->execute();
$rec_result = $rec_query->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Astraal Adaptive Dashboard</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        .card {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }
        .btn {
            padding: 10px 15px;
            background: #0073e6;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<h1>Adaptive Learning Journey Dashboard</h1>

<div class="card">
    <h2>Journey State Overview</h2>

    <?php if($state): ?>
        <p><strong>Intent Score:</strong> <?php echo $state['intent_score']; ?></p>
        <p><strong>Skill Gap Score:</strong> <?php echo $state['skill_gap_score']; ?></p>
        <p><strong>Engagement Score:</strong> <?php echo $state['engagement_score']; ?></p>
        <p><strong>Milestone Progress:</strong> <?php echo $state['milestone_progress']; ?></p>
        <p><strong>Pathway Confidence:</strong> <?php echo $state['pathway_confidence']; ?></p>
    <?php else: ?>
        <p>No journey state computed yet.</p>
    <?php endif; ?>

    <br>
    <a class="btn" href="api/trigger_engine.php">Recalculate Journey</a>
</div>

<div class="card">
    <h2>Top Recommended Actions</h2>

    <?php
    if ($rec_result->num_rows > 0) {
        while ($row = $rec_result->fetch_assoc()) {
            echo "<p><strong>" . htmlspecialchars($row['recommendation_text']) . "</strong></p>";
            echo "<small>Confidence: " . round($row['rank_score'], 2) . "</small><br>";
            echo "<small>Reason: " . htmlspecialchars($row['rationale']) . "</small>";
            echo "<hr>";
        }
    } else {
        echo "<p>No recommendations yet.</p>";
    }
    ?>
</div>

<div class="card">
    <h2>Quick Navigation</h2>

    <a class="btn" href="learning-path/learning_intent.php">Learning Intent</a>
    <a class="btn" href="learning-path/guided_pathways.php">Guided Pathways</a>
    <a class="btn" href="faculty/learner_journey.php">Faculty View</a>
</div>

</body>
</html>
