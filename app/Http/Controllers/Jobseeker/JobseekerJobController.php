<?php

namespace App\Http\Controllers\Jobseeker;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;
use App\Models\SavedJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobseekerJobController extends Controller
{

    public function dashboardJobseker(){
        return view('Jobseeker.jobseekerDashboard');
    }



    public function index(){
        $jobs=Job::all();

        return view('Jobseeker.jobs',compact("jobs"));
    }



    public function apply(Request $request, Job $job){
        $request->validate([
            'resume' => 'nullable|file|max:2048', // Validate uploaded file
            'cover_letter' => 'required|string|max:2000',
        ]);

        $application = new Application();
        $application->id_job = $job->id;
        $application->id_jobseeker = Auth::id();
        $application->resume = $request->file('resume')->store('resumes', 'public'); // Store resume in 'storage/app/public/resumes'
        $application->cover_letter = $request->cover_letter;

        $application->save();
        return redirect()->back()->with('success', 'Your application has been submitted successfully!');

    }




    public function search(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'categorie' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);

        // Get the search parameters
        $categorie = $request->input('categorie');
        $location = $request->input('location');

        // Build the query
        $query = Job::query();

        // Filter by category if provided
        if ($categorie) {
            $query->where('categorie', 'LIKE', '%' . $categorie . '%');
        }

        // Filter by location if provided
        if ($location) {
            $query->where('location', 'LIKE', '%' . $location . '%');
        }

        // Execute the query and get the results
        $jobs = $query->get();

        // Return the view with the search results
        return view('Jobseeker.jobs', compact('jobs'));
    }



    public function saveJob(Request $request, $id){
        $user = auth()->user();

         // Vérifiez si l'emploi est déjà sauvegardé
            $existingSave = SavedJob::where('id_utilisateur', $user->id)
            ->where('id_job', $id)
            ->first();

        if ($existingSave) {
         // Si déjà sauvegardé, supprimez-le
            $existingSave->delete();

            return back()->with('success', 'Job removed from saved list.');
        }

        // Sinon, sauvegardez l'emploi
        $savedJob = new SavedJob();
        $savedJob->id_utilisateur = $user->id;
        $savedJob->id_job = $id;

        // Sauvegarder l'emploi en base de données avec save()
        $savedJob->save();

        return back()->with('success', 'Job saved successfully.');

    }



























}
