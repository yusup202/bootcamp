@extends('layouts.app')

@section('title', 'Streaming Analytics')

@section('content')
<div class="max-w-7xl mx-auto text-white">
    
    <!-- Header Dashboard -->
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight flex items-center gap-3">
                <i data-lucide="activity" class="w-8 h-8 text-[#1DB954]"></i>
                Streaming Analytics
            </h1>
            <p class="text-zinc-400 font-medium mt-1">Ringkasan performa audiens dan akses playlist Anda.</p>
        </div>
        <a href="{{ route('admin.links.index') }}" class="hidden sm:flex bg-[#282828] hover:bg-[#383838] border border-zinc-700 text-white font-semibold py-2.5 px-6 rounded-full transition-all items-center gap-2">
            Kelola Tracks <i data-lucide="arrow-right" class="w-4 h-4"></i>
        </a>
    </div>

    <!-- SUMMARY CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <!-- Card 1: Total Tracks -->
        <div class="bg-[#181818] border border-zinc-800 rounded-2xl p-6 shadow-lg hover:bg-[#282828] transition-all group">
            <div class="bg-blue-500/10 w-12 h-12 rounded-full flex items-center justify-center mb-4 text-blue-500 group-hover:scale-110 transition-transform">
                <i data-lucide="list-music" class="w-6 h-6"></i>
            </div>
            <h3 class="text-sm font-bold text-zinc-400 uppercase tracking-wider mb-1">Total Tracks</h3>
            <div class="flex items-baseline gap-2">
                <span class="text-4xl font-extrabold text-white">{{ $totalLinks ?? 0 }}</span>
                <span class="text-sm font-medium text-zinc-500">({{ $activeLinks ?? 0 }} Aktif)</span>
            </div>
        </div>

        <!-- Card 2: Total Streams -->
        <div class="bg-[#181818] border border-zinc-800 rounded-2xl p-6 shadow-lg hover:bg-[#282828] transition-all group">
            <div class="bg-[#1DB954]/10 w-12 h-12 rounded-full flex items-center justify-center mb-4 text-[#1DB954] group-hover:scale-110 transition-transform">
                <i data-lucide="headphones" class="w-6 h-6"></i>
            </div>
            <h3 class="text-sm font-bold text-zinc-400 uppercase tracking-wider mb-1">Total Streams (Klik)</h3>
            <span class="text-4xl font-extrabold text-white">{{ $totalClicks ?? 0 }}</span>
        </div>

        <!-- Card 3: Top Track -->
        <div class="bg-[#181818] border border-zinc-800 rounded-2xl p-6 shadow-lg hover:bg-[#282828] transition-all group">
            <div class="bg-purple-500/10 w-12 h-12 rounded-full flex items-center justify-center mb-4 text-purple-400 group-hover:scale-110 transition-transform">
                <i data-lucide="flame" class="w-6 h-6"></i>
            </div>
            <h3 class="text-sm font-bold text-zinc-400 uppercase tracking-wider mb-1">Top Track</h3>
            @if(isset($topLink) && $topLink)
                <p class="text-lg font-extrabold text-white truncate mb-1">{{ $topLink->title }}</p>
                <p class="text-sm font-medium text-[#1DB954] flex items-center gap-1">
                    <i data-lucide="play-circle" class="w-4 h-4"></i> {{ $topLink->clicks }} Plays
                </p>
            @else
                <p class="text-lg font-extrabold text-zinc-500">Belum ada data</p>
            @endif
        </div>
    </div>

    <!-- CHARTS AREA -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-12">
        
        <!-- Bar Chart -->
        <div class="bg-[#181818] border border-zinc-800 rounded-2xl p-6 shadow-lg flex flex-col">
            <h3 class="text-base font-bold text-white mb-6 uppercase tracking-wider flex items-center gap-2">
                <i data-lucide="bar-chart-2" class="w-5 h-5 text-[#1DB954]"></i> Performa Tracks
            </h3>
            <div class="relative w-full h-72">
                <canvas id="barChart"></canvas>
            </div>
        </div>

        <!-- Doughnut Chart -->
        <div class="bg-[#181818] border border-zinc-800 rounded-2xl p-6 shadow-lg flex flex-col">
            <h3 class="text-base font-bold text-white mb-6 uppercase tracking-wider flex items-center gap-2">
                <i data-lucide="pie-chart" class="w-5 h-5 text-purple-400"></i> Distribusi Klik
            </h3>
            <div class="relative w-full h-72 flex justify-center items-center">
                <canvas id="doughnutChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Script Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Memastikan data aman jika kosong
    const chartLabels = @json($chartLabels ?? []);
    const chartData = @json($chartData ?? []);

    // Palet Warna Dark Mode khas aplikasi musik (Spotify Green, Purple, Blue, dll)
    const bgColors = [
        'rgba(29, 185, 84, 0.8)',   // #1DB954 (Spotify Green)
        'rgba(139, 92, 246, 0.8)',  // Purple
        'rgba(59, 130, 246, 0.8)',  // Blue
        'rgba(236, 72, 153, 0.8)',  // Pink
        'rgba(245, 158, 11, 0.8)'   // Amber
    ];
    
    // Warna border sedikit lebih solid dari background-nya
    const borderColors = [
        '#1DB954', 
        '#8b5cf6', 
        '#3b82f6', 
        '#ec4899', 
        '#f59e0b'
    ];

    // Setup global font color untuk mode gelap
    Chart.defaults.font.family = 'Inter, ui-sans-serif, system-ui, sans-serif';
    Chart.defaults.color = '#a1a1aa'; // zinc-400

    // 1. BAR CHART
    const ctxBar = document.getElementById('barChart').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Total Plays',
                data: chartData,
                backgroundColor: bgColors,
                borderColor: borderColors,
                borderWidth: 1,
                borderRadius: 4, // Ujung bar agak melengkung
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 },
                    grid: { 
                        color: '#27272a', // Garis grid gelap (zinc-800)
                        drawBorder: false 
                    } 
                },
                x: {
                    grid: { display: false, drawBorder: false }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#282828',
                    titleColor: '#fff',
                    bodyColor: '#1DB954',
                    borderColor: '#3f3f46',
                    borderWidth: 1
                }
            }
        }
    });

    // 2. DOUGHNUT CHART
    const ctxDoughnut = document.getElementById('doughnutChart').getContext('2d');
    new Chart(ctxDoughnut, {
        type: 'doughnut',
        data: {
            labels: chartLabels,
            datasets: [{
                data: chartData,
                backgroundColor: bgColors,
                borderColor: '#181818', // Warna border menyesuaikan warna card agar terlihat "terpotong"
                borderWidth: 4,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%', // Lubang tengah lebih besar ala UI modern
            plugins: {
                legend: { 
                    position: 'right', 
                    labels: { 
                        color: '#a1a1aa',
                        padding: 20
                    } 
                },
                tooltip: {
                    backgroundColor: '#282828',
                    titleColor: '#fff',
                    bodyColor: '#1DB954',
                    borderColor: '#3f3f46',
                    borderWidth: 1
                }
            }
        }
    });
</script>
@endsection