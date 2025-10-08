<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dinas Arsip Keuangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-overlay { background: linear-gradient(135deg, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.5)); }
        .eye-icon:hover { transform: scale(1.1); }
        .login-button { background: linear-gradient(135deg, #1e40af, #3b82f6); transition: all 0.3s ease; }
        .login-button:hover {
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
        }
    </style>
</head>
<body class="min-h-screen flex">
@error('email')
    <div class="fixed top-0 left-0 w-full bg-red-600 text-white text-center py-2 z-50">
        {{ $message }}
    </div>
    
@enderror
    <!-- Left Side -->
    <div class="w-full lg:w-2/5 bg-white flex items-center justify-center p-8">
        <div class="w-full max-w-md">
            <!-- Logo/Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Login</h1>
                <div class="w-12 h-1 bg-blue-600 rounded-full"></div>
            </div>

            <!-- Form Login Laravel -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email/ID Pengguna -->
                <div>
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email Pengguna</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg 
                               focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none"
                        placeholder="Masukkan email anda">
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-gray-700 font-medium mb-2">Kata Sandi</label>
                    <div class="relative">
                        <input id="password" type="password" name="password" required
                            class="form-input w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg 
                                   focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none"
                            placeholder="Masukkan kata sandi">
                        <button type="button" onclick="togglePassword()" 
                            class="eye-icon absolute right-4 top-3 text-gray-400 hover:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 3C5 3 1.73 7.11 1.07 10c.66 2.89 4.93 7 8.93 7s8.27-4.11 8.93-7c-.66-2.89-4.93-7-8.93-7zM10 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8a3 3 0 100 6 3 3 0 000-6z" /></svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Lupa Password -->
                <div class="text-left">
                    <a href="{{ route('password.request') }}" class="text-gray-700 hover:text-blue-600 font-medium">
                        Lupa Kata Sandi?
                    </a>
                </div>

                <!-- Tombol Login -->
                <button type="submit" class="login-button w-full py-3 px-4 text-white font-bold rounded-lg">
                    Login
                </button>

               
            </form>
        </div>
    </div>

    <!-- Right Side -->
    <div class="hidden lg:block lg:w-3/5 relative">
        <img src="https://images.bisnis.com/posts/2024/08/21/1792768/gedung_kemenkeu_1_1718084883.jpg"
             alt="Background"
             class="w-full h-full object-cover">
        <div class="bg-overlay absolute inset-0 flex items-center justify-center">
            <div class="text-center text-white px-8">
                <h2 class="text-5xl font-bold mb-4 leading-tight">
                    DINAS<br>ARSIP<br>KEUANGAN
                </h2>
                <div class="w-24 h-1 bg-white mx-auto opacity-75"></div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById("password");
            password.type = password.type === "password" ? "text" : "password";
        }
    </script>
</body>
</html>
