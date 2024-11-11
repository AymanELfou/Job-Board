<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilEmployerController;
use App\Http\Controllers\ProfilJobseekerController;
use App\Models\ProfilJobseeker;
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




Route::middleware(['auth'])->group(function () {

    //**************************** /* Job Management ************************************

    // Affiche la liste des offres d'emploi
    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');

    // Formulaire de création d'une nouvelle offre d'emploi
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');

    // Enregistrer une nouvelle offre d'emploi
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');

    // Afficher le formulaire d'édition pour une offre spécifique
    Route::get('/jobs/{id}/edit', [JobController::class, 'edit'])->name('jobs.edit');

    // Mettre à jour une offre d'emploi spécifique
    Route::put('/jobs/{id}', [JobController::class, 'update'])->name('jobs.update');

    // Supprimer une offre d'emploi
    Route::delete('/jobs/{id}', [JobController::class, 'destroy'])->name('jobs.destroy');

    // Filtrer les offres d'emploi par critères
    Route::get('/jobs/search', [JobController::class, 'search'])->name('jobs.search');


    
    
    //****************************  JobSeeker Management ************************************

    // Route to display the list of job seekers
    Route::get('/jobseekers', [ProfilJobseekerController::class, 'index'])->name('jobseeker.index');

    // Route to show the form for creating a new job seeker profile
    Route::get('/jobseekers/create', [ProfilJobseekerController::class, 'create'])->name('jobseeker.create');

    // Route to save a new job seeker profile
    Route::post('/jobseekers', [ProfilJobseekerController::class, 'store'])->name('jobseeker.store');

    // Route to show the edit form for a specific job seeker profile
    Route::get('/jobseekers/{id}/edit', [ProfilJobseekerController::class, 'edit'])->name('jobseeker.edit');

    // Route to update a specific job seeker profile
    Route::put('/jobseekers/{id}', [ProfilJobseekerController::class, 'update'])->name('jobseeker.update');

    // Route to delete a specific job seeker profile
    Route::delete('/jobseekers/{id}', [ProfilJobseekerController::class, 'destroy'])->name('jobseeker.destroy');

    // Route to filter job seekers by criteria
    Route::get('/jobseekers/search', [ProfilJobseekerController::class, 'search'])->name('jobseeker.search');


    




    //****************************  JobSeeker Management ************************************

    // Route to display the list of employers
    Route::get('/employers', [ProfilEmployerController::class, 'index'])->name('employers.index');
















    
});





























/* Route::middleware(['auth', 'role:Admin'])->group(function () {
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
}); */
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
