<?php
require_once("database/db.php");
$learner_id = 1;

// Fetch current skill maturity for the 3D cards
$sql = "SELECT skill_maturity FROM learner_journey_state WHERE learner_id = $learner_id";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
$maturity = ($data['skill_maturity'] * 100);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Learning Path | Astraal LXP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .step-card { 
            transition: all 0.3s ease; 
            border-bottom: 4px solid transparent;
        }
        .step-card:hover { 
            transform: translateY(-10px); 
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .active-glow { border-bottom-color: #3b82f6; }
        .declared-glow { border-bottom-color: #f97316; }
    </style>
</head>
<body class="bg-slate-50 flex">

    <aside class="w-64 bg-white border-r min-h-screen p-6 sticky top-0">
        <div class="text-blue-600 font-black text-2xl mb-10 tracking-tighter">ASTRAAL LXP</div>
        <nav class="space-y-2">
            <a href="dashboard.php" class="flex items-center gap-3 p-3 text-slate-500 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
            <a href="learning-path.php" class="flex items-center gap-3 p-3 bg-blue-50 text-blue-600 rounded-xl font-bold shadow-sm">
                <i class="fas fa-route"></i> Learning Path
            </a>
        </nav>
    </aside>

    <main class="flex-1 p-10">
        <header class="mb-10">
            <h1 class="text-2xl font-bold text-slate-800 flex items-center gap-3">
                <i class="fas fa-network-wired text-blue-500"></i> 
                Learning Journey Orchestration
            </h1>
        </header>

        <div class="grid grid-cols-4 gap-6 mb-12">
            <div class="bg-white p-6 rounded-2xl shadow-sm step-card declared-glow text-center">
                <i class="fas fa-bullseye text-orange-500 text-3xl mb-4"></i>
                <h3 class="font-bold text-slate-700 text-sm">Learning Intent</h3>
                <span class="mt-3 inline-block bg-orange-100 text-orange-600 text-[10px] font-black px-3 py-1 rounded-full uppercase">Declared</span>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm step-card active-glow text-center">
                <i class="fas fa-chart-pie text-blue-500 text-3xl mb-4"></i>
                <h3 class="font-bold text-slate-700 text-sm">Skill Gap</h3>
                <span class="mt-3 inline-block bg-blue-100 text-blue-600 text-[10px] font-black px-3 py-1 rounded-full uppercase">Active</span>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm step-card text-center opacity-50">
                <i class="fas fa-tasks text-slate-400 text-3xl mb-4"></i>
                <h3 class="font-bold text-slate-700 text-sm">Milestones</h3>
                <span class="mt-3 inline-block bg-slate-100 text-slate-500 text-[10px] font-black px-3 py-1 rounded-full uppercase">Pending</span>
            </div>
        </div>

        <section class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
            <div class="flex items-center justify-between mb-8 border-b pb-4">
                <div class="flex gap-8">
                    <button class="text-blue-600 font-bold border-b-2 border-blue-600 pb-4">Active Learning</button>
                    <button class="text-slate-400 font-medium pb-4 hover:text-slate-600">Curated Paths</button>
                </div>
                <div class="text-right">
                    <p class="text-[10px] font-bold text-slate-400 uppercase">Current Progress</p>
                    <p class="text-xl font-black text-blue-600"><?php echo $maturity; ?>%</p>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex items-center justify-between p-5 bg-slate-50 rounded-2xl border border-slate-100 hover:bg-blue-50 transition cursor-pointer group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-blue-500 font-bold">01</div>
                        <div>
                            <h4 class="font-bold text-slate-800">Advanced PHP Architecture</h4>
                            <p class="text-xs text-slate-500 italic">Target: Object-Oriented Mastery</p>
                        </div>
                    </div>
                    <i class="fas fa-chevron-right text-slate-300 group-hover:text-blue-500 transition"></i>
                </div>
            </div>
        </section>
    </main>
</body>
</html>