<?php 
require_once("database/db.php");
if(!isset($_SESSION['learner_id'])) { header("Location: login.php"); exit(); }
$learner_id = $_SESSION['learner_id'];

// Fetch initial maturity from database
$state_res = $conn->query("SELECT skill_maturity FROM learner_journey_state WHERE learner_id = $learner_id");
$state = $state_res->fetch_assoc();
$current_maturity = isset($state['skill_maturity']) ? $state['skill_maturity'] * 100 : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Coding Ground | Astraal LXP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .active-link { background: #eff6ff; color: #2563eb; font-weight: 800; border-right: 4px solid #2563eb; }
        .lang-btn { transition: 0.3s; border: 1px solid #e2e8f0; background: white; }
        .lang-btn:hover { border-color: #2563eb; color: #2563eb; }
        .lang-active { background: #2563eb !important; color: white !important; border-color: #2563eb !important; }
        @keyframes pulse-sync { 0%, 100% { opacity: 1; transform: scale(1); } 50% { opacity: 0.4; transform: scale(0.8); } }
        .sync-dot { animation: pulse-sync 2s infinite; }
    </style>
</head>
<body class="bg-[#fcfdfe] flex">

    <aside class="w-72 bg-white border-r min-h-screen p-8 sticky top-0 flex flex-col">
        <div class="text-blue-600 font-black text-2xl mb-12 tracking-tighter italic">ASTRAAL LXP</div>
        <nav class="space-y-3 flex-1">
            <a href="dashboard.php" class="flex items-center gap-4 p-4 rounded-2xl text-slate-400 hover:bg-slate-50 transition">
                <i class="fas fa-layer-group w-5"></i> Dashboard
            </a>
            <a href="coding-ground.php" class="flex items-center gap-4 p-4 rounded-2xl active-link">
                <i class="fas fa-code w-5"></i> Coding Ground
            </a>
            <a href="coding-challenge.php" class="flex items-center gap-4 p-4 rounded-2xl text-slate-400 hover:bg-slate-50 transition">
                <i class="fas fa-terminal w-5"></i> Challenge
            </a>
        </nav>
        <a href="logout.php" class="flex items-center gap-4 p-4 rounded-2xl text-red-400 hover:bg-red-50 transition">
            <i class="fas fa-power-off"></i> Logout
        </a>
    </aside>

    <main class="flex-1 p-12">
        <header class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-4xl font-black text-slate-800 tracking-tight">Coding Ground</h1>
                <p class="text-slate-400 font-medium mt-1">Universal Sandbox • Account #0<?php echo $learner_id; ?></p>
            </div>

            <div class="flex flex-col items-end gap-3">
                <div class="flex items-center gap-4 bg-slate-900 px-6 py-3 rounded-2xl shadow-xl text-white">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 sync-dot"></span>
                        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Active session</span>
                    </div>
                    <div class="w-[1px] h-4 bg-slate-700"></div>
                    <span id="timer-display" class="font-mono font-bold text-blue-400 text-lg">00:00</span>
                </div>
                
                <div class="w-64">
                    <div class="flex justify-between text-[10px] font-black text-slate-400 uppercase mb-1">
                        <span>Maturity Growth</span>
                        <span><span id="maturity-val"><?php echo round($current_maturity); ?></span>%</span>
                    </div>
                    <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                        <div id="maturity-bar" class="h-full bg-blue-600 transition-all duration-1000" style="width: <?php echo $current_maturity; ?>%"></div>
                    </div>
                </div>
            </div>
        </header>

        <div class="flex gap-3 mb-6 overflow-x-auto pb-2">
            <button onclick="changeLang('php', this)" class="lang-btn lang-active px-6 py-2 rounded-xl font-bold text-sm">PHP</button>
            <button onclick="changeLang('python', this)" class="lang-btn px-6 py-2 rounded-xl font-bold text-sm">Python</button>
            <button onclick="changeLang('java', this)" class="lang-btn px-6 py-2 rounded-xl font-bold text-sm">Java</button>
            <button onclick="changeLang('c', this)" class="lang-btn px-6 py-2 rounded-xl font-bold text-sm">C</button>
            <button onclick="changeLang('cpp', this)" class="lang-btn px-6 py-2 rounded-xl font-bold text-sm">C++</button>
            <button onclick="changeLang('html', this)" class="lang-btn px-6 py-2 rounded-xl font-bold text-sm">HTML/CSS</button>
        </div>

        <div class="h-[700px] rounded-[2.5rem] overflow-hidden shadow-2xl border-8 border-slate-900">
            <iframe id="compiler-frame" 
                src="https://onecompiler.com/embed/php?hideLanguageSelection=true&theme=dark" 
                width="100%" height="100%" frameborder="0">
            </iframe>
        </div>
    </main>

    <script>
        let secondsSpent = 0;
        let currentLang = 'php'; // Default language

        // Switch Language Function
        function changeLang(lang, btn) {
            currentLang = lang; // Update the tracking variable
            const frame = document.getElementById('compiler-frame');
            frame.src = `https://onecompiler.com/embed/${lang}?hideLanguageSelection=true&theme=dark`;
            
            document.querySelectorAll('.lang-btn').forEach(b => b.classList.remove('lang-active'));
            btn.classList.add('lang-active');
        }

        // Timer and Sync Logic
        setInterval(() => {
            secondsSpent++;
            
            // Update Timer UI
            let m = Math.floor(secondsSpent / 60);
            let s = secondsSpent % 60;
            document.getElementById('timer-display').innerText = 
                (m < 10 ? "0"+m : m) + ":" + (s < 10 ? "0"+s : s);

            // Sync to database every 60 seconds
            if (secondsSpent % 60 === 0) {
                syncProgress();
            }
        }, 1000);

        // Sync Function with Language Tracking
        function syncProgress() {
            fetch(`api/update_time_reward.php?lang=${currentLang}`)
                .then(res => res.json())
                .then(data => {
                    if(data.status === 'success') {
                        let newVal = parseFloat(data.new_maturity) * 100;
                        document.getElementById('maturity-bar').style.width = newVal + '%';
                        document.getElementById('maturity-val').innerText = newVal.toFixed(0);
                        
                        // Small success feedback
                        console.log("Progress Synced for " + currentLang);
                    }
                })
                .catch(err => console.error("Sync Error:", err));
        }
    </script>
</body>
</html>