<?php 
// 1. DATABASE & SESSION SETUP
require_once("database/db.php");

if(!isset($_SESSION['learner_id'])) {
    header("Location: login.php");
    exit();
}

$learner_id = $_SESSION['learner_id'];

// 2. FETCH USER DATA (Standard PHP Compatibility)
$state_res = $conn->query("SELECT * FROM learner_journey_state WHERE learner_id = $learner_id");
$state = $state_res->fetch_assoc();

$user_res = $conn->query("SELECT name FROM learners WHERE learner_id = $learner_id");
$user = $user_res->fetch_assoc();

// 3. FETCH AI RECOMMENDATIONS
$rec_res = $conn->query("SELECT * FROM adaptive_recommendations WHERE learner_id = $learner_id ORDER BY generated_on DESC LIMIT 1");
$rec = $rec_res->fetch_assoc();

$rec_text = isset($rec['recommendation_text']) ? $rec['recommendation_text'] : "Begin Architecture Phase";
$rec_rationale = isset($rec['rationale']) ? $rec['rationale'] : "Current maturity suggests starting OOP design patterns.";

// 4. FETCH LANGUAGE MASTERY DATA
$mastery_query = "SELECT language_used, COUNT(*) as minutes 
                  FROM learning_events 
                  WHERE learner_id = $learner_id 
                  AND event_type = 'TIME_BASED_PRACTICE' 
                  GROUP BY language_used 
                  ORDER BY minutes DESC";
$mastery_result = $conn->query($mastery_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Astraal LXP | Secure Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .glass-card { background: white; border-radius: 2rem; box-shadow: 0 10px 40px rgba(0,0,0,0.03); transition: 0.3s; border: 1px solid #f1f5f9; height: 260px; }
        .active-link { background: #eff6ff; color: #2563eb; font-weight: 800; border-radius: 1rem; }
    </style>
</head>
<body class="bg-[#fcfdfe] flex">

    <aside class="w-72 bg-white border-r min-h-screen p-8 sticky top-0">
        <div class="text-blue-600 font-black text-2xl mb-12 tracking-tighter">ASTRAAL LXP</div>
        <nav class="space-y-3">
            <a href="dashboard.php" class="flex items-center gap-4 p-4 active-link">
                <i class="fas fa-layer-group"></i> Dashboard
            </a>
            <a href="leaderboard.php" class="flex items-center gap-4 p-4 text-slate-400 hover:bg-slate-50 transition rounded-2xl">
                <i class="fas fa-trophy"></i> Leaderboard
            </a>
            <a href="project-studio.php" class="flex items-center gap-4 p-4 text-slate-400 hover:bg-slate-50 transition rounded-2xl">
                <i class="fas fa-laptop-code"></i> Project Studio
            </a>
            <a href="coding-ground.php" class="flex items-center gap-4 p-4 text-slate-400 hover:bg-slate-50 transition rounded-2xl">
                <i class="fas fa-code"></i> Coding Ground
            </a>
            
            <div class="mt-10 pt-10 border-t border-slate-50">
                <a href="#" class="flex items-center gap-2 p-4 border-2 border-dashed border-blue-100 text-blue-400 rounded-2xl font-bold hover:border-blue-400 hover:text-blue-600 transition">
                    <i class="fas fa-plus-circle"></i> Add New User
                </a>
                <a href="logout.php" class="flex items-center gap-4 p-4 text-red-400 hover:bg-red-50 mt-4 transition rounded-2xl">
                    <i class="fas fa-power-off"></i> Logout
                </a>
            </div>
        </nav>
    </aside>

    <main class="flex-1 p-12">
        <header class="flex justify-between items-center mb-12">
            <div>
                <h1 class="text-4xl font-black text-slate-800">Hi, <?php echo $user['name']; ?>!</h1>
                <p class="text-slate-400 font-medium tracking-tight italic">User Session Active | Account #0<?php echo $learner_id; ?></p>
            </div>
            <button onclick="window.location.href='api/recalibrate.php'" class="bg-blue-600 text-white px-8 py-3 rounded-2xl font-bold shadow-xl shadow-blue-100 hover:scale-105 transition">Recalibrate</button>
        </header>

        <div class="grid grid-cols-3 gap-8 mb-12">
            <div class="glass-card p-8">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Skill Maturity</p>
                <h2 class="text-6xl font-black text-slate-800 mt-4"><?php echo round($state['skill_maturity']*100); ?>%</h2>
                <div class="w-full bg-slate-100 h-2 rounded-full mt-10">
                    <div class="bg-blue-500 h-2 rounded-full transition-all duration-1000" style="width: <?php echo ($state['skill_maturity']*100); ?>%"></div>
                </div>
            </div>

            <div class="glass-card p-8">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Thinking</p>
                <h2 class="text-6xl font-black text-slate-800 mt-4"><?php echo round($state['thinking_complexity']*100); ?>%</h2>
                <div class="w-full bg-slate-100 h-2 rounded-full mt-10">
                    <div class="bg-purple-500 h-2 rounded-full" style="width: <?php echo ($state['thinking_complexity']*100); ?>%"></div>
                </div>
            </div>
            
            <div class="glass-card p-8 overflow-y-auto">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Language Mastery</p>
                <div class="space-y-4">
                <?php if ($mastery_result && $mastery_result->num_rows > 0): ?>
                    <?php while($row = $mastery_result->fetch_assoc()): 
                        $lang = strtoupper($row['language_used']);
                        $percent = min(($row['minutes'] / 60) * 100, 100);
                    ?>
                    <div>
                        <div class="flex justify-between text-[10px] font-bold text-slate-500 mb-1">
                            <span><?php echo $lang; ?></span>
                            <span><?php echo $row['minutes']; ?>m</span>
                        </div>
                        <div class="w-full bg-slate-100 h-1.5 rounded-full">
                            <div class="bg-emerald-500 h-1.5 rounded-full" style="width: <?php echo $percent; ?>%"></div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="text-center py-6 text-slate-300">
                        <i class="fas fa-code mb-2"></i>
                        <p class="text-[10px] font-bold uppercase">No Practice Data</p>
                    </div>
                <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="bg-slate-900 rounded-[3rem] p-12 text-white flex justify-between items-center shadow-2xl relative overflow-hidden">
            <div class="relative z-10">
                <span class="bg-blue-600 text-[10px] px-4 py-1 rounded-full font-black uppercase tracking-widest">Next Goal</span>
                <h3 class="text-4xl font-bold mt-6 mb-2"><?php echo $rec_text; ?></h3>
                <p class="text-slate-400 max-w-md font-medium"><?php echo $rec_rationale; ?></p>
            </div>
            <button class="relative z-10 bg-white text-slate-900 px-12 py-5 rounded-3xl font-black shadow-2xl hover:bg-blue-50 transition text-lg">Start Module</button>
            <div class="absolute -right-20 -top-20 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl"></div>
        </div>
    </main>
</body>
</html>