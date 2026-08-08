<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Pendaftaran Konser - Festival Musik 2026</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        .bg-grid-pattern {
            /* Tema warna diubah ke ungu/fuchsia */
            background-color: #e9d5ff; 
            background-image:
                linear-gradient(to right, rgba(15, 23, 42, 0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(15, 23, 42, 0.05) 1px, transparent 1px);
            background-size: 30px 30px;
        }
    </style>
</head>

<body class="bg-grid-pattern min-h-screen font-sans antialiased text-slate-900 pb-20">

    <main class="max-w-md mx-auto pt-12 px-4 flex flex-col items-center relative">

        <!-- BAGIAN PROFIL KONSER -->
        <div class="relative mb-6">
            <div class="w-24 h-24 rounded-full border-4 border-slate-900 overflow-hidden shadow-[4px_4px_0px_0px_#0f172a] bg-fuchsia-300">
                <!-- Foto Artis (Naykilla) - Menggunakan pravatar agar dijamin load -->
                <img src="https://i.pravatar.cc/256?img=47" 
                     alt="Naykilla" 
                     class="w-full h-full object-cover">
            </div>
        </div>

        <h1 class="text-2xl font-black mb-2 text-center tracking-tight">FESTIVAL MUSIK 2026</h1>

        <p class="text-center text-sm font-extrabold px-6 mb-6">
            Malam Puncak Perayaan Generasi Z <br>
            <span class="text-fuchsia-700 font-black">20 Agustus 2026</span> •
            <span class="text-violet-700 font-black">Open Gate 15:00 WIB</span>
        </p>

        <div class="flex items-center gap-4 mb-8">
            <a href="#"
                class="p-2 bg-white rounded-full border-2 border-slate-900 shadow-[2px_2px_0px_0px_#0f172a] hover:-translate-y-1 transition-transform"><i
                    data-lucide="instagram" class="w-5 h-5"></i></a>
            <a href="#"
                class="p-2 bg-white rounded-full border-2 border-slate-900 shadow-[2px_2px_0px_0px_#0f172a] hover:-translate-y-1 transition-transform"><i
                    data-lucide="twitter" class="w-5 h-5"></i></a>
            <a href="#"
                class="p-2 bg-white rounded-full border-2 border-slate-900 shadow-[2px_2px_0px_0px_#0f172a] hover:-translate-y-1 transition-transform"><i
                    data-lucide="youtube" class="w-5 h-5"></i></a>
        </div>

        <div class="w-full space-y-4">

            <!-- Tombol Modal Kontak Panitia -->
            <button onclick="openModal()" class="w-full relative group">
                <div class="absolute inset-0 bg-slate-900 rounded-3xl translate-y-1.5 translate-x-1.5"></div>
                <div
                    class="relative w-full bg-fuchsia-100 border-2 border-slate-900 rounded-3xl p-4 flex flex-col items-center justify-center transition-transform group-active:translate-y-1.5 group-active:translate-x-1.5">
                    <span class="font-black text-slate-900 text-lg">Hubungi Panitia</span>
                    <span class="text-xs font-bold text-slate-600 flex items-center gap-1 mt-1">
                        <i data-lucide="headset" class="w-3 h-3"></i> Info Tiket & Partnership
                    </span>
                </div>
            </button>

            <!-- Rendering Daftar Tautan Publik (SISTEM TETAP SAMA) -->
@foreach($links as $link)
    <!-- INTEGRASI TRACKING: Ganti $link->url dengan endpoint perantara public.redirect -->
    <a href="{{ route('public.redirect', $link->id) }}"
       target="_blank"
       rel="noopener noreferrer"
       class="w-full block relative group">

        <div class="absolute inset-0 bg-slate-900 rounded-3xl translate-y-1.5 translate-x-1.5"></div>
        <div class="relative w-full bg-white border-2 border-slate-900 rounded-3xl p-4 flex items-center transition-transform group-active:translate-y-1.5 group-active:translate-x-1.5">

            <!-- Render Logo / Placeholder Icon -->
            @if($link->image)
                <img src="{{ asset('storage/' . $link->image) }}"
                     alt="{{ $link->title }}"
                     class="w-10 h-10 object-cover rounded-xl border-2 border-slate-900 absolute left-4 bg-slate-100">
            @else
                <div class="w-10 h-10 bg-fuchsia-200 border-2 border-slate-900 rounded-xl flex items-center justify-center absolute left-4 shadow-[2px_2px_0px_0px_#0f172a]">
                    <i data-lucide="ticket" class="w-5 h-5 text-slate-900 stroke-[3]"></i>
                </div>
            @endif

            <span class="w-full text-center font-black text-slate-900 text-base px-12 truncate">
                {{ $link->title }}
            </span>
            <i data-lucide="chevron-right" class="w-5 h-5 text-slate-400 absolute right-4"></i>
        </div>
    </a>
@endforeach
        </div>
        
        {{ $links->links('vendor.pagination.custom-public') }}

        <!-- Tombol Rahasia Login Panitia -->
        <div class="mt-12 w-full flex justify-center pb-8">
            <a href="/login" class="p-3 text-slate-400 hover:text-fuchsia-600 transition-colors rounded-full hover:bg-fuchsia-100" title="Login Panitia">
                <i data-lucide="lock" class="w-5 h-5"></i>
            </a>
        </div>

    </main>

    {{-- Modal Kontak Panitia --}}
    <div id="contact-modal" class="fixed inset-0 z-50 hidden opacity-0 transition-opacity duration-300">

        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeModal()"></div>

        <div id="modal-content"
            class="absolute bottom-0 left-0 right-0 bg-white border-t-4 border-slate-900 rounded-t-[2rem] p-6 max-w-md mx-auto h-auto max-h-[85vh] overflow-y-auto pb-10 flex flex-col shadow-[0px_-8px_0px_0px_rgba(0,0,0,0.1)] translate-y-full transition-transform duration-300">

            <div class="w-12 h-1.5 bg-slate-300 rounded-full mx-auto mb-6 shrink-0"></div>

            <div class="text-center mb-6">
                <h2 class="text-sm font-extrabold text-fuchsia-600 uppercase tracking-widest">Informasi Kontak</h2>
                <h3 class="text-2xl font-black text-slate-900 mt-2">Panitia Festival 2026</h3>
                <p class="text-xs font-bold text-slate-500 mt-1">Layanan Tiket & Penawaran Sponsor</p>
            </div>

            <div class="bg-fuchsia-50 border-2 border-slate-900 rounded-2xl p-5 mb-6 space-y-4 shadow-[4px_4px_0px_0px_#0f172a]">

                
                <!-- Info WhatsApp  -->
                <div class="flex items-center gap-3 border-b-2 border-dashed border-fuchsia-200 pb-4">
                    <div class="p-2 bg-emerald-200 border-2 border-slate-900 rounded-lg">
                        <i data-lucide="phone" class="w-4 h-4 text-slate-900"></i>
                    </div>
                    <a href="https://wa.me/6281122334455?text=Halo%20Panitia%20Festival%20Musik%202026,%20saya%20butuh%20info%20lebih%20lanjut." target="_blank" class="font-extrabold text-sm truncate hover:text-emerald-600 hover:underline transition-all">
                        +62 811-2233-4455 (WhatsApp Only)
                    </a>
                </div>
                
                <!-- Info Jam Operasional -->
                <div class="flex items-start gap-3">
                    <div class="p-2 bg-amber-200 border-2 border-slate-900 rounded-lg mt-1">
                        <i data-lucide="clock" class="w-4 h-4 text-slate-900"></i>
                    </div>
                    <div>
                        <p class="font-extrabold text-sm">Jam Operasional CS</p>
                        <p class="font-extrabold text-xs text-slate-500 mt-0.5">Senin - Sabtu: 10:00 - 18:00 WIB</p>
                    </div>
                </div>
                
            </div>

            <div class="mt-auto flex gap-3">
                <button onclick="closeModal()"
                    class="flex-1 bg-slate-900 text-white font-black py-4 rounded-xl hover:bg-slate-800 transition-colors border-2 border-slate-900">
                    Tutup Info
                </button>
                <button onclick="closeModal()"
                    class="w-14 h-14 shrink-0 bg-rose-200 border-2 border-slate-900 rounded-xl flex items-center justify-center shadow-[3px_3px_0px_0px_#0f172a] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all">
                    <i data-lucide="x" class="w-6 h-6 stroke-[3] text-slate-900"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        const modal = document.getElementById('contact-modal');
        const modalContent = document.getElementById('modal-content');

        function openModal() {
            modal.classList.remove('hidden');
            requestAnimationFrame(() => {
                modal.classList.remove('opacity-0');
                modalContent.classList.remove('translate-y-full');
            });
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            modal.classList.add('opacity-0');
            modalContent.classList.add('translate-y-full');

            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }, 300);
        }
    </script>
</body>

</html>