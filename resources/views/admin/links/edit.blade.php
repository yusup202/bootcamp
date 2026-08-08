@extends('layouts.app')

@section('title', 'Edit Track')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <a href="{{ route('admin.links.index') }}" class="inline-flex items-center text-sm font-medium text-zinc-400 hover:text-white mb-4 transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-1.5"></i> Batal Edit
        </a>
        <h1 class="text-2xl font-black text-white flex items-center gap-2">
            <i data-lucide="pen-tool" class="w-6 h-6 text-blue-500"></i> Edit Informasi Track
        </h1>
    </div>

    <!-- Form Container -->
    <div class="bg-[#181818] rounded-2xl border border-zinc-800 p-6 sm:p-8 shadow-xl">
        <form action="{{ route('admin.links.update', $link->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-bold text-zinc-300 mb-2">Judul Lagu / Tautan</label>
                <input type="text" name="title" id="title" value="{{ old('title', $link->title) }}" required
                    class="w-full bg-[#282828] border border-zinc-700 text-white rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
            </div>

            <div>
                <label for="url" class="block text-sm font-bold text-zinc-300 mb-2">URL Tujuan</label>
                <input type="url" name="url" id="url" value="{{ old('url', $link->url) }}" required
                    class="w-full bg-[#282828] border border-zinc-700 text-white rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
            </div>

            <div>
                <label for="image" class="block text-sm font-bold text-zinc-300 mb-2">Ganti Cover (Opsional)</label>
                @if($link->image)
                    <div class="mb-3 flex items-center gap-3">
                        <img src="{{ asset('storage/' . $link->image) }}" class="w-12 h-12 rounded object-cover shadow-md">
                        <span class="text-xs text-zinc-500">Cover saat ini</span>
                    </div>
                @endif
                <input type="file" name="image" id="image" accept="image/*"
                    class="w-full bg-[#282828] border border-zinc-700 text-zinc-400 rounded-lg px-4 py-2.5 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-blue-500 file:text-white hover:file:bg-blue-600 transition-all">
            </div>

            <div class="flex items-center gap-3 pt-2">
                <!-- Fallback untuk checkbox false -->
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ $link->is_active ? 'checked' : '' }}
                    class="w-5 h-5 rounded border-zinc-700 bg-[#282828] text-blue-500 focus:ring-blue-500 focus:ring-offset-[#181818]">
                <label for="is_active" class="text-sm font-medium text-zinc-300">Track Aktif</label>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3.5 rounded-xl transition-all transform hover:scale-[1.02] flex items-center justify-center gap-2">
                    <i data-lucide="refresh-cw" class="w-5 h-5"></i> Perbarui Track
                </button>
            </div>
        </form>
    </div>
</div>
@endsection