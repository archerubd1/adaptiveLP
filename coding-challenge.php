<<<<<<< HEAD
<?php 
require_once("database/db.php");
if(!isset($_SESSION['learner_id'])) { header("Location: login.php"); exit(); }
$learner_id = $_SESSION['learner_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Coding Challenge | Astraal LXP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .glass-card { background: white; border-radius: 2rem; box-shadow: 0 10px 40px rgba(0,0,0,0.03); border: 1px solid #f1f5f9; }
        .code-block { background: #1e293b; color: #e2e8f0; padding: 2rem; border-radius: 1.5rem; font-family: monospace; }
    </style>
</head>
<body class="bg-[#fcfdfe] flex">

    <aside class="w-72 bg-white border-r min-h-screen p-8 sticky top-0">
       <div class="max-w-4xl mx-auto mt-10">
    <div class="bg-slate-900 rounded-[3rem] p-12 border border-blue-500/30 shadow-[0_0_50px_rgba(59,130,246,0.2)]">
        <div class="flex items-center gap-3 mb-8">
            <div class="w-3 h-3 rounded-full bg-red-500"></div>
            <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
            <div class="w-3 h-3 rounded-full bg-green-500"></div>
            <span class="text-slate-500 font-mono text-xs ml-4">// LIVE_LOGIC_TERMINAL.EXE</span>
        </div>

        <h2 class="text-3xl font-bold text-white mb-6">Mission: <span class="text-blue-400">Boolean Logic Check</span></h2>
        
        <div class="bg-black/50 p-8 rounded-2xl font-mono text-emerald-400 mb-10 border border-emerald-500/20">
            <p class="animate-pulse">_ > system.init();</p>
            <p>$points = 10;</p>
            <p>if ($points > 5) { echo "Success"; } else { echo "Fail"; }</p>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <button class="bg-blue-600/10 border border-blue-500/50 text-blue-400 py-6 rounded-2xl font-black hover:bg-blue-600 hover:text-white transition">A) SUCCESS</button>
            <button class="bg-slate-800 border border-slate-700 text-slate-400 py-6 rounded-2xl font-black hover:bg-red-500 hover:text-white transition">B) FAIL</button>
        </div>
    </div>
</div>

            <form action="api/process_challenge.php" method="POST" class="grid grid-cols-2 gap-4">
                <button name="answer" value="Success" class="p-6 border-2 border-slate-100 rounded-2xl font-bold text-slate-600 hover:border-blue-500 hover:text-blue-600 transition uppercase tracking-widest text-xs">A) Success</button>
                <button name="answer" value="Fail" class="p-6 border-2 border-slate-100 rounded-2xl font-bold text-slate-600 hover:border-blue-500 hover:text-blue-600 transition uppercase tracking-widest text-xs">B) Fail</button>
            </form>
        </div>
    </main>
</body>
=======
<?php 
require_once("database/db.php");
if(!isset($_SESSION['learner_id'])) { header("Location: login.php"); exit(); }
$learner_id = $_SESSION['learner_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Coding Challenge | Astraal LXP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .glass-card { background: white; border-radius: 2rem; box-shadow: 0 10px 40px rgba(0,0,0,0.03); border: 1px solid #f1f5f9; }
        .code-block { background: #1e293b; color: #e2e8f0; padding: 2rem; border-radius: 1.5rem; font-family: monospace; }
    </style>
</head>
<body class="bg-[#fcfdfe] flex">

    <aside class="w-72 bg-white border-r min-h-screen p-8 sticky top-0">
       <div class="max-w-4xl mx-auto mt-10">
    <div class="bg-slate-900 rounded-[3rem] p-12 border border-blue-500/30 shadow-[0_0_50px_rgba(59,130,246,0.2)]">
        <div class="flex items-center gap-3 mb-8">
            <div class="w-3 h-3 rounded-full bg-red-500"></div>
            <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
            <div class="w-3 h-3 rounded-full bg-green-500"></div>
            <span class="text-slate-500 font-mono text-xs ml-4">// LIVE_LOGIC_TERMINAL.EXE</span>
        </div>

        <h2 class="text-3xl font-bold text-white mb-6">Mission: <span class="text-blue-400">Boolean Logic Check</span></h2>
        
        <div class="bg-black/50 p-8 rounded-2xl font-mono text-emerald-400 mb-10 border border-emerald-500/20">
            <p class="animate-pulse">_ > system.init();</p>
            <p>$points = 10;</p>
            <p>if ($points > 5) { echo "Success"; } else { echo "Fail"; }</p>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <button class="bg-blue-600/10 border border-blue-500/50 text-blue-400 py-6 rounded-2xl font-black hover:bg-blue-600 hover:text-white transition">A) SUCCESS</button>
            <button class="bg-slate-800 border border-slate-700 text-slate-400 py-6 rounded-2xl font-black hover:bg-red-500 hover:text-white transition">B) FAIL</button>
        </div>
    </div>
</div>

            <form action="api/process_challenge.php" method="POST" class="grid grid-cols-2 gap-4">
                <button name="answer" value="Success" class="p-6 border-2 border-slate-100 rounded-2xl font-bold text-slate-600 hover:border-blue-500 hover:text-blue-600 transition uppercase tracking-widest text-xs">A) Success</button>
                <button name="answer" value="Fail" class="p-6 border-2 border-slate-100 rounded-2xl font-bold text-slate-600 hover:border-blue-500 hover:text-blue-600 transition uppercase tracking-widest text-xs">B) Fail</button>
            </form>
        </div>
    </main>
</body>
>>>>>>> 5dae2bd566f84f4e325cec69ba182c9fd69936c1
</html>