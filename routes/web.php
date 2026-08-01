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
    Route::resource('projects', App\Http\Controllers\Admin\ProjectController::class)->except(['create', 'show']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/run-migrations', function (Illuminate\Http\Request $request) {
    if ($request->query('key') !== 'migrate-123') {
        abort(403, 'Unauthorized action.');
    }

    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        $output = \Illuminate\Support\Facades\Artisan::output();
        
        if ($request->query('seed') === 'true') {
            \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
            $output .= "\n" . \Illuminate\Support\Facades\Artisan::output();
        }
        
        return response("<pre>Database updated successfully!\n\n" . $output . "</pre>");
    } catch (\Exception $e) {
        return response("<pre>Error: " . $e->getMessage() . "</pre>");
    }
});

require __DIR__.'/auth.php';
