<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Login</title>
    <link rel="icon" href="https://api.iconify.design/noto:blue-book.svg" type="image/svg+xml">
    <style>
        * {
            font-family: 'Inter', sans-serif; 
        }
        body {
            background-color: #121212;
            color: #e0e0e0;
            overflow-x: hidden;
        }
        .blob-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: -1;
            overflow: hidden;
        }
        .blob {
            position: absolute;
            background-color: #1e293b;
            border-radius: 50%;
            filter: blur(40px);
            opacity: 0.7;
        }
        .content-wrapper {
            position: relative;
            z-index: 1;
        }
    </style>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
</head>
<body class="flex items-center justify-center min-h-screen p-4">
    <div class="blob-container" id="blobContainer"></div>

    @if (session('error'))
    <div id="error-notification" class="fixed top-4 right-4 flex items-center p-4 bg-gray-800 border-l-4 border-red-500 rounded-lg shadow-lg transform transition-all duration-500 ease-in-out opacity-0 translate-x-full">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-200">
                    <span class="font-bold mr-1">Oops!</span>{{ $errors->first('username') }}
                    
                </p>
            </div>
            <div class="ml-4 flex-shrink-0 flex">
                <button onclick="closeNotification()" class="inline-flex text-gray-400 hover:text-gray-300 focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    @endif

    @if (session('success'))
    <div id="success-notification" class="fixed top-4 right-4 flex items-center p-4 bg-gray-800 border-l-4 border-green-500 rounded-lg shadow-lg transform transition-all duration-500 ease-in-out opacity-0 translate-x-full">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-200">
                    {{ session('success') }}
                </p>
            </div>
            <div class="ml-4 flex-shrink-0 flex">
                <button onclick="closeNotification()" class="inline-flex text-gray-400 hover:text-gray-300 focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const errorNotification = document.getElementById('error-notification');
            const successNotification = document.getElementById('success-notification');
            
            function showNotification(element) {
                if (element) {
                    setTimeout(() => {
                        element.classList.remove('opacity-0', 'translate-x-full');
                    }, 100);

                    setTimeout(() => {
                        closeNotification(element);
                    }, 5000);
                }
            }

            showNotification(errorNotification);
            showNotification(successNotification);
        });

        function closeNotification(element) {
            if (!element) {
                element = event.target.closest('[id$="-notification"]');
            }
            if (element) {
                element.classList.add('opacity-0', 'translate-x-full');
                setTimeout(() => {
                    element.remove();
                }, 500);
            }
        }
    </script>
    @endif

    <div class="content-wrapper flex justify-center items-center min-h-screen">
        <div class="bg-gray-800 bg-opacity-80 backdrop-blur-lg py-8 px-5 rounded-lg shadow-xl relative z-10">
            <h2 class="text-2xl font-bold mb-1 text-center text-teal-400" style="font-family: 'Poppins', sans-serif;">Selamat Datang</h2>
            <p class="text-gray-400 text-xs mb-8 text-center" style="font-family: 'Poppins', sans-serif;">Masukkan details anda untuk login</p>
            <form method="POST" action="">
                @csrf
                <div class="mb-4">
                    <label for="username" class="block text-teal-400 text-xs font-medium mb-1">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username..." value="" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-xs text-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-teal-400 transition-colors focus:border-teal-400 duration-300 focus:placeholder-teal-400 ease-in-out">
                </div>
                <div class="mb-8">
                    <label for="password" class="block text-teal-400 text-xs font-medium mb-1">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-xs text-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-teal-400 transition-colors focus:border-teal-400 duration-300 focus:placeholder-teal-400 ease-in-out">
                </div>
                <div class="flex items-center mb-6">
                    <input type="checkbox" id="remember" name="remember" class="w-4 h-4 bg-gray-700 border-gray-600 rounded focus:ring-teal-500 focus:ring-2 focus:ring-offset-gray-800">
                    <label for="remember" class="ml-2 text-xs font-medium text-gray-400">Remember me</label>
                </div>
                <button type="submit" class="w-full bg-teal-600 text-white py-2 rounded-lg hover:bg-teal-700 text-sm font-medium transition-colors duration-300 ease-in-out">Login</button>
            </form>
            <p class="text-gray-400 text-xs text-center mt-8" style="font-family: 'Poppins', sans-serif;">Belum punya akun? <a href="" class="text-teal-400 hover:text-teal-500">Daftar</a></p>
        </div>
    </div>

    <script>
        function createBlob() {
            const blob = document.createElement('div');
            blob.classList.add('blob');
            
            const size = Math.random() * 150 + 50;
            blob.style.width = `${size}px`;
            blob.style.height = `${size}px`;
            
            const startX = Math.random() * window.innerWidth;
            const startY = Math.random() * window.innerHeight;
            blob.style.left = `${startX}px`;
            blob.style.top = `${startY}px`;
            
            return blob;
        }

        function moveBlob(blob) {
            const newX = Math.random() * window.innerWidth;
            const newY = Math.random() * window.innerHeight;
            const duration = Math.random() * 10 + 5;

            blob.style.transition = `all ${duration}s ease-in-out`;
            blob.style.left = `${newX}px`;
            blob.style.top = `${newY}px`;

            setTimeout(() => moveBlob(blob), duration * 1000);
        }

        const blobContainer = document.getElementById('blobContainer');
        const blobCount = 5;

        for (let i = 0; i < blobCount; i++) {
            const blob = createBlob();
            blobContainer.appendChild(blob);
            moveBlob(blob);
        }
    </script>
</body>
</html>