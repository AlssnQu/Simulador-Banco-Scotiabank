<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::post('/validate-card', function (Request $request) {
    // Buscamos un user que coincida con DNI, Tarjeta y PIN
    $user = User::where('document_number', $request->document_number)
                ->where('card_number', $request->card_number)
                ->where('pin', $request->pin)
                ->first();

    if ($user) {
        return response()->json(['valid' => true]);
    }

    return response()->json(['valid' => false], 401);
});

Route::put('/activate-user', function (Request $request) {
    $request->validate([
        'document_number' => 'required',
        'password' => 'required|confirmed|min:6',
    ]);

    $user = User::where('document_number', $request->document_number)->firstOrFail();
    
    // Actualizamos la contraseña
    $user->update([
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('login');
})->name('user.activate');