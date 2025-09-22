@extends('layouts.navbar')
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <!-- Navigation -->
     @include('layouts.navi')

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="animate-fade-in mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Audit Data</h2>
            <p class="text-gray-600">Kelola dan monitor proses audit data tabungan.</p>
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

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 animate-slide-up">
            @php
                $totalLaporan = $laporan->count();
                $selesai = $laporan->where('status', 'selesai')->count();
                $proses = $laporan->where('status', 'proses')->count();
                $menunggu = $laporan->where('status', 'menunggu')->count();
                $complianceRate = $totalLaporan > 0 ? round(($selesai / $totalLaporan) * 100, 1) : 0;
            @endphp
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Audit</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalLaporan }}</p>
                        <p class="text-xs text-blue-600 mt-1">{{ $laporan->where('created_at', '>=', now()->startOfMonth())->count() }} audit baru bulan ini</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Sedang Berjalan</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $proses }}</p>
                        <p class="text-xs text-yellow-600 mt-1">{{ $menunggu }} audit menunggu review</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Selesai</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $selesai }}</p>
                        <p class="text-xs text-green-600 mt-1">{{ $laporan->where('status', 'selesai')->where('updated_at', '>=', now()->startOfWeek())->count() }} selesai minggu ini</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Compliance Rate</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $complianceRate }}%</p>
                        <p class="text-xs text-green-600 mt-1">Target: 95%</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Audit Controls -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
            <div class="flex flex-col lg:flex-row gap-6">
                <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Filter Status</label>
                        <select id="statusFilter" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" onchange="filterLaporan()">
                            <option value="">Semua Status</option>
                            <option value="selesai">Selesai</option>
                            <option value="proses">Sedang Proses</option>
                            <option value="menunggu">Menunggu Review</option>
                            <option value="ditunda">Ditunda</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                        <select id="periodeFilter" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" onchange="filterLaporan()">
                            <option value="">Semua Periode</option>
                            <option value="{{ now()->format('Y-m') }}">Bulan Ini</option>
                            <option value="{{ now()->subMonth()->format('Y-m') }}">Bulan Lalu</option>
                            <option value="{{ now()->format('Y') }}">Tahun Ini</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                        <input type="text" id="searchInput" placeholder="Cari judul laporan..." class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" onkeyup="filterLaporan()">
                    </div>
                </div>
                @if(auth()->user()->role === 'bendahara' || auth()->user()->role === 'admin')
                <div class="flex items-end">
                    <button onclick="showNewAuditModal()" class="bg-gradient-to-r from-green-600 to-blue-600 text-white px-6 py-3 rounded-lg hover:from-green-700 hover:to-blue-700 transition-colors font-medium flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                        </svg>
                        <span>Audit Baru</span>
                    </button>
                </div>
                @endif
                <div class="flex items-end">
                    <div class="relative">
                        <a href="/laporan/download"  class="bg-gray-100 text-gray-700 px-4 py-3 rounded-lg hover:bg-gray-200 transition-colors font-medium flex items-center space-x-2">
                            <span>Cetak PDF</span>
                        </a>
                    </div>
