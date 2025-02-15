<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Jobseeker\ProfileJobseekerController;
use App\Models\Application;
use App\Models\Job;
use App\Models\ProfilEmployer;
use App\Models\ProfilJobseeker;
use Illuminate\Http\Request;

class AdminApplicationController extends Controller
{


    public function index(){
        
        // Retrieve applications with related job and jobseeker data

        $applications = Application::with(['job','profilJobseeker'])->get();

        $totalJobs = Job::count();
        $recentApplications = Application::orderBy('created_at','desc')->take(5)->get();
        $totalJobseekers = ProfilJobseeker::count();
        $totalEmployers = ProfilEmployer::count();

        $totalUsers = $totalJobseekers + $totalEmployers;

        return view('Admin.Application.Applications',compact('applications','totalJobs','recentApplications','totalUsers'));
    }


    public function show($id){

        $application = Application::with(['job','profilJobseeker'])->find($id);

        return view('Admin.Application.show',compact('application'));
    }

    public function destroy($id){
        $application = Application::findorFail($id);

        $application->delete();

        return redirect()->route('applications.index')->with('success', 'Application deleted successfully.');
    }



    public function search(Request $request)
    {
    $quer = $request->input('quer'); // Récupérer la requête de recherche

    // Valider la requête (facultatif)
    $request->validate([
        'query' => 'nullable|string|max:255',
    ]);

    // Rechercher dans les colonnes 'fullName' et 'titre' de la table 'applications'
    $applications = Application::whereHas('profilJobseeker', function($q) use ($quer) {
        $q->where('fullName', 'like', '%' . $quer . '%');
    })->orWhereHas('job', function($q) use ($quer) {
        $q->where('titre', 'like', '%' . $quer . '%');
    })->get();

    // Retourner les résultats de la recherche à une vue
    return view('Admin.Application.Applications', compact('applications'));
    }


    public function updateStatus(Request $request, Application $application)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected', // Ensure valid statuses
        ]);
    
       /*  // Verify that the application belongs to the employer's job
        if ($application->job->employer_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        } */
    
        // Assign the new status and save the application
        $application->status = $validated['status'];
        $application->save();
    
        // Optionally, add a success message
        return redirect()->back()->with('success', 'Status updated successfully.');
    }


    
}
