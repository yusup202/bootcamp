<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playlist - Festival Musik 2026</title>
    
    <!-- MENGGUNAKAN TAILWIND CDN (Solusi Error Vite) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Memanggil icon dari Lucide -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        /* Sembunyikan scrollbar tapi tetap bisa scroll */
        ::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="bg-[#121212] text-white font-sans min-h-screen relative pb-10">

    <!-- Efek Gradasi Background (Warna Ungu Gelap Khas Festival) -->
    <div class="absolute top-0 left-0 w-full h-[50vh] bg-gradient-to-b from-purple-900/60 to-[#121212] -z-10"></div>

    <div class="max-w-xl mx-auto px-5 py-12 sm:py-16">
        
        <!-- HEADER: Cover Album & Judul Playlist -->
        <div class="flex flex-col items-center text-center mb-8">
            <!-- Cover Playlist -->
            <img src="https://ui-avatars.com/api/?name=Festival+Musik&background=1DB954&color=fff&size=256" alt="Cover Playlist" 
                 class="w-48 h-48 sm:w-56 sm:h-56 object-cover rounded-xl shadow-[0_10px_30px_rgba(0,0,0,0.5)] mb-6">
            
            <h1 class="text-3xl sm:text-4xl font-extrabold mb-2 tracking-tight text-white">FESTIVAL MUSIK 2026</h1>
            <p class="text-zinc-300 text-sm font-medium mb-2">Malam Puncak Perayaan Generasi Z</p>
            <p class="text-zinc-500 text-xs flex items-center gap-1.5 justify-center">
                <i data-lucide="headphones" class="w-3.5 h-3.5"></i> 
                20 Agustus 2026 • Open Gate 15:00 WIB
            </p>
        </div>

        <!-- TOMBOL AKSI UTAMA -->
        <div class="flex items-center justify-between mb-8 px-2">
            <div class="flex gap-4 items-center">
                <button class="text-[#1DB954] hover:text-green-400 transition transform hover:scale-110">
                    <i data-lucide="heart" class="w-7 h-7 fill-[#1DB954]"></i>
                </button>
                <button class="text-zinc-400 hover:text-white transition transform hover:scale-110">
                    <i data-lucide="download" class="w-6 h-6"></i>
                </button>
                <button class="text-zinc-400 hover:text-white transition transform hover:scale-110">
                    <i data-lucide="more-vertical" class="w-6 h-6"></i>
                </button>
            </div>
            
            <!-- Tombol Play Besar -->
            <a href="#" class="bg-[#1DB954] hover:bg-[#1ed760] text-black w-14 h-14 rounded-full flex items-center justify-center shadow-lg transform hover:scale-105 transition-all">
                <i data-lucide="play" class="w-7 h-7 fill-black ml-1"></i>
            </a>
        </div>

        <!-- DAFTAR LAGU (Tracklist) -->
        <div class="flex flex-col gap-1">
            @forelse($links ?? [] as $link)
                <a href="{{ $link->url }}" target="_blank" 
                   class="flex items-center gap-4 p-3 rounded-lg hover:bg-white/10 transition-colors group">
                    
                    <div class="w-6 flex-shrink-0 text-center text-zinc-400 group-hover:hidden text-sm font-medium">
                        {{ $loop->iteration }}
                    </div>
                    <div class="w-6 flex-shrink-0 text-center text-white hidden group-hover:block">
                        <i data-lucide="play" class="w-4 h-4 fill-white mx-auto"></i>
                    </div>

                    @if($link->image)
                        <img src="{{ asset('storage/' . $link->image) }}" class="w-10 h-10 rounded object-cover shadow" alt="Cover">
                    @endif

                    <div class="flex-1 overflow-hidden">
                        <h3 class="text-base font-bold text-white truncate group-hover:text-[#1DB954] transition-colors">
                            {{ $link->title }}
                        </h3>
                        <p class="text-xs text-zinc-400 truncate">
                            Klik untuk membuka • Festival Musik 2026
                        </p>
                    </div>

                    <div class="text-zinc-500 group-hover:text-white transition-colors">
                        <i data-lucide="more-horizontal" class="w-5 h-5"></i>
                    </div>
                </a>
            @empty
                <div class="text-center text-zinc-500 text-sm mt-8">
                    Belum ada "Lagu" yang ditambahkan ke Playlist.
                </div>
            @endforelse
        </div>
        
        <!-- WATERMARK -->
        <div class="mt-12 text-center text-xs text-zinc-600 font-medium flex items-center justify-center gap-1.5">
            <i data-lucide="lock" class="w-3.5 h-3.5"></i> Informasi Aman & Terenkripsi
        </div>

    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>