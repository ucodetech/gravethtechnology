@extends('layouts.public')

@section('title', ($settings['name'] ?? 'Portfolio') . ' - ' . ($settings['tagline'] ?? 'Developer'))

@section('content')
    <!-- Hero Section -->
    <section class="hero-gradient pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="z-10 text-center lg:text-left">
                    <h1 class="text-5xl lg:text-7xl font-extrabold tracking-tight text-gray-900 mb-6 leading-tight">
                        Hi, I'm <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">{{ $settings['name'] ?? 'Awesome Developer' }}</span>
                    </h1>
                    <p class="text-xl lg:text-2xl text-gray-600 mb-10 max-w-2xl mx-auto lg:mx-0">
                        {{ $settings['tagline'] ?? 'Professional Enterprise App Developer' }}
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="#contact" class="bg-indigo-600 text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-indigo-700 transition shadow-xl shadow-indigo-200 transform hover:-translate-y-1">Get in Touch</a>
                        <a href="#services" class="bg-white text-gray-800 px-8 py-4 rounded-full font-semibold text-lg border border-gray-200 hover:border-gray-300 hover:bg-gray-50 transition shadow-sm">View Services</a>
                    </div>
                </div>
                <div class="relative z-10 mx-auto w-full max-w-lg">
                    <div class="absolute inset-0 bg-gradient-to-tr from-indigo-200 to-purple-200 rounded-full blur-3xl opacity-50"></div>
                    @if(isset($settings['profile_image']))
                        <img src="{{ $settings['profile_image'] }}" alt="{{ $settings['name'] ?? 'Profile' }}" class="relative rounded-2xl shadow-2xl object-cover w-full h-[500px] border-4 border-white transform rotate-2 hover:rotate-0 transition duration-500">
                    @else
                        <div class="relative rounded-2xl shadow-2xl w-full h-[500px] border-4 border-white bg-gray-200 flex items-center justify-center transform rotate-2 hover:rotate-0 transition duration-500">
                            <span class="text-gray-400">Upload an image in Admin Dashboard</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">About Me</h2>
                <div class="w-24 h-1 bg-indigo-600 mx-auto rounded-full"></div>
            </div>
            <div class="max-w-3xl mx-auto text-lg text-gray-600 leading-relaxed text-center">
                {!! nl2br(e($settings['about'] ?? 'I am a passionate developer dedicated to building high-quality, scalable applications. I specialize in modern web technologies and robust backend systems.')) !!}
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">My Services</h2>
                <div class="w-24 h-1 bg-indigo-600 mx-auto rounded-full"></div>
                <p class="mt-4 text-gray-600">What I can do for your business</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($services as $service)
                    <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                        <div class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center mb-6 text-3xl text-indigo-600">
                            {!! $service->icon ?? '<i class="fas fa-code"></i>' !!}
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $service->title }}</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $service->description }}</p>
                    </div>
                @empty
                    <div class="col-span-3 text-center text-gray-500 py-12 bg-white rounded-2xl border border-gray-100">
                        No services added yet. Log into the dashboard to add some!
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Featured Projects</h2>
                <div class="w-24 h-1 bg-indigo-600 mx-auto rounded-full"></div>
                <p class="mt-4 text-gray-600">A selection of my recent work</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($projects as $project)
                    <div class="group relative bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                        <div class="relative h-64 overflow-hidden bg-gray-100">
                            @if($project->image)
                                <img src="{{ $project->image }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <i class="fas fa-image text-5xl"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent opacity-80"></div>
                            
                            <div class="absolute bottom-0 left-0 p-6 w-full">
                                <h3 class="text-xl font-bold text-white mb-2">{{ $project->title }}</h3>
                                @if($project->link)
                                    <a href="{{ $project->link }}" target="_blank" class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white text-indigo-600 hover:bg-indigo-600 hover:text-white transition-colors absolute bottom-6 right-6 shadow-lg">
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                        @if($project->description)
                            <div class="p-6">
                                <p class="text-gray-600 leading-relaxed">{{ $project->description }}</p>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="col-span-3 text-center text-gray-500 py-12 bg-gray-50 rounded-2xl border border-gray-100">
                        No projects showcased yet. Check back soon!
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
