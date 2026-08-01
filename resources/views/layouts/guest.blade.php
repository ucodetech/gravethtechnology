<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Portfolio') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-900">

    <div class="min-h-screen flex">
        
        <!-- Left Side: Branding / Visual (Hidden on mobile) -->
        <div class="hidden lg:flex lg:w-1/2 bg-indigo-900 relative items-center justify-center overflow-hidden">
            <!-- Background design elements -->
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-800 to-purple-900 opacity-90"></div>
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
            <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
            
            <div class="relative z-10 text-center px-12">
                <h1 class="text-5xl font-extrabold text-white tracking-tight mb-6">
                    Graveth<span class="text-indigo-400">Tech</span>
                </h1>
                <p class="text-indigo-200 text-lg leading-relaxed max-w-md mx-auto">
                    Secure admin portal. Manage your portfolio, update services, and connect with your clients seamlessly.
                </p>
            </div>
        </div>

        <!-- Right Side: Content Slot -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 lg:p-24 bg-white shadow-[0_0_40px_rgba(0,0,0,0.1)] z-20">
            <div class="w-full max-w-md">
                
                @if (isset($header))
                    <div class="mb-10 lg:mb-12">
                        {{ $header }}
                    </div>
                @endif

                {{ $slot }}
                
                <div class="mt-10 pt-6 border-t border-gray-100 text-center">
                    <a href="/" class="text-sm text-gray-500 hover:text-indigo-600 transition flex items-center justify-center gap-2 font-medium">
                        <i class="fas fa-arrow-left"></i> Back to Public Portfolio
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
