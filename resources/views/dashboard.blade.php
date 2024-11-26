@extends('layout/layout-dashboard')

@section('custom-link')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('title-halaman')
    Dashboard
@endsection

@section('title')
    <h1 class="text-2xl font-semibold text-teal-400" style="font-family: 'Helvetica', 'Arial', sans-serif;">Dashboard</h1>
@endsection

@section('description')
    <p class="text-gray-400 mt-2" style="font-family: 'Helvetica', 'Arial', sans-serif;">Y</p>
@endsection

@section('content')
    @if(session('error'))
<div id="error-notification" class="fixed top-4 right-4 flex items-center p-4 bg-gray-800 border-l-4 border-red-500 rounded-lg shadow-lg transform transition-all duration-500 ease-in-out opacity-0 translate-x-full">
    <div class="flex items-center">
        <div class="flex-shrink-0">
            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <div class="ml-3">
            <p class="text-sm font-medium text-gray-200">
                {{ session('error') }}
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

@if(session('success'))
<div id="error-notification" class="fixed top-4 right-4 flex items-center p-4 bg-gray-800 border-l-4 border-green-500 rounded-lg shadow-lg transform transition-all duration-500 ease-in-out opacity-0 translate-x-full">
    <div class="flex items-center">
        <div class="flex-shrink-0">
            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const notification = document.getElementById('error-notification');
        if (notification) {
            // Show notification with animation
            setTimeout(() => {
                notification.classList.remove('opacity-0', 'translate-x-full');
            }, 100);

            // Auto hide after 5 seconds
            setTimeout(() => {
                closeNotification();
            }, 5000);
        }
    });

    function closeNotification() {
        const notification = document.getElementById('error-notification');
        notification.classList.add('opacity-0', 'translate-x-full');
        setTimeout(() => {
            notification.remove();
        }, 500);
    }
</script>

@endsection