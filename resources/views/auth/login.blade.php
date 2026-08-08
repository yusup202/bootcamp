<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Panitia - Festival Musik 2026</title>
    
    <!-- MENGGUNAKAN TAILWIND CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        /* Grid Pattern untuk Dark Mode (Garis samar) */
        .bg-grid-dark {
            background-size: 40px 40px;
            background-image: 
                linear-gradient(to right, rgba(255, 255, 255, 0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
        }
    </style>
</head>
<body class="bg-[#121212] bg-grid-dark text-white font-sans min-h-screen flex items-center justify-center p-4 selection:bg-[#1DB954] selection:text-black">

    <div class="w-full max-w-sm">
        
        <!-- Header (Icon & Judul di luar kotak) -->
        <div class="text-center mb-6">
            <div class="mx-auto w-14 h-14 bg-[#1DB954] border-2 border-black rounded-xl flex items-center justify-center mb-4 shadow-[4px_4px_0_0_#000]">
                <!-- Gunakan icon tiket atau musik -->
                <i data-lucide="ticket" class="w-7 h-7 text-black stroke-[2.5]"></i>
            </div>
            <h1 class="text-3xl font-black text-white mb-1 tracking-tight">Login Panitia</h1>
            <p class="text-sm font-medium text-zinc-400">Masuk untuk mengelola playlist & tiket konser</p>
        </div>

        <!-- Card Login (Gaya Neo-Brutalism Dark) -->
        <div class="bg-[#242424] border-[3px] border-black rounded-3xl p-6 sm:p-8 shadow-[8px_8px_0_0_#000]">
            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Alert Error -->
                @if ($errors->any())
                    <div class="bg-red-500 border-2 border-black text-black font-bold text-sm p-3 rounded-xl mb-4 shadow-[3px_3px_0_0_#000]">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Input Email -->
                <div>
                    <label for="email" class="block text-sm font-extrabold text-white mb-2">Alamat Email Panitia</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="w-full bg-[#121212] border-2 border-black text-white rounded-xl px-4 py-3 font-medium focus:outline-none focus:border-[#1DB954] focus:ring-1 focus:ring-[#1DB954] transition-all placeholder-zinc-600"
                        placeholder="admin@biolink.com">
                </div>

                <!-- Input Password -->
                <div>
                    <label for="password" class="block text-sm font-extrabold text-white mb-2">Kata Sandi</label>
                    <input type="password" name="password" id="password" required
                        class="w-full bg-[#121212] border-2 border-black text-white rounded-xl px-4 py-3 font-medium focus:outline-none focus:border-[#1DB954] focus:ring-1 focus:ring-[#1DB954] transition-all placeholder-zinc-600"
                        placeholder="••••••••••">
                </div>

                <!-- Remember Me -->
                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" name="remember" id="remember" 
                        class="w-4 h-4 rounded border-black border-2 bg-[#121212] text-[#1DB954] focus:ring-[#1DB954] focus:ring-offset-[#242424]">
                    <label for="remember" class="text-xs font-bold text-zinc-400 select-none">Ingat saya</label>
                </div>

                <!-- Tombol Submit (Hijau Neo-Brutalism) -->
                <div class="pt-2">
                    <button type="submit" 
                        class="w-full bg-[#1DB954] hover:bg-[#1ed760] text-black font-black text-base py-3.5 rounded-xl border-2 border-black shadow-[4px_4px_0_0_#000] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all flex items-center justify-center gap-2">
                        Masuk Dashboard <i data-lucide="arrow-right" class="w-5 h-5 stroke-[3]"></i>
                    </button>
                </div>
            </form>
        </div>

    </div>

    <!-- Inisialisasi Icon -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>