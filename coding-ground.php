<?php 
// 1. Force server-side session extension to 1 hour
ini_set('session.gc_maxlifetime', 3600);
ini_set('session.cookie_lifetime', 3600);
require_once(dirname(__FILE__) . "/database/db.php");

if(!isset($_SESSION['learner_id'])) { 
    header("Location: login.php"); 
    exit(); 
}

$learner_id = $_SESSION['learner_id'];

// 2. Fetch Saved Files
$files_res = $conn->query("SELECT id, project_name, language FROM learner_projects WHERE learner_id = $learner_id ORDER BY created_at DESC");

// 3. Fetch Maturity State
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
        .lang-btn { transition: 0.3s; border: 1px solid #e2e8f0; background: white; white-space: nowrap; }
        .lang-active { background: #2563eb !important; color: white !important; border-color: #2563eb !important; }
        .file-item:hover { background: #f8fafc; cursor: pointer; border-color: #e2e8f0; }
        @keyframes pulse-sync { 0%, 100% { opacity: 1; transform: scale(1); } 50% { opacity: 0.4; transform: scale(0.8); } }
        .sync-dot { animation: pulse-sync 2s infinite; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="bg-[#fcfdfe] flex">

    <aside class="w-80 bg-white border-r min-h-screen p-6 sticky top-0 flex flex-col shadow-sm">
        <div class="text-blue-600 font-black text-2xl mb-8 tracking-tighter italic">ASTRAAL LXP</div>
        
        <nav class="space-y-2 mb-8">
            <a href="dashboard.php" class="flex items-center gap-3 p-3 rounded-xl text-slate-400 hover:bg-slate-50 transition">
                <i class="fas fa-layer-group"></i> Dashboard
            </a>
            <a href="coding-ground.php" class="flex items-center gap-3 p-3 rounded-xl active-link">
                <i class="fas fa-code"></i> Coding Ground
            </a>
        </nav>

        <div class="relative mb-6 px-2">
            <i class="fas fa-search absolute left-5 top-3.5 text-slate-300 text-xs"></i>
            <input type="text" id="fileSearch" onkeyup="filterFiles()" placeholder="Search your files..." 
                class="w-full bg-slate-50 border border-slate-100 rounded-xl py-2.5 pl-9 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition">
        </div>

        <div class="flex-1">
            <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 px-3">Your Saved Files</h3>
            <div id="fileList" class="space-y-1 overflow-y-auto max-h-[45vh] no-scrollbar">
                <?php if($files_res && $files_res->num_rows > 0): ?>
                    <?php while($file = $files_res->fetch_assoc()): ?>
                        <div onclick="loadProject('<?php echo $file['language']; ?>', <?php echo $file['id']; ?>)" 
                             class="file-item group flex items-center justify-between p-3 rounded-xl border border-transparent transition">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-file-code text-blue-500"></i>
                                <div>
                                    <p class="file-name text-sm font-bold text-slate-700 leading-none"><?php echo htmlspecialchars($file['project_name']); ?></p>
                                    <span class="text-[10px] text-slate-400 uppercase"><?php echo $file['language']; ?></span>
                                </div>
                            </div>
                            <button onclick="event.stopPropagation(); deleteProject(<?php echo $file['id']; ?>)" 
                                    class="text-slate-300 hover:text-red-500 opacity-0 group-hover:opacity-100 transition p-1">
                                <i class="fas fa-trash-alt text-xs"></i>
                            </button>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-xs text-slate-400 px-3 italic">No saved files yet.</p>
                <?php endif; ?>
            </div>
        </div>

        <a href="logout.php" class="flex items-center gap-3 p-3 rounded-xl text-red-400 hover:bg-red-50 transition mt-auto">
            <i class="fas fa-power-off"></i> Logout
        </a>
    </aside>

    <main class="flex-1 p-10">
        <header class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-4xl font-black text-slate-800 tracking-tight">Coding Ground</h1>
                <p class="text-slate-400 font-medium mt-1 uppercase text-[10px] tracking-widest">Multi-Language IDE • Session: <?php echo session_id(); ?></p>
            </div>

            <div class="flex flex-col items-end gap-3">
                <div class="flex items-center gap-4 bg-slate-900 px-6 py-3 rounded-2xl shadow-xl text-white">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 sync-dot"></span>
                        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Live Sync</span>
                    </div>
                    <span id="timer-display" class="font-mono font-bold text-blue-400 text-lg">00:00</span>
                </div>
                
                <div class="w-64">
                    <div class="flex justify-between text-[10px] font-black text-slate-400 uppercase mb-1">
                        <span>Growth</span>
                        <span><span id="maturity-val"><?php echo round($current_maturity); ?></span>%</span>
                    </div>
                    <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                        <div id="maturity-bar" class="h-full bg-blue-600 transition-all duration-1000" style="width: <?php echo $current_maturity; ?>%"></div>
                    </div>
                </div>
            </div>
        </header>

        <div class="flex justify-between items-center mb-6">
            <div class="flex gap-3 overflow-x-auto no-scrollbar">
                <button onclick="changeLang('php', this)" class="lang-btn px-6 py-2 rounded-xl font-bold text-sm shadow-sm">PHP</button>
                <button onclick="changeLang('python', this)" class="lang-btn px-6 py-2 rounded-xl font-bold text-sm shadow-sm">Python</button>
                <button onclick="changeLang('java', this)" class="lang-btn px-6 py-2 rounded-xl font-bold text-sm shadow-sm">Java</button>
                <button onclick="changeLang('c', this)" class="lang-btn px-6 py-2 rounded-xl font-bold text-sm shadow-sm">C</button>
                <button onclick="changeLang('cpp', this)" class="lang-btn px-6 py-2 rounded-xl font-bold text-sm shadow-sm">C++</button>
                <button onclick="changeLang('html', this)" class="lang-btn lang-active px-6 py-2 rounded-xl font-bold text-sm shadow-sm">HTML/CSS/JS</button>
            </div>

            <button onclick="saveProjectPrompt()" class="bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-2 rounded-xl font-bold text-sm shadow-lg transition flex items-center gap-2">
                <i class="fas fa-save"></i> Save Project
            </button>
        </div>

        <div class="h-[700px] rounded-[2.5rem] overflow-hidden shadow-2xl border-8 border-slate-900">
            <embed id="compiler-frame" 
                src="https://onecompiler.com/embed/html?hideLanguageSelection=true&theme=dark" 
                width="100%" height="100%">
        </div>

        <div id="session-warning" class="hidden fixed bottom-10 right-10 z-50 animate-bounce">
            <div class="bg-red-600 text-white p-6 rounded-3xl shadow-2xl flex items-center gap-4 border-4 border-white">
                <div class="bg-white text-red-600 w-10 h-10 rounded-full flex items-center justify-center font-black italic text-xl">!</div>
                <div>
                    <h4 class="font-black text-sm uppercase tracking-tighter">Sync Interrupted</h4>
                    <p class="text-[10px] font-medium opacity-90">Session expiring. Reconnect to extend lifetime.</p>
                </div>
                <button onclick="location.reload()" class="bg-white text-red-600 px-4 py-2 rounded-xl text-[10px] font-black hover:bg-slate-100 transition">RECONNECT</button>
            </div>
        </div>
    </main>

    <script>
        let secondsSpent = 0;
        let currentLang = 'html';

        // 1. Language Logic
        function changeLang(lang, btn) {
            currentLang = lang;
            document.getElementById('compiler-frame').src = `https://onecompiler.com/embed/${lang}?hideLanguageSelection=true&theme=dark`;
            document.querySelectorAll('.lang-btn').forEach(b => b.classList.remove('lang-active'));
            if(btn) btn.classList.add('lang-active');
        }

        // 2. Load Project Logic
        function loadProject(lang, id) {
            const slug = lang.toLowerCase();
            changeLang(slug, null);
            document.querySelectorAll('.lang-btn').forEach(btn => {
                const btnText = btn.innerText.toLowerCase();
                if(btnText === slug || (slug === 'cpp' && btn.innerText === 'C++')) {
                    btn.classList.add('lang-active');
                } else {
                    btn.classList.remove('lang-active');
                }
            });
        }

        // 3. Search Filter Logic
        function filterFiles() {
            let input = document.getElementById('fileSearch').value.toLowerCase();
            let items = document.getElementsByClassName('file-item');
            
            for (let item of items) {
                let name = item.querySelector('.file-name').innerText.toLowerCase();
                item.style.display = name.includes(input) ? "flex" : "none";
            }
        }

        // 4. Save Logic
        function saveProjectPrompt() {
            const projectName = prompt("Enter a name for your project:");
            if (projectName) {
                const formData = new FormData();
                formData.append('project_name', projectName);
                formData.append('language', currentLang);

                fetch('api/save_project.php', { method: 'POST', body: formData })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') { alert(data.message); location.reload(); }
                    else alert(data.message);
                })
                .catch(err => alert("Error saving project."));
            }
        }

        // 5. Delete Logic
        function deleteProject(id) {
            if (confirm("Permanently delete this project?")) {
                const formData = new FormData();
                formData.append('project_id', id);

                fetch('api/delete_project.php', { method: 'POST', body: formData })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') location.reload();
                    else alert(data.message);
                })
                .catch(err => alert("Error deleting project."));
            }
        }

        // 6. Heartbeat (Every 30s)
        setInterval(() => {
            secondsSpent++;
            let m = Math.floor(secondsSpent / 60);
            let s = secondsSpent % 60;
            document.getElementById('timer-display').innerText = (m < 10 ? "0"+m : m) + ":" + (s < 10 ? "0"+s : s);
            if (secondsSpent % 30 === 0) syncProgress();
        }, 1000);

        function syncProgress() {
            fetch(`api/update_time_reward.php?lang=${currentLang}`)
                .then(res => res.json())
                .then(data => {
                    if(data.status === 'success') {
                        let newVal = parseFloat(data.new_maturity) * 100;
                        document.getElementById('maturity-bar').style.width = newVal + '%';
                        document.getElementById('maturity-val').innerText = newVal.toFixed(0);
                        document.getElementById('session-warning').classList.add('hidden');
                    }
                }).catch(() => document.getElementById('session-warning').classList.remove('hidden'));
        }
    </script>
</body>
</html>