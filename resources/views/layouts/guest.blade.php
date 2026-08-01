<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Portfolio') }} - Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Inter', sans-serif; }
            .login-bg {
                background: linear-gradient(135deg, #f6f8fd 0%, #f1f6fe 100%);
            }
            .glass-card {
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.5);
            }
        </style>
    </head>
    <body class="antialiased login-bg min-h-screen flex items-center justify-center p-4">

        <div class="max-w-md w-full relative">
            <!-- Decorative blobs -->
            <div class="absolute -top-12 -left-12 w-32 h-32 bg-indigo-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob"></div>
            <div class="absolute -bottom-12 -right-12 w-32 h-32 bg-purple-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob animation-delay-2000"></div>

            <div class="glass-card rounded-2xl shadow-2xl p-8 relative z-10">
                <div class="text-center mb-8">
                    <a href="/" class="inline-block mb-4">
                        <span class="font-bold text-3xl tracking-tight text-indigo-600">AdminPanel</span>
                    </a>
                    {{ $header ?? '' }}
                </div>

                {{ $slot }}
                
                <div class="mt-8 text-center">
                    <a href="/" class="text-sm text-gray-500 hover:text-gray-800 transition flex items-center justify-center gap-2">
                        <i class="fas fa-arrow-left"></i> Back to Portfolio
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
