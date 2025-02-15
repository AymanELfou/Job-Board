<?php

namespace App\Http\Controllers\Jobseeker;

use App\Http\Controllers\Controller;
use App\Mail\JobApplicationMail;
use App\Models\Application;
use App\Models\Job;
use App\Models\SavedJob;
use App\Notifications\JobApplicationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class JobseekerJobController extends Controller
{

    public function dashboardJobseker(){
        return view('Jobseeker.jobseekerDashboard')->with('success', 'You have logged in as a Jobseeker.');
    }



    public function index(){
        $jobs=Job::paginate(3);

        return view('Jobseeker.jobs',compact("jobs"));
    }



    
    public function apply(Request $request, Job $job)
{
    // Get the authenticated user's profile
    $user = auth()->user();

    

    $request->validate([
        'resume' => 'nullable|file|max:2048', // Validate uploaded file
        'cover_letter' => 'required|string|max:2000',
    ]);

    $application = new Application();
    $application->id_job = $job->id;
    $application->id_jobseeker = $user->profile->id; // Ensure you're accessing the correct profile ID
    $application->resume = $request->file('resume') ? $request->file('resume')->store('resumes', 'public') : null; // Store resume if provided
    $application->cover_letter = $request->cover_letter;
    $application->save();

    // Send email notification to the employer
    $employer = $job->profilEmployer;

    // Check if employer exists and has a user with an email
    if ($employer && $employer->user && $employer->user->email) {
        $jobSeekerName = $user->name; 
        $jobTitle = $job->titre; 

        try {
            Mail::to($employer->user->email)->send(new JobApplicationMail($jobTitle, $jobSeekerName));
            return redirect()->back()->with('success', 'Your application has been submitted successfully! Email sent.');
        } catch (\Exception $e) {
            return redirect()->back()->with('success', 'Your application has been submitted, but the email could not be sent: ' . $e->getMessage());
        }
    } else {
        return redirect()->back()->with('success', 'Your application has been submitted, but no valid employer email found.');
    }
}

    
    
    
    
    
    
   /*  public function apply(Request $request, Job $job){

        
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
    } */




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
        $jobs = $query->paginate(10);

        // Return the view with the search results
        return view('Jobseeker.jobs', compact('jobs'));
    }



    public function saveJob(Request $request, $id){
        $user = auth()->user()->profile;

         // Vérifiez si l'emploi est déjà sauvegardé
            $existingSave = SavedJob::where('id_utilisateur', $user->id)
            ->where('job_id', $id)
            ->first();

        if ($existingSave) {
         // Si déjà sauvegardé, supprimez-le
            $existingSave->delete();

            return back()->with('success', 'Job removed from saved list.');
        }

        // Sinon, sauvegardez l'emploi
        $savedJob = new SavedJob();
        $savedJob->id_utilisateur = $user->id;
        $savedJob->job_id = $id;
        $savedJob->profile_id = $user->id;

        // Sauvegarder l'emploi en base de données avec save()
        $savedJob->save();
        


        return back()->with('success', 'Job saved successfully.');

    }






























}
