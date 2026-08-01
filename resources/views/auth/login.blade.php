<x-guest-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900">Welcome Back</h2>
        <p class="text-gray-500 mt-2 text-sm">Please sign in to manage your portfolio</p>
    </x-slot>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-5">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                   class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition px-4 py-3 bg-white/50 backdrop-blur-sm">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Password -->
        <div class="mb-5">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition px-4 py-3 bg-white/50 backdrop-blur-sm">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mb-6">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-medium text-indigo-600 hover:text-indigo-500 transition" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:ring-4 focus:ring-indigo-200 transition shadow-lg shadow-indigo-300/50">
                Sign in
            </button>
        </div>
    </form>
</x-guest-layout>
