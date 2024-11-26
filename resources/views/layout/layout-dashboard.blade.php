<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @yield('custom-link')
    <title>@yield('title-halaman')</title>
    <style>
        body {
        }
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body class="flex bg-gray-900 text-gray-100">
    <aside class="fixed w-64 h-screen bg-gray-800 text-gray-300 flex flex-col overflow-y-auto">
        <div class="text-center py-4">
            <h1 class="text-lg font-semibold text-teal-400">perpus.id</h1>
        </div>
        <nav class="flex-grow flex flex-col justify-center">
            <div class="space-y-7">
                <div class="mx-4">
                    <h2 class="text-sm uppercase tracking-wider px-6 mb-2 font-medium text-teal-400">Main Menu</h2>
                    <ul class="space-y-2 px-4">
                        <li><a href="{{ route('dashboard') }}" class="flex items-center p-2 hover:bg-gray-700 rounded-md transition duration-300 ease-in-out">
                            <i class="fa-solid fa-gauge w-6 mr-3 text-teal-400"></i>
                            <span class="font-semibold text-gray-100">Dashboard</span>
                        </a>
                    </li>
                    </ul>
                </div>
                @if(auth()->guard('user')->user()->role == 'admin' || auth()->guard('user')->user()->role == 'waiter' || auth()->guard('user')->user()->role == 'kasir')
                <div class="mx-4">
                    <h2 class="text-sm uppercase tracking-wider px-6 mb-2 font-medium text-teal-400">Data Entri</h2>
                    <ul class="space-y-2 px-4">
                        @if(auth()->guard('user')->user()->role == 'admin')
                        <li><a href="{{ route('meja') }}" class="flex items-center p-2 hover:bg-gray-700 rounded-md transition duration-300 ease-in-out">
                                <i class="fa-solid fa-table w-6 mr-3 text-teal-400"></i>
                                <span class="font-semibold text-gray-100">Entri Meja</span>
                            </a></li>
                        @endif
                        @if(auth()->guard('user')->user()->role == 'admin' || auth()->guard('user')->user()->role == 'waiter')
                        <li><a href="{{ route('barang') }}" class="flex items-center p-2 hover:bg-gray-700 rounded-md transition duration-300 ease-in-out">
                                <i class="fa-solid fa-box w-6 mr-3 text-teal-400"></i>
                                <span class="font-semibold text-gray-100">Entri Barang</span>
                            </a></li>
                        @endif
                        {{-- @if(auth()->guard('user')->user()->role == 'waiter' || auth()->guard('user')->user()->role == 'owner') --}}
                        @if(auth()->guard('user')->user()->role == 'waiter')
                            <li><a href="{{ route('order') }}" class="flex items-center p-2 hover:bg-gray-700 rounded-md transition duration-300 ease-in-out">
                                    <i class="fa-solid fa-clipboard-list w-6 mr-3 text-teal-400"></i>
                                    <span class="font-semibold text-gray-100">Entri Order</span>
                                </a></li>
                        @endif
                        @if(auth()->guard('user')->user()->role == 'kasir')
                        <li><a href="{{ route('transaksi') }}" class="flex items-center p-2 hover:bg-gray-700 rounded-md transition duration-300 ease-in-out">
                                <i class="fa-solid fa-money-bill-wave w-6 mr-3 text-teal-400"></i>
                                <span class="font-semibold text-gray-100">Entri Transaksi</span>
                            </a></li>
                        @endif
                    </ul>
                </div>
                @endif
                @if(auth()->guard('user')->user()->role == 'owner' || auth()->guard('user')->user()->role == 'waiter' || auth()->guard('user')->user()->role == 'kasir')
                <div class="mx-4">
                    <h2 class="text-sm uppercase tracking-wider px-6 mb-2 font-medium text-teal-400">Generate</h2>
                    <ul class="space-y-2 px-4">
                        <li><a href="{{ route('laporan') }}" class="flex items-center p-2 hover:bg-gray-700 rounded-md transition duration-300 ease-in-out">
                                <i class="fa-solid fa-file-lines w-6 mr-3 text-teal-400"></i>
                                <span class="font-semibold text-gray-100">Laporan</span>
                            </a></li>
                    </ul>
                </div>
                @endif
            </div>
        </nav>
        <div class="py-4 px-4">
            <div class="relative">
                <div id="userDropdown"
                    class="absolute bottom-full right-0 mb-2 w-56 bg-gray-700 rounded-md shadow-lg opacity-0 transform scale-95 transition-all duration-200 ease-out pointer-events-none">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-gray-600">
                            Logout
                        </button>
                    </form>
                </div>
                <div class="flex items-center bg-gray-700 rounded-lg p-2 shadow-md cursor-pointer"
                    onclick="toggleDropdown()">
                    <img src="https://picsum.photos/50" alt="Profile" class="w-10 h-10 rounded-lg">
                    <div class="ml-3 flex-grow">
                        <p class="text-sm font-semibold text-gray-100">{{ auth()->guard('user')->user()->name }}</p>
                        <p class="text-xs text-gray-400">{{ auth()->guard('user')->user()->role }}</p>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 bg-gray-900 ml-64">
        <div class="py-20 px-28">
            <div class="mb-20">
                @yield('title')
                @yield('description')
            </div>
            <div class="mb-20">
                @yield('edit-tambah')
                @yield('content')
            </div>
        </div>
    </main>

    @yield('custom-js')
    @yield('scripts')
    <script>
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            const icon = document.getElementById('dropdownIcon');
            dropdown.classList.toggle('opacity-0');
            dropdown.classList.toggle('scale-95');
            dropdown.classList.toggle('pointer-events-none');
            icon.classList.toggle('rotate-180');
        }
    
        window.onclick = function(event) {
            if (!event.target.matches('.cursor-pointer') && !event.target.closest('.cursor-pointer')) {
                const dropdown = document.getElementById('userDropdown');
                const icon = document.getElementById('dropdownIcon');
                if (!dropdown.classList.contains('opacity-0')) {
                    dropdown.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                    icon.classList.remove('rotate-180');
                }
            }
        }
    </script>    
</body>

</html>