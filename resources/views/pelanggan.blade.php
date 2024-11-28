@extends('layout/layout-dashboard')

@section('custom-link')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('title-halaman')
    Dashboard Pelanggan
@endsection

@section('title')
    <h1 class="text-xl font-semibold" style="font-family: 'Helvetica', 'Arial', sans-serif;">Data Pelanggan</h1>
@endsection

@section('description')
    <p class="text-gray-600" style="font-family: 'Helvetica', 'Arial', sans-serif;">Semua data pelanggan muncul di bidang ini</p>
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
            <form action="{{ route('pelanggan.update', $edit->id_pelanggan) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-300 text-sm font-semibold mb-2" for="id_pelanggan">
                            ID Pelanggan
                        </label>
                        <input
                            class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                            id="id_pelanggan" name="id_pelanggan" type="text" value="{{ $edit->id_pelanggan }}" readonly>
                    </div>
                    <div>
                        <label class="block text-gray-300 text-sm font-semibold mb-2" for="nama_Pelanggan">
                            Nama Pelanggan
                        </label>
                        <input
                            class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                            id="nama_Pelanggan" name="nama_Pelanggan" type="text" value="{{ $edit->nama_Pelanggan }}" required>
                    </div>
                    <div>
                        <label class="block text-gray-300 text-sm font-semibold mb-2" for="jenis_Kelamin">
                            Jenis Kelamin
                        </label>
                        <select
                            class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                            id="jenis_Kelamin" name="jenis_Kelamin" required>
                            <option value="laki-laki" {{ isset($edit) && $edit->jenis_Kelamin == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="perempuan" {{ isset($edit) && $edit->jenis_Kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-300 text-sm font-semibold mb-2" for="no_hp">
                            No. HP
                        </label>
                        <input
                            class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                            id="no_hp" name="no_hp" type="text" value="{{ $edit->no_hp }}" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-gray-300 text-sm font-semibold mb-2" for="alamat">
                            Alamat
                        </label>
                        <textarea
                            class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                            id="alamat" name="alamat" rows="3" required>{{ $edit->alamat }}</textarea>
                    </div>
                </div>
                <div class="flex items-center gap-4 mt-8">
                    <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded-md">
                        Update Pelanggan
                    </button>
                    <button type="reset" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-md">
                        Reset
                    </button>
                </div>
            </form>
        @else
            <form action="{{ route('pelanggan.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-300 text-sm font-semibold mb-2" for="id_pelanggan">
                            ID Pelanggan
                        </label>
                        <input
                            class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                            id="id_pelanggan" name="id_pelanggan" type="text" value="{{ $id_pelanggan }}" readonly>
                    </div>
                    <div>
                        <label class="block text-gray-300 text-sm font-semibold mb-2" for="nama_Pelanggan">
                            Nama Pelanggan
                        </label>
                        <input
                            class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                            id="nama_Pelanggan" name="nama_Pelanggan" type="text" value="{{ old('nama_Pelanggan') }}" required>
                    </div>
                    <div>
                        <label class="block text-gray-300 text-sm font-semibold mb-2" for="jenis_Kelamin">
                            Jenis Kelamin
                        </label>
                        <select
                            class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                            id="jenis_Kelamin" name="jenis_Kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="laki-laki" {{ old('jenis_Kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="perempuan" {{ old('jenis_Kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-300 text-sm font-semibold mb-2" for="no_hp">
                            No. HP
                        </label>
                        <input
                            class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                            id="no_hp" name="no_hp" type="text" value="{{ old('no_hp') }}" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-gray-300 text-sm font-semibold mb-2" for="alamat">
                            Alamat
                        </label>
                        <textarea
                            class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                            id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                    </div>
                </div>
                <div class="flex items-center gap-4 mt-8">
                    <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded-md">
                        Tambah Pelanggan
                    </button>
                    <button type="reset" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-md">
                        Reset
                    </button>
                </div>
            </form>
        @endif

        <table class="w-full bg-gray-800 rounded-lg overflow-hidden mt-8">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">ID Pelanggan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Jenis Kelamin</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">No. HP</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Alamat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse ($pelanggans as $pelanggan)
                    <tr class="hover:bg-gray-700">
                        <td class="px-6 py-4 text-sm text-gray-300">{{ $pelanggan->id_pelanggan }}</td>
                        <td class="px-6 py-4 text-sm text-gray-300">{{ $pelanggan->nama_Pelanggan }}</td>
                        <td class="px-6 py-4 text-sm text-gray-300">{{ ucfirst($pelanggan->jenis_Kelamin) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-300">{{ $pelanggan->no_hp }}</td>
                        <td class="px-6 py-4 text-sm text-gray-300">{{ $pelanggan->alamat }}</td>
                        <td class="px-6 py-4 text-sm text-gray-300">
                            <a href="{{ route('pelanggan.edit', $pelanggan->id_pelanggan) }}" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button onclick="openDeleteModal('{{ $pelanggan->id_pelanggan }}', '{{ $pelanggan->nama_Pelanggan }}')" class="text-red-500 hover:text-red-700 ml-3">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-sm text-gray-300 text-center">Tidak ada data pelanggan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Delete Modal -->
        <div id="deleteModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0 sm:pt-0">
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
                                        Apakah Anda yakin ingin menghapus data pelanggan <span id="pelangganName" class="font-bold text-teal-400"></span>?
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
    function openDeleteModal(id, nama) {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('pelangganName').textContent = nama;
        document.getElementById('deleteForm').action = "/dashboard/pelanggan/" + id;
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
@endsection