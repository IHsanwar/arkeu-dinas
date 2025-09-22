<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DINAS ARSIP KEUANGAN - Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-building {
            background-image: url('tes.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .form-glass {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.95);
        }
        
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            border-color: #3b82f6;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }
        
        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .slide-in {
            animation: slideIn 1s ease-out;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="min-h-screen flex">
    @error('email')
        <div class="fixed top-0 left-0 w-full bg-red-600 text-white text-center py-2 z-50">
            {{ $message }}
        </div>
    @enderror
    <!-- Left Panel - Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 form-glass">
        <div class="w-full max-w-md fade-in">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Daftar</h1>
                <div class="w-16 h-1 bg-blue-600 rounded-full"></div>
            </div>
            
            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}">
        @csrf
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none input-focus transition-all duration-300 bg-white"
                        placeholder="Masukkan nama lengkap"
                        required
                    >
                </div>
                
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none input-focus transition-all duration-300 bg-white"
                        placeholder="user@example.com"
                        required
                    >
                </div>
                
                <!-- Role Field -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                    <select 
                        id="role" 
                        name="role" 
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none input-focus transition-all duration-300 bg-white"
                        required
                    >
                        <option value="">Pilih Role</option>
                        <option value="admin">Admin</option>
                        <option value="bendahara">Bendahara</option>
                    </select>
                </div>
                
                <!-- Password Field -->
               <div class="relative">
    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Kata Sandi</label>
    <input 
        type="password" 
        id="password" 
        name="password" 
        minlength="8"
        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none input-focus transition-all duration-300 bg-white pr-12"
        placeholder="••••••••"
        required
    >
    <button 
        type="button" 
        class="absolute right-3 top-11 text-gray-400 hover:text-gray-600 transition-colors duration-200"
        onclick="togglePassword('password')"
    >
        <!-- icon mata -->
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        </svg>
    </button>
</div>

<!-- Confirm Password Field -->
<div class="relative">
    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Kata Sandi</label>
    <input 
        type="password" 
        id="password_confirmation" 
        name="password_confirmation" 
        minlength="8"
        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none input-focus transition-all duration-300 bg-white pr-12"
        placeholder="••••••••"
        required
    >
    <button 
        type="button" 
        class="absolute right-3 top-11 text-gray-400 hover:text-gray-600 transition-colors duration-200"
        onclick="togglePassword('password_confirmation')"
    >
        <!-- icon mata -->
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        </svg>
    </button>
</div>

<script>
function togglePassword(id) {
    const input = document.getElementById(id);
    input.type = input.type === "password" ? "text" : "password";
}

// Validasi tambahan sebelum submit
document.querySelector("form").addEventListener("submit", function(e) {
    const pass = document.getElementById("password").value;
    const passConfirm = document.getElementById("password_confirmation").value;

    if (pass.length < 8) {
        alert("Password minimal 8 karakter!");
        e.preventDefault();
    } else if (pass !== passConfirm) {
        alert("Konfirmasi password tidak sama!");
        e.preventDefault();
    }
});
</script>

                
                <!-- Forgot Password Link -->
                <div class="flex justify-end">
                    <a href="/login" class="text-sm text-gray-600 hover:text-blue-600 transition-colors duration-200">
                        Sudah punya akun?
                    </a>
                </div>
                
                <!-- Register Button -->
                <button 
                    type="submit" 
                    class="w-full py-3 px-4 btn-primary text-white font-semibold rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300"
                >
                    Daftar
                </button>
                
                <!-- Login Link -->
                <div class="text-center">
                    <span class="text-gray-600">Pengguna Baru? </span>
                    <a href="/laporan" class="text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200">
                        Masuk disini
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Right Panel - Building Image with Overlay -->
    <div class="hidden lg:block lg:w-1/2 relative bg-building">
         <img src="https://images.bisnis.com/posts/2024/08/21/1792768/gedung_kemenkeu_1_1718084883.jpg"
             alt="Background"
             class="w-full h-full object-cover">
        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        
        <!-- Content Overlay -->
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center text-white slide-in">
                <h1 class="text-5xl font-bold mb-4 leading-tight">
                    DINAS<br>
                    ARSIP<br>
                    KEUANGAN
                </h1>
                <div class="w-24 h-1 bg-white mx-auto rounded-full"></div>
            </div>
        </div>
        
        
        
        
    </div>
    
    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
            field.setAttribute('type', type);
        }
        
        // Add some interactive effects
        document.querySelectorAll('input, select').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('transform', 'scale-105');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('transform', 'scale-105');
            });
        });
        
        // Form submission animation
        
    </script>
</body>
</html>