<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Festival Musik</title>
    
    <!-- MENGGUNAKAN TAILWIND CDN (Solusi Error Vite) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-[#121212] text-zinc-300 font-sans min-h-screen selection:bg-[#1DB954] selection:text-black">

    <!-- Navbar -->
    <!-- Navbar -->
    <nav class="bg-[#181818] border-b border-zinc-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <i data-lucide="disc" class="w-8 h-8 text-[#1DB954]"></i>
                    <span class="text-white font-black text-xl tracking-tight">Admin<span class="text-[#1DB954]">Panel</span></span>
                </div>
                
                <!-- Menu Kanan -->
                <div class="flex items-center gap-4 sm:gap-6">
                    <a href="{{ route('admin.dashboard') ?? '#' }}" class="text-zinc-400 hover:text-white font-medium text-sm transition-colors">Dashboard</a>
                    <a href="{{ route('admin.links.index') ?? '#' }}" class="text-zinc-400 hover:text-white font-medium text-sm transition-colors">Tracks</a>
                    
                    <!-- Garis Pemisah (Divider) -->
                    <div class="h-5 w-px bg-zinc-700 hidden sm:block"></div>

                    <!-- Tombol Keluar (Logout Form) -->
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin keluar dari Admin Panel?')" 
                                class="flex items-center gap-1.5 text-zinc-400 hover:text-red-500 font-medium text-sm transition-colors group">
                            <i data-lucide="log-out" class="w-4 h-4 group-hover:translate-x-0.5 transition-transform"></i>
                            <span class="hidden sm:inline">Keluar</span>
                        </button>
                    </form>
                </div>
                
            </div>
        </div>
    </nav>
    
    <!-- Konten Utama -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>