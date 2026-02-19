<?php 
require_once("database/db.php");
if(!isset($_SESSION['learner_id'])) { header("Location: login.php"); exit(); }
$learner_id = $_SESSION['learner_id'];

// Fetch course count for the header
$courses_count_res = $conn->query("SELECT COUNT(*) as total FROM courses");
$row_count = $courses_count_res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Studio | Astraal LXP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .glass-card { background: white; border-radius: 2rem; box-shadow: 0 10px 40px rgba(0,0,0,0.03); transition: 0.3s; border: 1px solid #f1f5f9; }
        .active-link { background: #eff6ff; color: #2563eb; font-weight: 800; border-radius: 1rem; }
    </style>
</head>
<body class="bg-[#fcfdfe] flex">

    <aside class="w-72 bg-white border-r min-h-screen p-8 sticky top-0">
        <div class="text-blue-600 font-black text-2xl mb-12 tracking-tighter">ASTRAAL LXP</div>
        <nav class="space-y-3">
            <a href="dashboard.php" class="flex items-center gap-4 p-4 text-slate-400 hover:bg-slate-50 transition rounded-2xl">
                <i class="fas fa-layer-group"></i> Dashboard
            </a>
            <a href="leaderboard.php" class="flex items-center gap-4 p-4 text-slate-400 hover:bg-slate-50 transition rounded-2xl">
                <i class="fas fa-trophy"></i> Leaderboard
            </a>
            <a href="project-studio.php" class="flex items-center gap-4 p-4 active-link">
                <i class="fas fa-laptop-code"></i> Project Studio
            </a>
            <a href="coding-ground.php" class="flex items-center gap-4 p-4 text-slate-400 hover:bg-slate-50 transition rounded-2xl">
                <i class="fas fa-code"></i> Coding Ground
            </a>
        </nav>
    </aside>

    <main class="flex-1 p-12">
        <div class="flex justify-between items-end mb-8 mt-12">
            <div>
                <h3 class="text-3xl font-black text-slate-800">Project Studio</h3>
                <p class="text-slate-400 font-medium italic">Explore paths from SQL to Operating Systems</p>
            </div>
            <span class="text-blue-600 font-bold text-sm bg-blue-50 px-4 py-2 rounded-xl border border-blue-100">
                <?php echo $row_count['total']; ?> Paths Available
            </span>
        </div>

        <div class="grid grid-cols-3 gap-8 pb-20">
            <?php
            $all_courses = $conn->query("SELECT * FROM courses");
            if($all_courses && $all_courses->num_rows > 0):
                while($c = $all_courses->fetch_assoc()):
                    $theme = $c['color']; 
            ?>
            <div class="glass-card p-8 flex flex-col justify-between hover:shadow-2xl hover:-translate-y-2 transition-all group">
                <div>
                    <div class="w-14 h-14 bg-<?php echo $theme; ?>-50 text-<?php echo $theme; ?>-600 rounded-2xl flex items-center justify-center mb-6 text-3xl group-hover:scale-110 transition">
                        <i class="bx <?php echo $c['icon']; ?>"></i>
                    </div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-2 h-2 rounded-full bg-<?php echo $theme; ?>-500"></span>
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest"><?php echo $c['level']; ?></span>
                    </div>
                    <h4 class="text-xl font-bold text-slate-800"><?php echo $c['title']; ?></h4>
                    <p class="text-slate-400 text-sm mt-4 font-medium leading-relaxed"><?php echo $c['description']; ?></p>
                </div>
                
                <button class="w-full py-4 mt-8 bg-slate-900 text-white font-black rounded-2xl shadow-lg shadow-slate-200 hover:bg-<?php echo $theme; ?>-600 transition-all text-sm uppercase tracking-widest">
                    Start Learning
                </button>
            </div>
            <?php 
                endwhile;
            else:
                echo "<p class='text-slate-400'>No courses found in database.</p>";
            endif;
            ?>
        </div>
    </main>
</body>
</html>