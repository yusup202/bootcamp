@extends('layouts.app')

@section('title', 'Daftar Link - Admin Dashboard')

@section('content')
<div class="space-y-6 sm:space-y-8">
    
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 sm:gap-6 bg-white p-5 sm:p-6 rounded-2xl sm:rounded-3xl border-2 border-slate-900 shadow-[4px_4px_0px_0px_#0f172a]">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight flex items-center gap-2.5 sm:gap-3">
                <span class="w-2.5 h-2.5 sm:w-3 sm:h-3 bg-blue-600 rounded-full inline-block border border-slate-900"></span>
                Kelola Tautan
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1 sm:mt-1.5">Atur tautan bio Anda dengan gaya modern interaktif.</p>
        </div>
       <!-- Perubahan elemen button menjadi tag anchor (a) -->
<a href="{{ route('admin.links.create') }}"
   class="w-full sm:w-auto bg-blue-400 hover:bg-blue-300 text-slate-950 font-extrabold py-2.5 sm:py-3 px-6 rounded-xl sm:rounded-2xl border-2 border-slate-900 shadow-[3px_3px_0px_0px_#0f172a] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all flex items-center justify-center gap-2">
    <i data-lucide="plus" class="w-5 h-5 stroke-[2.5]"></i>
    Tambah Link Baru
</a>
    </div>

    <!-- Data List Container -->
    <div class="bg-white rounded-2xl sm:rounded-3xl border-2 border-slate-900 shadow-[4px_4px_0px_0px_#0f172a] sm:shadow-[6px_6px_0px_0px_#0f172a] overflow-hidden flex flex-col">
        
        <!-- Table Header (Desktop Only) -->
        <div class="hidden lg:grid grid-cols-12 gap-4 bg-slate-100 text-slate-900 px-6 py-4 border-b-2 border-slate-900 text-xs font-black uppercase tracking-wider">
            <div class="col-span-5">Judul & URL</div>
            <div class="col-span-2">Status</div>
            <div class="col-span-3">Total Klik</div>
            <div class="col-span-2 text-right">Aksi</div>
        </div>

        <!-- Table Body -->
        <div class="divide-y-2 divide-slate-900 bg-white">
            @forelse($links as $link)
                <div class="flex flex-col lg:grid lg:grid-cols-12 gap-4 lg:gap-4 items-start lg:items-center p-4 sm:p-6 lg:p-6 hover:bg-blue-50/60 transition-colors group">
                    
                    <!-- 1. Judul & URL -->
                    <div class="lg:col-span-5 flex items-center space-x-3 sm:space-x-4 w-full">
                        <!-- Logika Fallback Gambar / Inisial Judul -->
                        @if($link->image)
                            <img src="{{ asset('storage/' . $link->image) }}" alt="{{ $link->title }}" class="flex-shrink-0 h-10 w-10 sm:h-12 sm:w-12 object-cover border-2 border-slate-900 rounded-lg sm:rounded-xl shadow-[2px_2px_0px_0px_#0f172a]">
                        @else
                            <div class="flex-shrink-0 h-10 w-10 sm:h-12 sm:w-12 bg-amber-200 text-slate-900 font-black border-2 border-slate-900 flex items-center justify-center rounded-lg sm:rounded-xl shadow-[2px_2px_0px_0px_#0f172a]">
                                {{ strtoupper(substr($link->title, 0, 2)) }}
                            </div>
                        @endif

                        <div class="overflow-hidden">
                            <div class="text-sm sm:text-base font-extrabold text-slate-900 group-hover:text-blue-600 transition-colors truncate">{{ $link->title }}</div>
                            <div class="text-xs font-medium text-slate-500 truncate mt-0.5">{{ $link->url }}</div>
                        </div>
                    </div>
                    
                    <!-- Container Status & Klik di Mobile -->
                    <div class="flex flex-row lg:contents w-full gap-4 mt-2 lg:mt-0">
                        <!-- 2. Status -->
                        <div class="lg:col-span-2 flex flex-col lg:flex-row items-start lg:items-center flex-1">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1 lg:hidden">Status</span>
                            @if($link->is_active)
                                <span class="px-2.5 py-1 inline-flex text-xs font-extrabold rounded-md sm:rounded-lg bg-emerald-200 text-emerald-900 border-2 border-slate-900 shadow-[2px_2px_0px_0px_#0f172a] items-center gap-1.5 whitespace-nowrap">
                                    <span class="w-1.5 h-1.5 bg-emerald-600 rounded-full border border-slate-900"></span> Aktif
                                </span>
                            @else
                                <span class="px-2.5 py-1 inline-flex text-xs font-extrabold rounded-md sm:rounded-lg bg-rose-200 text-rose-900 border-2 border-slate-900 shadow-[2px_2px_0px_0px_#0f172a] items-center gap-1.5 whitespace-nowrap">
                                    <span class="w-1.5 h-1.5 bg-rose-600 rounded-full border border-slate-900"></span> Non-Aktif
                                </span>
                            @endif
                        </div>
                        
                        <!-- 3. Total Klik -->
                        <div class="lg:col-span-3 flex flex-col lg:flex-row items-start lg:items-center flex-1">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1 lg:hidden">Statistik</span>
                            <div class="inline-flex items-center px-2.5 py-1 rounded-md sm:rounded-lg bg-slate-100 border border-slate-300 text-xs font-extrabold text-slate-800 whitespace-nowrap">
                                <i data-lucide="mouse-pointer-click" class="w-3.5 h-3.5 mr-1.5 text-blue-600"></i>
                                {{ number_format($link->clicks) }} Klik
                            </div>
                        </div>
                    </div>
                    
                    <!-- 4. Aksi (Edit & Hapus) -->
                <div class="lg:col-span-2 flex items-center justify-start lg:justify-end space-x-2 w-full lg:w-auto mt-2 lg:mt-0 pt-4 lg:pt-0 border-t-2 border-dashed border-slate-200 lg:border-none">

                <!-- Tombol Edit (Anchor Tag GET) -->
                <a href="{{ route('admin.links.edit', $link->id) }}"
                class="flex-1 lg:flex-none text-center px-4 py-2 bg-sky-200 text-slate-900 rounded-lg sm:rounded-xl border-2 border-slate-900 shadow-[2px_2px_0px_0px_#0f172a] hover:bg-sky-300 text-xs font-bold transition-all hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none">
                    Edit
                </a>

    <!-- Form Hapus (POST dengan Method Spoofing DELETE) -->
    <form action="{{ route('admin.links.destroy', $link->id) }}"
          method="POST"
          class="flex-1 lg:flex-none m-0"
          onsubmit="return confirm('Apakah Anda yakin ingin menghapus tautan ini? Berkas gambar terkait juga akan terhapus secara permanen.');">
        @csrf
        @method('DELETE')

        <button type="submit"
                class="w-full text-center px-4 py-2 bg-rose-200 text-slate-900 rounded-lg sm:rounded-xl border-2 border-slate-900 shadow-[2px_2px_0px_0px_#0f172a] hover:bg-rose-300 text-xs font-bold transition-all hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none">
            Hapus
        </button>
    </form>

</div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="px-6 py-16 text-center">
                    <div class="flex flex-col items-center justify-center max-w-sm mx-auto p-6 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-400">
                        <div class="bg-amber-200 p-3 rounded-2xl border-2 border-slate-900 shadow-[2px_2px_0px_0px_#0f172a] mb-3 text-slate-900">
                            <i data-lucide="inbox" class="w-6 h-6"></i>
                        </div>
                        <p class="text-base font-black text-slate-900">Belum ada data link.</p>
                        <p class="text-xs text-slate-500 mt-1">Silakan tambahkan tautan baru untuk mulai membagikannya.</p>
                    </div>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination Section -->
        @if($links->hasPages())
            <div class="bg-slate-50 border-t-2 border-slate-900 px-6 py-4">
                {{ $links->links('vendor.pagination.custom') }}
            </div>
        @endif
        
    </div>
</div>
@endsection