<<<<<<< HEAD
<?php 
require_once("database/db.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Astraal LXP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .login-card { 
            background: white; 
            border-radius: 3rem; 
            box-shadow: 0 40px 100px -20px rgba(0,0,0,0.1); 
            transform: perspective(1000px) rotateX(2deg);
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-6">

    <div class="max-w-md w-full login-card p-12 border border-white">
        <div class="text-center mb-10">
            <div class="text-blue-600 font-black text-3xl tracking-tighter mb-2">ASTRAAL LXP</div>
            <p class="text-slate-400 font-medium italic">Select your Real Account to enter</p>
        </div>

        <form action="api/process_login.php" method="POST" class="space-y-6">
            <div>
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Choose Learner</label>
                <select name="learner_id" class="w-full mt-2 p-5 bg-slate-50 border-none rounded-2xl font-bold text-slate-700 outline-none focus:ring-2 ring-blue-500 appearance-none">
                    <?php
                    $users = $conn->query("SELECT learner_id, name FROM learners");
                    if($users->num_rows > 0) {
                        while($u = $users->fetch_assoc()) {
                            echo "<option value='".$u['learner_id']."'>".$u['name']."</option>";
                        }
                    } else {
                        echo "<option disabled>No users found</option>";
                    }
                    ?>
                </select>
            </div>
            
            <button type="submit" class="w-full bg-blue-600 text-white py-5 rounded-2xl font-black shadow-xl shadow-blue-100 hover:scale-[1.02] transition">
                Access Dashboard
            </button>
        </form>

        <div class="mt-8 pt-8 border-t border-slate-50 text-center">
            <p class="text-sm text-slate-400">Need a new identity? <a href="signup.php" class="text-blue-600 font-bold">Sign Up</a></p>
        </div>
    </div>

</body>
=======
<?php 
require_once("database/db.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Astraal LXP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .login-card { 
            background: white; 
            border-radius: 3rem; 
            box-shadow: 0 40px 100px -20px rgba(0,0,0,0.1); 
            transform: perspective(1000px) rotateX(2deg);
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-6">

    <div class="max-w-md w-full login-card p-12 border border-white">
        <div class="text-center mb-10">
            <div class="text-blue-600 font-black text-3xl tracking-tighter mb-2">ASTRAAL LXP</div>
            <p class="text-slate-400 font-medium italic">Select your Real Account to enter</p>
        </div>

        <form action="api/process_login.php" method="POST" class="space-y-6">
            <div>
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Choose Learner</label>
                <select name="learner_id" class="w-full mt-2 p-5 bg-slate-50 border-none rounded-2xl font-bold text-slate-700 outline-none focus:ring-2 ring-blue-500 appearance-none">
                    <?php
                    $users = $conn->query("SELECT learner_id, name FROM learners");
                    if($users->num_rows > 0) {
                        while($u = $users->fetch_assoc()) {
                            echo "<option value='".$u['learner_id']."'>".$u['name']."</option>";
                        }
                    } else {
                        echo "<option disabled>No users found</option>";
                    }
                    ?>
                </select>
            </div>
            
            <button type="submit" class="w-full bg-blue-600 text-white py-5 rounded-2xl font-black shadow-xl shadow-blue-100 hover:scale-[1.02] transition">
                Access Dashboard
            </button>
        </form>

        <div class="mt-8 pt-8 border-t border-slate-50 text-center">
            <p class="text-sm text-slate-400">Need a new identity? <a href="signup.php" class="text-blue-600 font-bold">Sign Up</a></p>
        </div>
    </div>

</body>
>>>>>>> 5dae2bd566f84f4e325cec69ba182c9fd69936c1
</html>