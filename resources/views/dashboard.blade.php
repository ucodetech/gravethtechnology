<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 tracking-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <!-- Welcome Section -->
    <div class="mb-8 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl p-8 text-white shadow-lg relative overflow-hidden">
        <div class="relative z-10">
            <h3 class="text-3xl font-extrabold mb-2">Welcome back, {{ Auth::user()->name }}!</h3>
            <p class="text-indigo-100 text-lg max-w-xl">Here is what's happening with your portfolio today. Manage your projects, update your services, or tweak your settings.</p>
        </div>
        <!-- Decorative shapes -->
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-48 h-48 bg-white opacity-10 rounded-full blur-2xl"></div>
        <div class="absolute bottom-0 right-20 -mb-10 w-32 h-32 bg-white opacity-10 rounded-full blur-xl"></div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Projects Stat -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-14 h-14 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 shrink-0">
                <i class="fas fa-briefcase text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Projects</p>
                <h4 class="text-3xl font-bold text-gray-900">{{ $stats['projects'] ?? 0 }}</h4>
            </div>
        </div>
        
        <!-- Active Projects Stat -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-14 h-14 rounded-full bg-green-50 flex items-center justify-center text-green-600 shrink-0">
                <i class="fas fa-check-circle text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Active Projects</p>
                <h4 class="text-3xl font-bold text-gray-900">{{ $stats['active_projects'] ?? 0 }}</h4>
            </div>
        </div>

        <!-- Services Stat -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-14 h-14 rounded-full bg-purple-50 flex items-center justify-center text-purple-600 shrink-0">
                <i class="fas fa-concierge-bell text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Services</p>
                <h4 class="text-3xl font-bold text-gray-900">{{ $stats['services'] ?? 0 }}</h4>
            </div>
        </div>
        
        <!-- Quick Link Stat -->
        <a href="{{ route('home') }}" target="_blank" class="bg-gradient-to-br from-gray-900 to-slate-800 rounded-2xl p-6 shadow-sm border border-gray-800 flex items-center justify-between hover:shadow-xl transition-all group overflow-hidden relative">
            <div class="relative z-10">
                <p class="text-gray-400 text-sm font-medium mb-1">Live Site</p>
                <h4 class="text-xl font-bold text-white group-hover:text-indigo-400 transition-colors">View Portfolio</h4>
            </div>
            <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center text-white shrink-0 group-hover:scale-110 transition-transform relative z-10">
                <i class="fas fa-external-link-alt"></i>
            </div>
            <!-- Decorative line -->
            <div class="absolute right-0 bottom-0 w-32 h-32 bg-indigo-500/20 rounded-full blur-2xl transform translate-x-10 translate-y-10 group-hover:bg-indigo-500/30 transition-colors"></div>
        </a>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Manage Projects Card -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-900">Manage Projects</h3>
                <a href="{{ route('admin.projects.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">View All &rarr;</a>
            </div>
            <p class="text-gray-500 mb-6">Add new portfolio items or update existing project details and screenshots to keep your public portfolio fresh.</p>
            <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 bg-indigo-50 text-indigo-700 font-semibold rounded-xl hover:bg-indigo-100 transition-colors">
                <i class="fas fa-plus mr-2"></i> Add New Project
            </a>
        </div>

        <!-- System Settings Card -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-900">System Settings</h3>
                <a href="{{ route('admin.settings.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Edit Settings &rarr;</a>
            </div>
            <p class="text-gray-500 mb-6">Update your developer profile, contact details, tagline, and the personal 'About Me' description shown on your site.</p>
            <a href="{{ route('admin.settings.index') }}" class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 bg-gray-50 text-gray-700 font-semibold rounded-xl hover:bg-gray-100 transition-colors border border-gray-200">
                <i class="fas fa-cog mr-2"></i> Open Settings
            </a>
        </div>
    </div>
</x-app-layout>
