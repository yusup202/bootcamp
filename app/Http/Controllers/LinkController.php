<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class LinkController extends Controller
{
    /**
     * Menampilkan daftar data tautan di admin dashboard.
     */
    public function index(): View
    {
        // Mengambil semua data link diurutkan dari yang terbaru
        // $links = Link::latest()->get();
        
        $links = Link::latest()->paginate(5);

        // Mengirimkan data $links ke view 'admin.links.index'
        return view('admin.links.index', compact('links'));
    }
    /**
     * Menampilkan formulir pendaftaran tautan baru.
     */
    public function create(): View{
        return view('admin.links.create');
    }
 /**
     * Validasi input, pemrosesan upload gambar, dan pencatatan ke database.
     */
    public function store(Request $request): RedirectResponse{
        // 1. Validasi Input Server-Side
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url'   => 'required|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // 2. Pemrosesan Unggah Gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('links', 'public');
        }

        // 3. Evaluasi Status Checkbox (Boolean Helper)
        $isActive = $request->boolean('is_active');

        // 4. Pencatatan Record Baru via Eloquent
        Link::create([
            'title'     => $validated['title'],
            'url'       => $validated['url'],
            'image'     => $imagePath,
            'is_active' => $isActive,
            'clicks'    => 0,
        ]);

        // 5. Redireksi Halaman dengan Sesi Sementara (Flash Message)
        return redirect()
            ->route('admin.links.index')
            ->with('success', 'Tautan baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan formulir edit tautan berdasarkan model $link.
     */
    public function edit(Link $link): View
    {
        return view('admin.links.edit', compact('link'));
    }

    /**
     * Memproses pembaruan data dan penggantian berkas di server.
     */
    public function update(Request $request, Link $link): RedirectResponse
    {
        // 1. Validasi Input Data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url'   => 'required|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Default: Gunakan path gambar lama yang sudah ada di DB
        $imagePath = $link->image;

        // 2. Logika Replacement Berkas
        if ($request->hasFile('image')) {
            // Hapus gambar fisik lama dari disk 'public' jika ada
            if ($link->image) {
                Storage::disk('public')->delete($link->image);
            }

            // Simpan gambar baru ke direktori 'links'
            $imagePath = $request->file('image')->store('links', 'public');
        }

        // 3. Evaluasi Checkbox & Update Record Database
        $link->update([
            'title'     => $validated['title'],
            'url'       => $validated['url'],
            'image'     => $imagePath,
            'is_active' => $request->boolean('is_active'),
        ]);


        return redirect()
            ->route('admin.links.index')
            ->with('success', 'Tautan berhasil diperbarui!');
    }

        /**
     * Menghapus record tautan dari database dan memusnahkan berkas gambarnya.
     */
    public function destroy(Link $link): RedirectResponse
    {
        // 1. Eksekusi pembersihan berkas fisik di storage server
        if ($link->image) {
            Storage::disk('public')->delete($link->image);
        }

        // 2. Hapus record dari tabel database
        $link->delete();

        // 3. Kembalikan ke halaman indeks dengan flash notification
        return redirect()
            ->route('admin.links.index')
            ->with('success', 'Tautan beserta berkas gambarnya berhasil dihapus secara permanen!');
    }
}