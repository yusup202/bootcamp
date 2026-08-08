@extends('layouts.app')

@section('title', 'Tambah Track Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <a href="{{ route('admin.links.index') }}" class="inline-flex items-center text-sm font-medium text-zinc-400 hover:text-white mb-4 transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-1.5"></i> Kembali ke Playlist
        </a>
        <h1 class="text-2xl font-black text-white flex items-center gap-2">
            <i data-lucide="plus-circle" class="w-6 h-6 text-[#1DB954]"></i> Tambah Track Baru
        </h1>
    </div>

    <!-- Form Container -->
    <div class="bg-[#181818] rounded-2xl border border-zinc-800 p-6 sm:p-8 shadow-xl">
        <form action="{{ route('admin.links.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Input Judul -->
            <div>
                <label for="title" class="block text-sm font-bold text-zinc-300 mb-2">Judul Lagu / Tautan</label>
                <input type="text" name="title" id="title" required placeholder="Contoh: Beli Tiket Presale"
                    class="w-full bg-[#282828] border border-zinc-700 text-white rounded-lg px-4 py-3 focus:outline-none focus:border-[#1DB954] focus:ring-1 focus:ring-[#1DB954] transition-all placeholder-zinc-500">
            </div>

            <!-- Input URL -->
            <div>
                <label for="url" class="block text-sm font-bold text-zinc-300 mb-2">URL Tujuan</label>
                <input type="url" name="url" id="url" required placeholder="https://..."
                    class="w-full bg-[#282828] border border-zinc-700 text-white rounded-lg px-4 py-3 focus:outline-none focus:border-[#1DB954] focus:ring-1 focus:ring-[#1DB954] transition-all placeholder-zinc-500">
            </div>

            <!-- Input Gambar/Cover -->
            <div>
                <label for="image" class="block text-sm font-bold text-zinc-300 mb-2">Cover (Opsional)</label>
                <input type="file" name="image" id="image" accept="image/*"
                    class="w-full bg-[#282828] border border-zinc-700 text-zinc-400 rounded-lg px-4 py-2.5 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-[#1DB954] file:text-black hover:file:bg-[#1ed760] transition-all">
            </div>

            <!-- Status Aktif/Nonaktif -->
            <div class="flex items-center gap-3 pt-2">
                <input type="checkbox" name="is_active" id="is_active" value="1" checked
                    class="w-5 h-5 rounded border-zinc-700 bg-[#282828] text-[#1DB954] focus:ring-[#1DB954] focus:ring-offset-[#181818]">
                <label for="is_active" class="text-sm font-medium text-zinc-300">Aktifkan Tautan Ini</label>
            </div>

            <!-- Tombol Submit -->
            <div class="pt-4">
                <button type="submit" class="w-full bg-[#1DB954] hover:bg-[#1ed760] text-black font-extrabold py-3.5 rounded-xl transition-all transform hover:scale-[1.02] flex items-center justify-center gap-2">
                    <i data-lucide="save" class="w-5 h-5"></i> Simpan ke Playlist
                </button>
            </div>
        </form>
    </div>
</div>
@endsection