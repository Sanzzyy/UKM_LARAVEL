<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register - Mitra Nasi Goreng</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body
        class="min-h-screen flex items-center justify-center px-4
           bg-gradient-to-br from-slate-900 via-slate-800 to-orange-900">

        <!-- Card -->
        <div
            class="w-full max-w-md
               bg-slate-900/90 backdrop-blur
               border border-white/10
               rounded-2xl shadow-2xl
               p-6 sm:p-8">

            <!-- Header -->
            <div class="text-center mb-8">
                <div
                    class="mx-auto mb-3
                       w-14 h-14 flex items-center justify-center
                       rounded-2xl bg-orange-500/20 text-orange-400">
                    <span class="text-3xl">🍛</span>
                </div>

                <h1 class="text-2xl font-extrabold text-white tracking-tight">
                    Daftar Akun
                </h1>
                <p class="text-sm text-slate-400 mt-1">
                    Buat akun untuk mengakses sistem
                </p>
            </div>

            <!-- Success -->
            @if (session('success'))
                <div
                    class="mb-4 rounded-lg border border-green-500/30
                       bg-green-500/10 px-4 py-3 text-sm text-green-300">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Errors -->
            @if ($errors->any())
                <div
                    class="mb-4 rounded-lg border border-red-500/30
                       bg-red-500/10 px-4 py-3 text-sm text-red-300">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Username -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">
                        Username
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="admin1 / karyawan1"
                        required
                        class="w-full rounded-lg bg-slate-800/70 border border-slate-700
                           px-4 py-2.5 text-sm text-white
                           placeholder:text-slate-500
                           focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                           focus:outline-none">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">
                        Email
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="contoh@email.com"
                        required
                        class="w-full rounded-lg bg-slate-800/70 border border-slate-700
                           px-4 py-2.5 text-sm text-white
                           placeholder:text-slate-500
                           focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                           focus:outline-none">
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">
                        Password
                    </label>
                    <input type="password" name="password" placeholder="Minimal 6 karakter" required
                        class="w-full rounded-lg bg-slate-800/70 border border-slate-700
                           px-4 py-2.5 text-sm text-white
                           placeholder:text-slate-500
                           focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                           focus:outline-none">
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">
                        Konfirmasi Password
                    </label>
                    <input type="password" name="password_confirmation" placeholder="Ulangi password" required
                        class="w-full rounded-lg bg-slate-800/70 border border-slate-700
                           px-4 py-2.5 text-sm text-white
                           placeholder:text-slate-500
                           focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                           focus:outline-none">
                </div>

                <!-- Role -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">
                        Role
                    </label>
                    <select name="role" required
                        class="w-full rounded-lg bg-slate-800/70 border border-slate-700
                           px-4 py-2.5 text-sm text-white
                           focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                           focus:outline-none">
                        <option value="">-- Pilih Role --</option>
                        <option value="admin">Admin</option>
                        <option value="kasir">Kasir</option>
                    </select>
                    <p class="text-xs text-slate-500 mt-1">
                        Admin harus mengandung <b>admin</b>,
                        kasir <b>karyawan</b>
                    </p>
                </div>

                <!-- Button -->
                <button type="submit"
                    class="w-full rounded-lg
                       bg-orange-500 hover:bg-orange-600
                       py-3 text-sm font-bold text-white
                       transition">
                    Daftar
                </button>
            </form>

            <!-- Footer -->
            <p class="mt-6 text-center text-sm text-slate-400">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-semibold text-orange-400 hover:text-orange-300">
                    Login
                </a>
            </p>

        </div>

    </body>

</html>
