<?php
include("../config/db.php");

$result = $conn->query("
SELECT * FROM adaptive_recommendations
WHERE learner_id=1
ORDER BY rank_score DESC
");

while($row = $result->fetch_assoc()){
    echo "<p><b>".$row['recommendation_text']."</b></p>";
    echo "<small>".$row['rationale']."</small><hr>";
}
?>
