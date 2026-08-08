@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    
    <!-- Header Dashboard Modern -->
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-slate-900 to-slate-600 tracking-tight">Dashboard Analytics</h1>
            <p class="text-slate-500 font-medium mt-1">Ringkasan performa akses tautan informasi dan tiket konser.</p>
        </div>
        <a href="{{ route('admin.links.index') }}" class="hidden sm:flex bg-slate-900 hover:bg-slate-800 text-white font-semibold py-2.5 px-6 rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all items-center gap-2">
            Kelola Tautan <i data-lucide="arrow-right" class="w-4 h-4"></i>
        </a>
    </div>

    <!-- 1. SUMMARY CARDS (Colorful Modern) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <!-- Card: Total Tautan (Biru) -->
        <div class="bg-white border-0 rounded-2xl p-6 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -z-10 transition-transform group-hover:scale-110"></div>
            <div class="bg-gradient-to-br from-blue-500 to-indigo-600 w-14 h-14 rounded-xl flex items-center justify-center mb-4 shadow-lg shadow-blue-500/30 text-white">
                <i data-lucide="link" class="w-7 h-7"></i>
            </div>
            <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Total Tautan</h3>
            <div class="flex items-baseline gap-2">
                <span class="text-4xl font-extrabold text-slate-800">{{ $totalLinks }}</span>
                <span class="text-sm font-semibold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md">({{ $activeLinks }} Aktif)</span>
            </div>
        </div>

        <!-- Card: Total Klik (Hijau Zamrud) -->
        <div class="bg-white border-0 rounded-2xl p-6 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-full -z-10 transition-transform group-hover:scale-110"></div>
            <div class="bg-gradient-to-br from-emerald-400 to-teal-500 w-14 h-14 rounded-xl flex items-center justify-center mb-4 shadow-lg shadow-emerald-500/30 text-white">
                <i data-lucide="mouse-pointer-click" class="w-7 h-7"></i>
            </div>
            <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Total Akses Tautan</h3>
            <span class="text-4xl font-extrabold text-slate-800">{{ $totalClicks }}</span>
        </div>

        <!-- Card: Top Link (Kuning/Amber) -->
        <div class="bg-white border-0 rounded-2xl p-6 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-bl-full -z-10 transition-transform group-hover:scale-110"></div>
            <div class="bg-gradient-to-br from-amber-400 to-orange-500 w-14 h-14 rounded-xl flex items-center justify-center mb-4 shadow-lg shadow-amber-500/30 text-white">
                <i data-lucide="trophy" class="w-7 h-7"></i>
            </div>
            <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Tautan Terpopuler</h3>
            @if($topLink)
                <p class="text-lg font-extrabold text-slate-800 truncate mb-2">{{ $topLink->title }}</p>
                <p class="text-xs font-bold text-orange-700 bg-orange-100 inline-block px-3 py-1.5 rounded-lg">{{ $topLink->clicks }} Total Klik</p>
            @else
                <p class="text-lg font-extrabold text-slate-800">Belum ada data</p>
            @endif
        </div>

    </div>

    <!-- 2 & 3. CHARTS AREA -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-12">
        
        <!-- Bar Chart -->
        <div class="bg-white border-0 rounded-2xl p-6 shadow-md flex flex-col">
            <h3 class="text-base font-extrabold text-slate-800 mb-6 uppercase tracking-wider flex items-center gap-2">
                <i data-lucide="bar-chart-2" class="w-5 h-5 text-indigo-500"></i> Perbandingan Klik
            </h3>
            <div class="relative w-full h-72">
                <canvas id="barChart"></canvas>
            </div>
        </div>

        <!-- Doughnut Chart -->
        <div class="bg-white border-0 rounded-2xl p-6 shadow-md flex flex-col">
            <h3 class="text-base font-extrabold text-slate-800 mb-6 uppercase tracking-wider flex items-center gap-2">
                <i data-lucide="pie-chart" class="w-5 h-5 text-pink-500"></i> Distribusi Minat Audiens
            </h3>
            <div class="relative w-full h-72 flex justify-center items-center">
                <canvas id="doughnutChart"></canvas>
            </div>
        </div>

    </div>
</div>

<!-- ========================================== -->
<!-- SCRIPT CHART.JS COLORFUL MODERN            -->
<!-- ========================================== -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const chartLabels = @json($chartLabels);
    const chartData = @json($chartData);

    // Palet Warna Festival Vibrant & Kontras
    const bgColors = [
        'rgba(59, 130, 246, 0.8)',   // Biru
        'rgba(16, 185, 129, 0.8)',   // Zamrud
        'rgba(245, 158, 11, 0.8)',   // Kuning
        'rgba(236, 72, 153, 0.8)',   // Pink
        'rgba(139, 92, 246, 0.8)'    // Ungu
    ];
    const borderColors = ['#2563eb', '#059669', '#d97706', '#db2777', '#7c3aed'];

    Chart.defaults.font.family = 'Inter, sans-serif';
    Chart.defaults.color = '#64748b';

    // 1. BAR CHART
    const ctxBar = document.getElementById('barChart').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Jumlah Klik',
                data: chartData,
                backgroundColor: bgColors,
                borderColor: borderColors,
                borderWidth: 2,
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 },
                    grid: { color: '#f1f5f9', drawBorder: false }
                },
                x: {
                    grid: { display: false, drawBorder: false }
                }
            },
            plugins: {
                legend: { display: false }
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
                borderColor: '#ffffff',
                borderWidth: 4,
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%', 
            plugins: {
                legend: { position: 'right' }
            }
        }
    });
</script>
@endsection