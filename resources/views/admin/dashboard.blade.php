@extends('layouts.navbar')
@include('layouts.navi')

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="animate-fade-in mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Manajemen Pengguna</h2>
            <p class="text-gray-600">Kelola akses dan izin pengguna sistem.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- User Management -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 animate-slide-up">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="space-y-6">
                        <!-- Header with Add Button -->
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Daftar Pengguna</h3>
                            <button onclick="showAddUserModal()" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-2 rounded-lg hover:from-blue-700 hover:to-purple-700 transition-colors font-medium">
                                + Tambah Pengguna
                            </button>
                        </div>

                        <!-- Search and Filter -->
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="flex-1">
                                <input type="text" id="searchInput" placeholder="Cari pengguna..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" onkeyup="filterUsers()">
                            </div>
                            <select id="roleFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" onchange="filterUsers()">
                                <option value="">Semua Role</option>
                                <option value="admin">Admin</option>
                                <option value="auditor">Auditor</option>
                                <option value="viewer">Viewer</option>
                            </select>
                        </div>
                        
                        <!-- User List -->
                        <div class="space-y-3" id="usersList">
                            @forelse($users as $user)
                                <div class="user-item flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors" 
                                     data-name="{{ strtolower($user->name) }}" 
                                     data-email="{{ strtolower($user->email) }}" 
                                     data-role="{{ strtolower($user->role ?? 'viewer') }}">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                            <span class="text-white font-medium text-sm">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $user->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                            <p class="text-xs text-gray-400">Bergabung: {{ $user->created_at ? $user->created_at->format('d M Y') : 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        @php
                                            $role = $user->role ?? 'viewer';
                                            $roleClass = match($role) {
                                                'admin' => 'bg-green-100 text-green-800',
                                                'auditor' => 'bg-blue-100 text-blue-800',
                                                default => 'bg-gray-100 text-gray-800'
                                            };
                                            $roleLabel = ucfirst($role);
                                        @endphp
                                        <span class="px-3 py-1 {{ $roleClass }} text-xs font-medium rounded-full">{{ $roleLabel }}</span>
                                        <div class="flex items-center space-x-1">
                                            <!--
                                            <button onclick="editUser({{ $user->id }})" class="p-1 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded" title="Edit">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                                </svg>--> 
                                            </button>
                                            <button onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')" class="p-1 text-red-600 hover:text-red-800 hover:bg-red-50 rounded" title="Hapus">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada pengguna</h3>
                                    <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan pengguna baru.</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Pagination (if needed) -->
                        @if($users instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                                {{ $users->links() }}
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Role Permissions -->
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 p-6 rounded-xl">
                        <h4 class="font-semibold text-gray-900 mb-4">Izin Akses</h4>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Admin</span>
                                <span class="font-medium text-green-700 bg-green-100 px-2 py-1 rounded-full text-xs">Full Access</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Bendahara</span>
                                <span class="font-medium text-blue-700 bg-blue-100 px-2 py-1 rounded-full text-xs">Read/Write</span>
                            </div>
                            
                        </div>
                    </div>

                    <!-- User Statistics -->
                    <div class="bg-white border border-gray-200 rounded-xl p-6">
                        <h4 class="font-semibold text-gray-900 mb-4">Statistik Pengguna</h4>
                        <div class="space-y-3">
                            @php
                                $totalUsers = $users->count();
                                $adminUsers = $users->where('role', 'admin')->count();
                                $auditorUsers = $users->where('role', 'bendahara')->count();
                                $activeThisMonth = $users->where('updated_at', '>=', now()->startOfMonth())->count();
                            @endphp
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Total Pengguna</span>
                                <span class="text-sm font-semibold text-gray-900">{{ $totalUsers }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Admin</span>
                                <span class="text-sm font-semibold text-green-700">{{ $adminUsers }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Bendahara</span>
                                <span class="text-sm font-semibold text-blue-700">{{ $auditorUsers }}</span>
                            </div>
                            
                            <hr class="my-2">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Aktif Bulan Ini</span>
                                <span class="text-sm font-semibold text-purple-700">{{ $activeThisMonth }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Add User Modal (Hidden by default) -->
    <div id="addUserModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Tambah Pengguna Baru</h3>
                <form id="addUserForm" action="{{ route('add.user') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan nama lengkap">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="nama@company.com">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" name="password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Password">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                        <select name="role" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="bendahara">Bendahara</option>
                        </select>
                    </div>
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="hideAddUserModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                            Tambah Pengguna
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // CSRF token for AJAX requests
        function getCSRFToken() {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        }

        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown');
            dropdown.classList.toggle('hidden');
        }
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('dropdown');
            const button = event.target.closest('button');
            
            if (!button || !button.onclick || button.onclick.toString().indexOf('toggleDropdown') === -1) {
                dropdown.classList.add('hidden');
            }
        });

        function showAddUserModal() {
            document.getElementById('addUserModal').classList.remove('hidden');
        }

        function hideAddUserModal() {
            document.getElementById('addUserModal').classList.add('hidden');
            document.getElementById('addUserForm').reset();
        }

        function editUser(userId) {
            console.log('Edit user:', userId);
            // You can redirect to edit page or open edit modal
            window.location.href = `/users/${userId}/edit`;
        }

        function deleteUser(userId, userName) {
            if (confirm(`Apakah Anda yakin ingin menghapus pengguna ${userName}?`)) {
                // Create a form to delete user
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/pengguna/${userId}`;
                
                // Add CSRF token
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = getCSRFToken();
                form.appendChild(csrfInput);
                
                // Add method spoofing for DELETE
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);
                
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Filter functionality
        function filterUsers() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const roleFilter = document.getElementById('roleFilter').value.toLowerCase();
            const userItems = document.querySelectorAll('.user-item');
            
            userItems.forEach(item => {
                const name = item.dataset.name;
                const email = item.dataset.email;
                const role = item.dataset.role;
                
                const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm);
                const matchesRole = roleFilter === '' || role === roleFilter;
                
                if (matchesSearch && matchesRole) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Add smooth transitions to all interactive elements
            const interactiveElements = document.querySelectorAll('button, a, input, select');
            interactiveElements.forEach(element => {
                element.style.transition = 'all 0.2s ease';
            });
        });
    </script>
</body>
</html>