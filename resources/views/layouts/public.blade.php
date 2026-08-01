<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Portfolio')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-nav {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
        .hero-gradient {
            background: linear-gradient(135deg, #f6f8fd 0%, #f1f6fe 100%);
        }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-800">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 glass-nav transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center">
                    <span class="font-bold text-2xl tracking-tight text-indigo-600">{{ $settings['name'] ?? 'DevPortfolio' }}</span>
                </div>
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#about" class="text-gray-600 hover:text-indigo-600 font-medium transition">About</a>
                    <a href="#services" class="text-gray-600 hover:text-indigo-600 font-medium transition">Services</a>
                    <a href="#contact" class="text-gray-600 hover:text-indigo-600 font-medium transition">Contact</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-indigo-600 text-white px-5 py-2 rounded-full font-medium hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-900 transition font-medium">Log in</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer / Contact -->
    <footer id="contact" class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <h2 class="text-3xl font-bold mb-6">Let's work together</h2>
                    <p class="text-gray-400 mb-8 text-lg">Have a project in mind or just want to say hi? I'd love to hear from you.</p>
                    
                    <div class="space-y-4">
                        @if(isset($settings['contact_email']))
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center mr-4 text-indigo-400">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <span class="text-lg">{{ $settings['contact_email'] }}</span>
                        </div>
                        @endif
                        @if(isset($settings['phone']))
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center mr-4 text-indigo-400">
                                <i class="fas fa-phone"></i>
                            </div>
                            <span class="text-lg">{{ $settings['phone'] }}</span>
                        </div>
                        @endif
                    </div>
                </div>
                
                <div>
                    <form class="bg-gray-800 p-8 rounded-2xl shadow-lg">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-400 mb-2">Name</label>
                            <input type="text" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-400 mb-2">Email</label>
                            <input type="email" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-400 mb-2">Message</label>
                            <textarea rows="4" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"></textarea>
                        </div>
                        <button type="button" class="w-full bg-indigo-600 text-white font-bold py-4 rounded-lg hover:bg-indigo-700 transition">Send Message</button>
                    </form>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-16 pt-8 text-center text-gray-500">
                <p>&copy; {{ date('Y') }} {{ $settings['name'] ?? 'DevPortfolio' }}. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
</body>
</html>
