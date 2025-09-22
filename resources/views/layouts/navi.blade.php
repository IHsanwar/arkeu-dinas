
<nav class="bg-white/80 backdrop-blur-md shadow-lg sticky top-0 z-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                   <img src="{{ asset('keuangan.png') }}" alt="Logo" class="h-14 w-14">
                    <div class="text-xl font-bold text-gray-800">Arsip Keuangan</div>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
    <a href="{{ route('dashboard') }}"
       class="{{ request()->routeIs('dashboard') 
            ? 'text-blue-600 font-semibold' 
            : 'text-gray-600 hover:text-blue-600 transition-colors font-medium' }}">
        Dashboard
    </a>

    <a href="{{ route('laporan.index') }}"
       class="{{ request()->routeIs('laporan.*') 
            ? 'text-blue-600 font-semibold' 
            : 'text-gray-600 hover:text-blue-600 transition-colors font-medium' }}">
        Laporan
    </a>

    @if (Auth::user() && Auth::user()->role === 'admin')
        <a href="{{ route('pengguna') }}"
           class="{{ request()->routeIs('pengguna') 
                ? 'text-blue-600 font-semibold' 
                : 'text-gray-600 hover:text-blue-600 transition-colors font-medium' }}">
            Pengguna
        </a>
    @endif
</div>


                <div class="flex items-center space-x-4">
                    <button class="p-2 text-gray-600 hover:text-blue-600 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2L3 7v11a1 1 0 001 1h3v-6h6v6h3a1 1 0 001-1V7l-7-5z"/>
                        </svg>
                    </button>
                    <div class="relative">
                        <button class="flex items-center space-x-2 bg-gray-100 hover:bg-gray-200 px-3 py-2 rounded-lg transition-colors" onclick="toggleDropdown()">
                            <div class="w-8 h-8 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center">
                                <span class="text-white font-medium text-sm">{{ strtoupper(substr(Auth::user()->name ?? 'AD', 0, 2)) }}</span>
                            </div>
                            <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name ?? 'Admin User' }}</span>
                            <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <div id="dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pengaturan</a>
                            <hr class="my-1">
                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Keluar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>