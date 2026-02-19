<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Astraal LXP | Future of Learning</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-video { position: fixed; right: 0; bottom: 0; min-width: 100%; min-height: 100%; z-index: -1; filter: brightness(0.4); }
        .glass { background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.1); }
        .text-glow { text-shadow: 0 0 20px rgba(255,255,255,0.5); }
    </style>
</head>
<body class="overflow-x-hidden">

    <video autoplay muted loop class="hero-video">
        <source src="https://assets.mixkit.co/videos/preview/mixkit-digital-animation-of-a-circuit-board-1721-large.mp4" type="video/mp4">
    </video>

    <nav class="flex justify-between items-center p-8 absolute w-full z-10">
        <div class="text-white font-black text-3xl tracking-tighter">ASTRAAL <span class="text-blue-400">LXP</span></div>
        <div class="flex gap-8 text-white font-bold">
            <a href="login.php" class="hover:text-blue-400 transition">Log In</a>
            <a href="signup.php" class="bg-blue-600 px-6 py-2 rounded-full hover:bg-white hover:text-blue-600 transition">Join Now</a>
        </div>
    </nav>

    <section class="h-screen flex flex-col justify-center items-center text-center text-white px-6">
        <h1 class="text-7xl font-black mb-6 text-glow">Redefining <br> <span class="text-blue-400">Intelligence.</span></h1>
        <p class="text-xl text-slate-300 max-w-2xl mb-10 leading-relaxed">Future skills with Creative, Adaptive & Immersive Learning processes designed for real-world success.</p>
        <div class="flex gap-4">
            <button class="bg-white text-slate-900 px-10 py-4 rounded-full font-black text-lg hover:scale-110 transition">Discover Path</button>
            <button class="glass px-10 py-4 rounded-full font-black text-lg hover:bg-white hover:text-slate-900 transition">Watch Trailer</button>
        </div>
        <div class="mt-20 animate-bounce"><i class="fas fa-chevron-down text-2xl"></i></div>
    </section>

</body>
</html>