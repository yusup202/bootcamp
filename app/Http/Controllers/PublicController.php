<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse; // Import tipe respon RedirectResponse


class PublicController extends Controller
{
    /**
     * Menampilkan antarmuka Bio-Link publik.
     */
    public function index(): View{
        // 1. Querying data: Filter hanya record dengan status is_active = true
        $links = Link::where('is_active', true)
                     ->latest()
                     ->paginate(5);

        // 2. Render view publik dengan mengoper koleksi $links
        return view('public.index', compact('links'));
    }
     public function redirect(Link $link): RedirectResponse{
        // 1. Eksekusi Atomic Increment pada kolom 'clicks'
        $link->increment('clicks');

        // 2. Pengalihan pengguna ke URL eksternal
        return redirect()->away($link->url);
    }
}