</div>
            </div>
        </div>

        <!-- Audit Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden animate-bounce-in">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Audit</h3>
                    <div class="flex space-x-3">
                        <!--
                        <button onclick="exportData()" class="text-gray-600 hover:text-blue-600 transition-colors" title="Export">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button> -->
                    </div>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Audit</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Laporan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anggaran</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Auditor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Dibuat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="laporanTableBody">
                        @forelse($laporan as $item)
                            <tr class="laporan-item hover:bg-gray-50 transition-colors" 
                                data-status="{{ $item->status ?? 'proses' }}" 
                                data-judul="{{ strtolower($item->judul ?? '') }}"
                                data-periode="{{ $item->created_at ? $item->created_at->format('Y-m') : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    #LAP{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $item->judul ?? 'Laporan Audit' }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit($item->deskripsi ?? 'Tidak ada deskripsi', 50) }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $item->total_anggaran ? 'Rp ' . number_format($item->total_anggaran, 0, ',', '.') : 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $status = $item->status ?? 'proses';
                                        $statusClass = match($status) {
                                            'selesai' => 'bg-green-100 text-green-800',
                                            'proses' => 'bg-yellow-100 text-yellow-800',
                                            'menunggu' => 'bg-blue-100 text-blue-800',
                                            'ditunda' => 'bg-red-100 text-red-800',
                                            default => 'bg-gray-100 text-gray-800'
                                        };
                                        $statusLabel = match($status) {
                                            'selesai' => 'Selesai',
                                            'proses' => 'Sedang Proses',
                                            'menunggu' => 'Menunggu Review',
                                            'ditunda' => 'Ditunda',
                                            default => 'Tidak Diketahui'
                                        };
                                    @endphp
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                        {{ $statusLabel }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-white font-medium text-xs">{{ $item->user ? strtoupper(substr($item->user->name, 0, 2)) : 'NA' }}</span>
                                        </div>
                                        <div class="text-sm font-medium text-gray-900">{{ $item->user->name ?? 'Tidak Ada Auditor' }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $item->created_at ? $item->created_at->format('d M Y') : 'N/A' }}
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                  <button onclick="showEditAuditModal({{ $item->id }}, '{{ addslashes($item->judul) }}', '{{ $item->total_anggaran }}', '{{ $item->created_at ? $item->created_at->format('Y-m-d') : '' }}', '{{ $item->status }}', '{{ addslashes($item->deskripsi) }}')" 
                                        class="text-indigo-600 hover:text-indigo-900 transition-colors">
                                                Edit
                                            </button>

                            
                                    <button onclick="deleteLaporan({{ $item->id }}, '{{ $item->judul }}')" class="text-red-600 hover:text-red-900 transition-colors">Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada laporan audit</h3>
                                        <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat laporan audit baru.</p>
                                        <div class="mt-6"> 
                                        @if(auth()->user()->role === 'bendahara' || auth()->user()->role === 'admin')
                                            <button onclick="showNewAuditModal()" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                                <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                                </svg>
                                                Buat Audit Baru
                                            </button>
                                        @endif
                                    </div>
                                    
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($laporan instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="bg-white px-6 py-3 border-t border-gray-200">
                    {{ $laporan->links() }}
                </div>
            @endif
        </div>
    </main>
    <div id="editAuditModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Edit Audit</h3>
           <form id="editAuditForm" method="POST" action="" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_laporan_id" name="laporan_id">
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Laporan</label>
                    <input type="text" id="edit_judul" name="judul" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan judul laporan">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Total Anggaran (Rp)</label>
                    <input type="number" id="edit_total_anggaran" name="total_anggaran" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan anggaran angka saja">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                    <input type="date" id="edit_tanggal" name="tanggal" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Laporan</label>
                    <select id="edit_status" name="status" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih status</option>
                        <option value="proses">Sedang Proses</option>
                        <option value="menunggu">Menunggu Review</option>
                        <option value="ditunda">Ditunda</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea id="edit_deskripsi" name="deskripsi" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none" rows="3" placeholder="Deskripsi audit (opsional)"></textarea>
                </div>
                
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="hideEditAuditModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                        Update Audit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- New Audit Modal -->
    <div id="newAuditModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Buat Audit Baru</h3>
                <form action="{{ route('laporan.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Laporan</label>
                        <input type="text" name="judul" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan judul laporan">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Total Anggaran (Rp)</label>
                        <input type="number" name="total_anggaran" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan anggaran angka saja">
                    </div>
                    <div>
                    
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" name="tanggal" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ date('Y-m-d') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Laporan</label>
                        <select name="status" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih status</option>
                            <option value="proses">Sedang Proses</option>
                            <option value="menunggu">Menunggu Review</option>
                            <option value="ditunda">Ditunda</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="deskripsi" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none" rows="3" placeholder="Deskripsi audit (opsional)"></textarea>
                    </div>
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="hideNewAuditModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                            Buat Audit
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Audit Modal -->

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

        function showNewAuditModal() {
            document.getElementById('newAuditModal').classList.remove('hidden');
        }

        function hideNewAuditModal() {
            document.getElementById('newAuditModal').classList.add('hidden');
        }

        function showEditAuditModal(id, judul, total_anggaran, tanggal, status, deskripsi) {
                    const form = document.getElementById('editAuditForm');
                    form.action = `/laporan/${id}`; // sesuai route('laporan.update', id)
                    console.log("Form action:", form.action);

                    document.getElementById('edit_laporan_id').value = id;
                    document.getElementById('edit_judul').value = judul;
                    document.getElementById('edit_total_anggaran').value = total_anggaran;
                    document.getElementById('edit_tanggal').value = tanggal;
                    document.getElementById('edit_status').value = status;
                    document.getElementById('edit_deskripsi').value = deskripsi;

                    document.getElementById('editAuditModal').classList.remove('hidden');
                }




        function hideEditAuditModal() {
            document.getElementById('editAuditModal').classList.add('hidden');
            // Clear form
            document.getElementById('editAuditForm').reset();
        }

        // Filter functionality
        function filterLaporan() {
            const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
            const periodeFilter = document.getElementById('periodeFilter').value;
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const laporanItems = document.querySelectorAll('.laporan-item');
            
            laporanItems.forEach(item => {
                const status = item.dataset.status;
                const judul = item.dataset.judul;
                const periode = item.dataset.periode;
                
                const matchesStatus = statusFilter === '' || status === statusFilter;
                const matchesPeriode = periodeFilter === '' || periode.startsWith(periodeFilter);
                const matchesSearch = searchTerm === '' || judul.includes(searchTerm);
                
                if (matchesStatus && matchesPeriode && matchesSearch) {
                    item.style.display = 'table-row';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // Audit Actions
        function viewLaporan(id) {
            window.location.href = `/laporan/${id}`;
        }

        function editLaporan(id) {
            window.location.href = `/laporan/${id}/edit`;
        }

        function downloadLaporan(id) {
            window.location.href = `/laporan/${id}/download`;
        }

        function pauseLaporan(id) {
            if (confirm('Apakah Anda yakin ingin menunda audit ini?')) {
                updateLaporanStatus(id, 'ditunda');
            }
        }

        function resumeLaporan(id) {
            updateLaporanStatus(id, 'proses');
        }

        function reviewLaporan(id) {
            window.location.href = `/laporan/${id}/review`;
        }

        function cancelLaporan(id) {
            if (confirm('Apakah Anda yakin ingin membatalkan audit ini?')) {
                deleteLaporan(id);
            }
        }

        function deleteLaporan(id, judul = '') {
            if (confirm(`Apakah Anda yakin ingin menghapus laporan "${judul}"?`)) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/laporan/${id}`;
                
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = getCSRFToken();
                form.appendChild(csrfInput);
                
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);
                
                document.body.appendChild(form);
                form.submit();
            }
        }

        function updateLaporanStatus(id, status) {
            fetch(`/laporan/${id}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': getCSRFToken()
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Terjadi kesalahan saat memperbarui status');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memperbarui status');
            });
        }

        function exportData() {
            window.location.href = '/laporan/export';
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            const interactiveElements = document.querySelectorAll('button, a, input, select');
            interactiveElements.forEach(element => {
                element.style.transition = 'all 0.2s ease';
            });
        });
    </script>
</body>
</html>