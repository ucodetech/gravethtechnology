<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    
    Route::resource('services', ServiceController::class)->except(['create', 'show']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/server-deploy', function (Illuminate\Http\Request $request) {
    if ($request->query('key') !== 'run-deploy-123') {
        abort(403, 'Unauthorized action.');
    }

    $output = [];
    
    try {
        // Artisan Commands
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        $output[] = 'Migrate: ' . \Illuminate\Support\Facades\Artisan::output();
        
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        $output[] = 'Optimize Clear: ' . \Illuminate\Support\Facades\Artisan::output();
        
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        $output[] = 'Storage Link: ' . \Illuminate\Support\Facades\Artisan::output();

        // Shell Commands (Composer & NPM if available)
        if (function_exists('shell_exec')) {
            $output[] = 'NPM Install: ' . shell_exec('npm install 2>&1');
            $output[] = 'NPM Build: ' . shell_exec('npm run build 2>&1');
        } else {
            $output[] = 'shell_exec is disabled on this server. NPM commands skipped.';
        }
        
    } catch (\Exception $e) {
        $output[] = 'Error: ' . $e->getMessage();
    }

    return response()->json([
        'status' => 'Deployment script executed.',
        'output' => $output
    ]);
});

require __DIR__.'/auth.php';
