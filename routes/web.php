<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilEmployerController;
use App\Http\Controllers\ProfilJobseekerController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});





 Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'role:Admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    // Ajouter d'autres routes spécifiques à l'admin ici
});

Route::middleware(['auth', 'role:Employer'])->group(function () {
    Route::get('/employer', [ProfilEmployerController::class, 'index'])->name('employer.dashboard');
    // Ajouter d'autres routes spécifiques à l'employeur ici
});

Route::middleware(['auth', 'role:Job Seeker'])->group(function () {
    Route::get('/job-seeker', [ProfilJobseekerController::class, 'index'])->name('jobseeker.dashboard');
    // Ajouter d'autres routes spécifiques aux chercheurs d'emploi ici
});
require __DIR__.'/auth.php'; 
















/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes protégées nécessitant l'authentification
Route::middleware(['auth'])->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

// Routes pour les utilisateurs Admin
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    // Ajouter d'autres routes spécifiques à l'admin ici
});

// Routes pour les employeurs
Route::middleware(['auth', 'role:Employer'])->group(function () {
    Route::get('/employer', [ProfilEmployerController::class, 'index'])->name('employer.dashboard');
    // Ajouter d'autres routes spécifiques à l'employeur ici
});

// Routes pour les chercheurs d'emploi
Route::middleware(['auth', 'role:Job Seeker'])->group(function () {
    Route::get('/job-seeker', [ProfilJobseekerController::class, 'index'])->name('jobseeker.dashboard');
    // Ajouter d'autres routes spécifiques aux chercheurs d'emploi ici
}); */
