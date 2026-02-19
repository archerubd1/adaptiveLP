<?php
require_once("database/db.php");
$learner_id = 1;

// Fetch Thinking Complexity
$sql = "SELECT thinking_complexity FROM learner_journey_state WHERE learner_id = $learner_id";
$res = $conn->query($sql);
$data = $res->fetch_assoc();
$complexity = ($data['thinking_complexity'] * 100);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Critical Thinking | Astraal LXP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-slate-50 flex">
    <aside class="w-64 bg-white border-r min-h-screen p-6 sticky top-0">
        <div class="text-blue-600 font-black text-2xl mb-10">ASTRAAL LXP</div>
        <nav class="space-y-2">
            <a href="dashboard.php" class="block p-4 text-slate-500 hover:bg-slate-50 rounded-2xl">Dashboard</a>
            <a href="critical-thinking.php" class="block p-4 bg-blue-50 text-blue-600 rounded-2xl font-bold shadow-sm">Critical Thinking</a>
        </nav>
    </aside>

    <main class="flex-1 p-10">
        <h1 class="text-3xl font-black text-slate-800 mb-8">Cognitive Analysis</h1>
        <div class="bg-white p-10 rounded-[3rem] shadow-xl border border-slate-100 max-w-2xl">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Current Complexity</p>
            <h2 class="text-6xl font-black text-blue-600 mb-6"><?php echo $complexity; ?>%</h2>
            <p class="text-slate-600 leading-relaxed">Your ability to handle architectural patterns is currently rated at <b><?php echo $complexity; ?>%</b>. Complete the Advanced PHP module to reach 90%.</p>
        </div>
    </main>
</body>
</html>