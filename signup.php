<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Join Astraal LXP | Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .glass-box { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); }
        .floating { animation: float 6s ease-in-out infinite; }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-20px); } }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-700 to-indigo-900 min-h-screen flex items-center justify-center p-6">

    <div class="max-w-5xl w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div class="hidden md:block text-white">
            <h1 class="text-6xl font-black leading-tight mb-6">Create Your <br><span class="text-blue-300">Real Account.</span></h1>
            <p class="text-blue-100 text-lg mb-8">Join our adaptive ecosystem and track your skill maturity in real-time.</p>
            <div class="floating">
                <img src="https://img.freepik.com/free-vector/modern-student-concept-illustration_114360-1090.jpg" class="w-full max-w-sm drop-shadow-2xl">
            </div>
        </div>

        <div class="glass-box p-12 rounded-[3rem] shadow-2xl border border-white/20">
            <h2 class="text-3xl font-bold text-slate-800 mb-2">Sign Up</h2>
            <p class="text-slate-500 mb-10">Start your journey with a unique learner ID.</p>

            <form action="api/process_signup.php" method="POST" class="space-y-6">
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Full Name</label>
                    <input type="text" name="name" required placeholder="Sinchana" 
                           class="w-full p-5 bg-slate-50 border border-slate-100 rounded-2xl outline-none focus:ring-2 ring-blue-500 transition">
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Email Address</label>
                    <input type="email" name="email" required placeholder="name@example.com" 
                           class="w-full p-5 bg-slate-50 border border-slate-100 rounded-2xl outline-none focus:ring-2 ring-blue-500 transition">
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-5 rounded-2xl font-black text-lg shadow-xl shadow-blue-900/20 hover:scale-[1.02] transition">
                    Create Account
                </button>
            </form>
            
            <div class="mt-8 pt-8 border-t border-slate-100 text-center">
                <p class="text-slate-400">Already have an account? <a href="login.php" class="text-blue-600 font-bold">Log In</a></p>
            </div>
        </div>
    </div>
</body>
</html>