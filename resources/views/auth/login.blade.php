<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Panitia - Konser Musik 2026</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        .bg-grid-pattern {
            /* Mengubah warna latar belakang menjadi nuansa ungu terang khas event */
            background-color: #e9d5ff; 
            background-image:
                linear-gradient(to right, rgba(15, 23, 42, 0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(15, 23, 42, 0.05) 1px, transparent 1px);
            background-size: 30px 30px;
        }
    </style>
</head>
<body class="bg-grid-pattern min-h-screen font-sans antialiased flex flex-col justify-center py-12 sm:px-6 lg:px-8">

    <div class="sm:mx-auto sm:w-full sm:max-w-md px-4">

        <!-- Header Brand -->
        <div class="text-center mb-8">
            <!-- Warna kotak ikon diubah menjadi fuchsia/pink -->
            <div class="w-16 h-16 bg-fuchsia-300 border-4 border-slate-900 rounded-2xl flex items-center justify-center shadow-[4px_4px_0px_0px_#0f172a] mx-auto mb-4">
                <!-- Ikon diganti menjadi tiket -->
                <i data-lucide="ticket" class="w-8 h-8 text-slate-900 stroke-[2.5]"></i>
            </div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Login Panitia</h1>
            <p class="text-sm font-bold text-slate-600 mt-2">Masuk untuk mengelola tautan informasi & tiket konser</p>
        </div>

        <!-- Form Container Card -->
        <div class="bg-white border-4 border-slate-900 rounded-3xl p-6 sm:p-8 shadow-[8px_8px_0px_0px_#0f172a]">

            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Display Alert Error -->
                @if($errors->any())
                    <div class="bg-rose-200 border-2 border-slate-900 p-4 rounded-xl flex items-start gap-3 shadow-[2px_2px_0px_0px_#0f172a]">
                        <i data-lucide="alert-triangle" class="w-5 h-5 text-rose-800 shrink-0 mt-0.5"></i>
                        <p class="text-sm font-bold text-rose-900">{{ $errors->first() }}</p>
                    </div>
                @endif

                <!-- Input Email -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-extrabold text-slate-900">Alamat Email Panitia</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-900 rounded-xl focus:outline-none focus:ring-4 focus:ring-fuchsia-500/20 focus:border-fuchsia-500 font-medium text-slate-900 transition-all placeholder:text-slate-400">
                </div>

                <!-- Input Password -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-extrabold text-slate-900">Kata Sandi</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-900 rounded-xl focus:outline-none focus:ring-4 focus:ring-fuchsia-500/20 focus:border-fuchsia-500 font-medium text-slate-900 transition-all placeholder:text-slate-400">
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <!-- Warna tombol diubah ke fuchsia -->
                    <button type="submit" class="w-full bg-fuchsia-400 hover:bg-fuchsia-300 text-slate-950 font-extrabold py-3.5 rounded-xl border-2 border-slate-900 shadow-[4px_4px_0px_0px_#0f172a] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all flex items-center justify-center gap-2">
                        Masuk Dashboard <i data-lucide="arrow-right" class="w-5 h-5 stroke-[2.5]"></i>
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>