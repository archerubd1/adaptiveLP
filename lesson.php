<<<<<<< HEAD
<?php 
require_once("database/db.php");

// Get the ID from the URL safely
$module_id = isset($_GET['module_id']) ? intval($_GET['module_id']) : 0;

// Fetch the lesson and example
$query = "SELECT m.topic_title, c.content_body, c.code_example 
          FROM course_modules m 
          LEFT JOIN module_content c ON m.id = c.module_id 
          WHERE m.id = $module_id";

$result = $conn->query($query);
$lesson = ($result) ? $result->fetch_assoc() : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Lesson | Astraal LXP</title>
</head>
<body class="bg-[#fcfdfe] p-8 md:p-20">
    <div class="max-w-4xl mx-auto">
        <a href="javascript:history.back()" class="text-blue-600 font-bold mb-4 inline-block">← Back to Roadmap</a>
        
        <h1 class="text-4xl font-black text-slate-800 mb-8">
            <?php echo isset($lesson['topic_title']) ? $lesson['topic_title'] : "Module Not Found"; ?>
        </h1>

        <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100 mb-10">
            <p class="text-slate-600 leading-relaxed text-lg">
                <?php 
                // FIXED LINE 29
                if(isset($lesson['content_body']) && !empty($lesson['content_body'])) {
                    echo $lesson['content_body'];
                } else {
                    echo "Content is being prepared for this module. Please check back soon!";
                }
                ?>
            </p>
        </div>

        <?php if(!empty($lesson['code_example'])): ?>
        <div class="bg-slate-900 rounded-[2.5rem] overflow-hidden shadow-2xl">
            <div class="p-8">
                <pre class="text-emerald-400 font-mono text-sm leading-loose"><code><?php echo htmlspecialchars($lesson['code_example']); ?></code></pre>
            </div>
        </div>
        <?php endif; ?>
    </div>
</body>
=======
<?php 
require_once("database/db.php");

// Get the ID from the URL safely
$module_id = isset($_GET['module_id']) ? intval($_GET['module_id']) : 0;

// Fetch the lesson and example
$query = "SELECT m.topic_title, c.content_body, c.code_example 
          FROM course_modules m 
          LEFT JOIN module_content c ON m.id = c.module_id 
          WHERE m.id = $module_id";

$result = $conn->query($query);
$lesson = ($result) ? $result->fetch_assoc() : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Lesson | Astraal LXP</title>
</head>
<body class="bg-[#fcfdfe] p-8 md:p-20">
    <div class="max-w-4xl mx-auto">
        <a href="javascript:history.back()" class="text-blue-600 font-bold mb-4 inline-block">← Back to Roadmap</a>
        
        <h1 class="text-4xl font-black text-slate-800 mb-8">
            <?php echo isset($lesson['topic_title']) ? $lesson['topic_title'] : "Module Not Found"; ?>
        </h1>

        <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100 mb-10">
            <p class="text-slate-600 leading-relaxed text-lg">
                <?php 
                // FIXED LINE 29
                if(isset($lesson['content_body']) && !empty($lesson['content_body'])) {
                    echo $lesson['content_body'];
                } else {
                    echo "Content is being prepared for this module. Please check back soon!";
                }
                ?>
            </p>
        </div>

        <?php if(!empty($lesson['code_example'])): ?>
        <div class="bg-slate-900 rounded-[2.5rem] overflow-hidden shadow-2xl">
            <div class="p-8">
                <pre class="text-emerald-400 font-mono text-sm leading-loose"><code><?php echo htmlspecialchars($lesson['code_example']); ?></code></pre>
            </div>
        </div>
        <?php endif; ?>
    </div>
</body>
>>>>>>> 5dae2bd566f84f4e325cec69ba182c9fd69936c1
</html>