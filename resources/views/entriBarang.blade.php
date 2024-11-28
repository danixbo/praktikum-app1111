@extends('layout/layout-dashboard')

@section('custom-link')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('title-halaman')
    Dashboard Entri Barang
@endsection

@section('title')
    <h1 class="text-xl font-semibold" style="font-family: 'Helvetica', 'Arial', sans-serif;">Entri Barang</h1>
@endsection

@section('description')
    <p class="text-gray-600" style="font-family: 'Helvetica', 'Arial', sans-serif;">Semua jumlah Entri Barang muncul di bidang
        ini</p>
@endsection

@section('edit-tambah')
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-md mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(isset($edit))
            <form action="{{ route('barang.update', ['id_menu' => $edit->id_menu]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-300 text-sm font-semibold mb-2" for="id_menu">
                            ID Menu
                        </label>
                        <input
                            class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                            id="id_menu" name="id_menu" type="text" 
                            value="{{ $edit->id_menu }}" readonly>
                    </div>
                    <div>
                        <label class="block text-gray-300 text-sm font-semibold mb-2" for="nama_menu">
                            Nama Menu
                        </label>
                        <input
                            class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                            id="nama_menu" name="nama_menu" type="text" 
                            value="{{ $edit->nama_menu }}" required>
                    </div>
                    <div>
                        <label class="block text-gray-300 text-sm font-semibold mb-2" for="harga">
                            Harga
                        </label>
                        <input
                            class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                            id="harga" name="harga" type="number" 
                            value="{{ $edit->harga }}" required>
                    </div>
                </div>
                <div class="flex items-center gap-4 mt-8">
                    <button
                        class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out"
                        type="submit">
                        {{ isset($edit) ? 'Update Barang' : 'Tambah Barang' }}
                    </button>
                    <button
                        class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out"
                        type="reset">
                        Mulai Ulang
                    </button>
                </div>
            </form>
        @else
            <form action="{{ route('barang.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-300 text-sm font-semibold mb-2" for="id_menu">
                            ID Menu
                        </label>
                        <input
                            class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                            id="id_menu" name="id_menu" type="text" 
                            value="{{ $edit->id_menu ?? $id_menu }}" readonly>
                    </div>
                    <div>
                        <label class="block text-gray-300 text-sm font-semibold mb-2" for="nama_menu">
                            Nama Menu
                        </label>
                        <input
                            class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                            id="nama_menu" name="nama_menu" type="text" 
                            value="{{ $edit->nama_menu ?? '' }}" required>
                    </div>
                    <div>
                        <label class="block text-gray-300 text-sm font-semibold mb-2" for="harga">
                            Harga
                        </label>
                        <input
                            class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                            id="harga" name="harga" type="number" 
                            value="{{ $edit->harga ?? '' }}" required>
                    </div>
                </div>
                <div class="flex items-center gap-4 mt-8">
                    <button
                        class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out"
                        type="submit">
                        {{ isset($edit) ? 'Update Barang' : 'Tambah Barang' }}
                    </button>
                    <button
                        class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out"
                        type="reset">
                        Mulai Ulang
                    </button>
                </div>
            </form>
        @endif
    </div>
@endsection

@section('content')
    <div class="rounded-lg mt-6">
        <div class="flex justify-between items-center mb-6">
            <div class="relative">
                <input type="text" id="searchInput" placeholder="Search..."
                    class="bg-gray-700 text-gray-100 rounded-md pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-300 ease-in-out">
                <button onclick="performSearch()"
                    class="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-teal-500 transition-colors duration-300 ease-in-out">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
        {{-- @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif --}}

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-md mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <table class="w-full bg-gray-800 rounded-lg overflow-hidden">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">ID Menu</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Nama Menu</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Harga</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse ($barangs as $barang)
                    <tr class="hover:bg-gray-700 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $barang->id_menu }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $barang->nama_menu }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $barang->harga }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            <a href="{{ route('barang.edit', $barang->id_menu) }}">
                                <button class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-md mr-2">
                                    <i class="fa-solid fa-pencil"></i>
                                </button>
                            </a>
                            <button onclick="openDeleteModal('{{ $barang->id_menu }}', '{{ $barang->nama_menu }}')" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded-md mr-2">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-300 text-center">Tidak ada data menu</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div id="deleteModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-900 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-200" id="modal-title">
                                    Konfirmasi Penghapusan
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-400">
                                        Apakah Anda yakin ingin menghapus data barang <span id="barangID" class="font-bold text-teal-400"></span> Dengan Nama <span id="barangName" class="font-bold text-teal-400"></span>?
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <form id="deleteForm" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Hapus
                            </button>
                        </form>
                        <button type="button" onclick="closeDeleteModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-500 shadow-sm px-4 py-2 bg-gray-600 text-base font-medium text-gray-300 hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    
    function openDeleteModal(id_menu, nama) {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('barangName').textContent = nama;
        document.getElementById('barangID').textContent = id_menu;
        document.getElementById('deleteForm').action = "/dashboard/barang/" + id_menu;
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
@endsection