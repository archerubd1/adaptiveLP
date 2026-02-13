<?php
$learner_id = 1;
exec("python3 /home/username/python/run_engine.py $learner_id");
header("Location: ../learning-path/guided_pathways.php");
?>
