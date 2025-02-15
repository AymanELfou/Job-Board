<?php

use App\Http\Controllers\Admin\AdminApplicationController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminProfilEmployerController;
use App\Http\Controllers\Admin\AdminProfilJobseekerController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Employer\EmployerApplicationController;
use App\Http\Controllers\Employer\EmployerCondidateController;
use App\Http\Controllers\Employer\EmployerJobController;
use App\Http\Controllers\Employer\ProfilEmployerController;
use App\Http\Controllers\Jobseeker\JobseekerApplicationController;
use App\Http\Controllers\Jobseeker\JobseekerJobController;
use App\Http\Controllers\Jobseeker\ProfileJobseekerController;
use App\Http\Controllers\Jobseeker\SavedJobsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestEmailController;
use App\Models\ProfileAdmin;
use App\Models\ProfilJobseeker;
use Illuminate\Support\Facades\Mail;
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
})->name('home');

Route::get('/tt',function () {
    return "hello";
})->middleware(['auth','role:Job Seeker']);


// Public routes (no middleware)
/* Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
 */
// Logout route
/* Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
 */


// Admin Routes
Route::middleware(['auth','role:admin'])->group(function () {
    // Dashboard for Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');

    Route::prefix('profileAdmin')->group( function (){
        Route::get('/create', [AdminProfileController::class, 'create'])->name('admin.profile.create');
        Route::post('/', [AdminProfileController::class, 'store'])->name('admin.profile.store');
    });
        
    

    // Job Management for Admin
    Route::prefix('jobs')->group(function () {
        Route::get('/', [AdminJobController::class, 'index'])->name('jobs.index');
       /*  Route::get('/create', [AdminJobController::class, 'create'])->name('jobs.create');
        Route::post('/', [AdminJobController::class, 'store'])->name('jobs.store');
        Route::get('/{id}/edit', [AdminJobController::class, 'edit'])->name('jobs.edit');
        Route::put('/{id}', [AdminJobController::class, 'update'])->name('jobs.update'); */
        Route::delete('/{id}', [AdminJobController::class, 'destroy'])->name('jobs.destroy');
        Route::get('/search', [AdminJobController::class, 'search'])->name('jobs.search');
    });


    // Job Seeker Management
    Route::prefix('jobseekers')->group(function () {
        Route::get('/', [AdminProfilJobseekerController::class, 'index'])->name('jobseeker.index');
       /*  Route::get('/create', [AdminProfilJobseekerController::class, 'create'])->name('jobseeker.create');
        Route::post('/', [AdminProfilJobseekerController::class, 'store'])->name('jobseeker.store');
        Route::get('/{id}/edit', [AdminProfilJobseekerController::class, 'edit'])->name('jobseeker.edit');
        Route::put('/{id}', [AdminProfilJobseekerController::class, 'update'])->name('jobseeker.update'); */
        Route::delete('/{id}', [AdminProfilJobseekerController::class, 'destroy'])->name('jobseeker.destroy');
        Route::get('/search', [AdminProfilJobseekerController::class, 'search'])->name('jobseeker.search');
    });


    // Employer Management
    Route::prefix('employers')->group(function () {
        Route::get('/', [AdminProfilEmployerController::class, 'index'])->name('employers.index');
        Route::get('/create', [AdminProfilEmployerController::class, 'create'])->name('employers.create');
        Route::post('/', [AdminProfilEmployerController::class, 'store'])->name('employers.store');
        Route::get('/{id}/edit', [AdminProfilEmployerController::class, 'edit'])->name('employers.edit');
        Route::put('/{id}', [AdminProfilEmployerController::class, 'update'])->name('employers.update');
        Route::delete('/{id}', [AdminProfilEmployerController::class, 'destroy'])->name('employers.destroy');
        Route::get('/search', [AdminProfilEmployerController::class, 'search'])->name('employers.search');
    });


    // Application Management for Admin
    Route::prefix('applications')->group(function () {
        Route::get('/', [AdminApplicationController::class, 'index'])->name('applications.index');
        Route::get('/search', [AdminApplicationController::class, 'search'])->name('applications.search');
        Route::get('/{id}', [AdminApplicationController::class, 'show'])->name('applications.show');
        Route::delete('/{id}', [AdminApplicationController::class, 'destroy'])->name('applications.destroy');
        Route::put('/application/{application}/status', [AdminApplicationController::class, 'updateStatus'])->name('updateStatus');
    });

    //logout Employer dashboard
    Route::get('/admin/logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');

    
});




    // Job Seeker Routes
    Route::middleware(['auth', 'role:Job Seeker'])->group(function () {  


        // Dashboard for Job Seeker
        Route::get('/jobseeker/dashboard', [JobseekerJobController::class, 'dashboardJobseker'])->name('jobseeker.dashboard');

        // View Available Jobs (Browse)
        Route::get('/jobseeker/jobs', [JobseekerJobController::class, 'index'])->name('jobseeker.jobs.index');
        Route::get('/jobseeker/search', [JobseekerJobController::class, 'search'])->name('jobseeker.jobs.search');

        // Applying and Saving Sobs
        Route::post('/jobs/{job}/apply', [JobseekerJobController::class, 'apply'])->name('jobs.apply');
        Route::post('/jobs/{job}/save', [JobseekerJobController::class, 'saveJob'])->name('jobs.save');
        Route::get('/saved-jobs', [SavedJobsController::class, 'index'])->name('savedJobs.index');



        // Job Applications Management
        Route::get('/jobseeker/applications', [JobseekerApplicationController::class, 'index'])->name('jobseeker.applications.index');
        Route::get('/jobseeker/applications/{id}', [JobseekerApplicationController::class, 'show'])->name('jobseeker.applications.show');
        Route::delete('/jobseeker/applications/{id}', [JobseekerApplicationController::class, 'destroy'])->name('jobseeker.applications.destroy');


        // Profile Management Routes
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/jobseeker/profile/create', 'create')->name('jobseeker.profile.create');
            Route::post('/jobseeker/profile', 'store')->name('profile.store');
            Route::delete('/profil', 'destroy')->name('profile.destroy');
        });

        // Edit and Update Job Seeker Profile
        Route::get('/profilejobseeker/edit', [ProfileJobseekerController::class, 'edit'])->name('profile.edit');
        Route::put('/profilejobseeker/update', [ProfileJobseekerController::class, 'update'])->name('profile.update');

        // Logout Jobseeker Route
        Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

        
    });






    // Employer Routes
    Route::middleware(['auth', 'role:employer'])->group(function () {
        // Dashboard for Employer
        Route::get('/employer/dashboard', [EmployerJobController::class, 'dashboardEmployer'])->name('employer.dashboard');

        // Manage Jobs
        Route::get('/employer/jobs', [EmployerJobController::class, 'index'])->name('employer.jobs.index'); // List all jobs
        Route::get('/employer/jobs/create', [EmployerJobController::class, 'create'])->name('employer.jobs.create'); // Show form to create a new job
        Route::post('/employer/jobs', [EmployerJobController::class, 'store'])->name('employer.jobs.store'); // Store a new job
        Route::get('/employer/jobs/{id}/edit', [EmployerJobController::class, 'edit'])->name('employer.jobs.edit'); // Show form to edit a job
        Route::put('/employer/jobs/{id}', [EmployerJobController::class, 'update'])->name('employer.jobs.update'); // Update an existing job
        Route::delete('/employer/jobs/{id}', [EmployerJobController::class, 'destroy'])->name('employer.jobs.destroy'); // Delete a job
        Route::get('/search', [EmployerJobController::class, 'search'])->name('employer.jobs.search'); // Search for jobs

        // View Applications for Jobs Posted by Employer
        Route::get('/employer/applications', [EmployerApplicationController::class, 'index'])->name('employer.applications.index'); // List all applications
        Route::get('/employer/applications/{id}', [EmployerApplicationController::class, 'show'])->name('employer.applications.show'); // View a specific application
        Route::delete('/employer/applications/{id}', [EmployerApplicationController::class, 'destroy'])->name('employer.applications.destroy'); // Delete an application

        // Update the status of an application
        Route::put('/applications/{application}/status', [EmployerApplicationController::class, 'updateStatus'])->name('applications.updateStatus');

        // Manage Candidates
        Route::get('/employer/candidates', [EmployerCondidateController::class, 'candidates'])->name('employer.candidates'); // List all candidates
        Route::get('/employer/candidates/{id}', [EmployerCondidateController::class, 'show'])->name('candidates.show'); // View details of a specific candidate

        // Employer Profile Management
        Route::get('/profileEmployer/create', [ProfilEmployerController::class, 'create'])->name('employer.profile.create');
        Route::post('/profileEmployer', [ProfilEmployerController::class, 'store'])->name('employer.profile.store'); 
        Route::get('/profileEmployer/edit', [ProfilEmployerController::class, 'edit'])->name('employer.profile.edit'); // Show form to edit employer profile
        Route::put('/profileEmployer/update', [ProfilEmployerController::class, 'update'])->name('employer.profile.update'); // Update employer profile
        Route::delete('/profile',[ProfileController::class , 'destroy'])->name('profile.destroy');



        //logout Employer dashboard
        Route::get('/employer/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });


    Route::get('/test', [TestEmailController::class, 'testEmail']);


 /*    Route::get('/test', function () {
        try {
            Mail::raw('This is a test email!', function ($message) {
                $message->to('aymanel2025@gmail.com')
                        ->subject('Test Email')
                        ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });
            return 'Test email sent!';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    });
 */


   /*  Route::get('/test', function () {
        dd(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
    }); */
    
  /*   Route::get('/test', function () {
        return [
            'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS'),
            'MAIL_FROM_NAME' => env('MAIL_FROM_NAME'),
        ];
    }); */
    
















/*  Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');

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


    //**************************** Employer Management ************************************

    // Route to display the list of employers
    Route::get('/employers', [ProfilEmployerController::class, 'index'])->name('employers.index');

    // Route to show the form for creating a new employer
    Route::get('/employers/create', [ProfilEmployerController::class, 'create'])->name('employers.create');

    // Route to store a new employer in the database
    Route::post('/employers', [ProfilEmployerController::class, 'store'])->name('employers.store');

    // Route to show the details of a specific employer
    Route::get('/employers/{id}', [ProfilEmployerController::class, 'show'])->name('employers.show');

    // Route to show the form for editing a specific employer
    Route::get('/employers/{id}/edit', [ProfilEmployerController::class, 'edit'])->name('employers.edit');

    // Route to update a specific employer's information
    Route::put('/employers/{id}', [ProfilEmployerController::class, 'update'])->name('employers.update');

    // Route to delete a specific employer from the database
    Route::delete('/employers/{id}', [ProfilEmployerController::class, 'destroy'])->name('employers.destroy');

    // Route to filter employer by criteria
    Route::get('/employer/search', [ProfilEmployerController::class, 'search'])->name('employers.search');


    //**************************** Application Management ************************************

    // Route to display the list of all applications
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');

    // Route to display a specific application by its ID
    Route::get('/applications/{id}', [ApplicationController::class, 'show'])->where('id', '[0-9]+') ->name('applications.show');

    // Route to delete a specific application by its ID
    Route::delete('/applications/{id}', [ApplicationController::class, 'destroy'])->name('applications.destroy');

    // Route to search for applications based on specified criteria
    Route::get('/applications/search', [ApplicationController::class, 'search'])->name('applications.search');


    
}); */





























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
