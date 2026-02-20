<?php
require_once("database/db.php");

// Fetch Top 5 Learners by Skill Maturity
$query = "SELECT l.name, s.skill_maturity, s.thinking_complexity 
          FROM learners l 
          JOIN learner_journey_state s ON l.learner_id = s.learner_id 
          ORDER BY s.skill_maturity DESC LIMIT 5";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Leaderboard | Astraal LXP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .rank-card { transition: all 0.3s ease; border-radius: 1.5rem; }
        .rank-card:hover { transform: scale(1.02); box-shadow: 0 20px 40px rgba(0,0,0,0.05); }
        .gold-glow { border-left: 8px solid #fbbf24; background: linear-gradient(to right, #fffdf5, #ffffff); }
    </style>
</head>
<body class="bg-slate-50 min-h-screen p-12">

    <div class="max-w-3xl mx-auto">
        <header class="text-center mb-12">
            <h1 class="text-4xl font-black text-slate-800 tracking-tighter uppercase">Global Standings</h1>
            <p class="text-slate-400 font-medium mt-2">Top performers in the Adaptive Learning Path</p>
        </header>

        <div class="space-y-4">
            <?php 
            $rank = 1;
            if($result->num_rows > 0):
                while($row = $result->fetch_assoc()): 
                    $isFirst = ($rank == 1);
            ?>
            <div class="rank-card bg-white p-6 flex items-center justify-between border border-slate-100 <?php echo $isFirst ? 'gold-glow shadow-lg' : ''; ?>">
                <div class="flex items-center gap-6">
                    <span class="text-2xl font-black <?php echo $isFirst ? 'text-yellow-500' : 'text-slate-300'; ?>">
                        #<?php echo $rank++; ?>
                    </span>
                    <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center font-bold text-slate-400">
                        <?php echo substr($row['name'], 0, 1); ?>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-800"><?php echo $row['name']; ?></h3>
                        <p class="text-xs text-slate-400 uppercase font-black tracking-widest">Cognitive: <?php echo ($row['thinking_complexity']*100); ?>%</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="text-sm font-black text-blue-600"><?php echo ($row['skill_maturity']*100); ?>%</span>
                    <p class="text-[10px] text-slate-400 font-bold uppercase">Maturity</p>
                </div>
            </div>
            <?php 
                endwhile; 
            else:
                echo "<p class='text-center text-slate-400'>No data available yet.</p>";
            endif;
            ?>
        </div>

        <div class="mt-12 text-center">
            <a href="dashboard.php" class="inline-flex items-center gap-2 text-blue-600 font-bold hover:gap-4 transition-all">
                <i class="fas fa-arrow-left"></i> Back to My Dashboard
            </a>
        </div>
    </div>

</body>
</html>