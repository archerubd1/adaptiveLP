<?php 
require_once("database/db.php");
$id = $_GET['id']; // Gets the ID from the button click

// Fetch course details and its modules from basic to advanced
$course = $conn->query("SELECT * FROM courses WHERE id = $id")->fetch_assoc();
$modules = $conn->query("SELECT * FROM course_modules WHERE course_id = $id ORDER BY order_num ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Syllabus | Astraal LXP</title>
</head>
<body class="bg-[#fcfdfe] p-12">
    <h1 class="text-4xl font-black text-slate-800"><?php echo $course['title']; ?> Roadmap</h1>
    <p class="text-slate-400 mb-10">From Basic to Advanced concepts.</p>

    <div class="space-y-6">
    <?php while($m = $modules->fetch_assoc()): ?>
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center justify-between gap-6 hover:border-blue-400 transition-all">
        <div class="flex items-center gap-6">
            <div class="text-2xl font-black text-blue-600">0<?php echo $m['order_num']; ?></div>
            <div>
                <span class="text-[10px] font-bold text-slate-400 uppercase"><?php echo $m['level_name']; ?></span>
                <h3 class="text-xl font-bold text-slate-800"><?php echo $m['topic_title']; ?></h3>
                <p class="text-slate-400 text-sm"><?php echo $m['topic_description']; ?></p>
            </div>
        </div>
        
        <a href="lesson.php?module_id=<?php echo $m['id']; ?>" 
           class="bg-slate-900 text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-blue-600 transition shadow-lg shadow-slate-200">
           Start Lesson
        </a>
    </div>
    <?php endwhile; ?>
</div>
</body>
</html>