<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;
use App\Models\ProfilJobseeker;
use Illuminate\Http\Request;

class EmployerJobController extends Controller
{


    public function dashboardEmployer() {
        // Get the ID of the currently authenticated employer
        $employerId = auth()->user()->profile->id;
    
        // Retrieve the monthly job postings for the authenticated employer
        $monthlyPostings = Job::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->where('id_employeur', $employerId) // Filter jobs by the authenticated employer
            ->groupBy('month') // Group results by month
            ->orderBy('month') // Order results by month
            ->get(); // Execute the query and get the results
    
        // Retrieve the monthly applications for jobs associated with the authenticated employer
        $monthlyApplications = Application::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereHas('job', function ($query) use ($employerId) {
                $query->where('id_employeur', $employerId); // Filter applications by jobs of this employer
            })
            ->groupBy('month') // Group results by month
            ->orderBy('month') // Order results by month
            ->get(); // Execute the query and get the results
    
        // Retrieve the candidate quality based on education levels of job seekers who applied for the employer's jobs
        $candidateQuality = ProfilJobseeker::selectRaw('education, COUNT(*) as count')
            ->whereHas('applications', function ($query) use ($employerId) {
                $query->whereHas('job', function ($query) use ($employerId) {
                    $query->where('id_employeur', $employerId); // Filter by jobs of this employer
                });
            })
            ->groupBy('education') // Group results by education level
            ->get(); // Execute the query and get the results
    
        // Count the total number of jobs posted by the authenticated employer
        $totalJobs = Job::where('id_employeur', $employerId)->count(); // Count total jobs
    
        // Count the total applications for the employer's jobs, eager loading related models 
        $totaltApplications = Application::whereHas('job', function ($query) use ($employerId) {
            $query->where('id_employeur', $employerId); // Filter applications by jobs of this employer
        })->with('job', 'profilJobseeker') // Eager load related job and job seeker profiles
        ->get()->count(); // Execute the query and count the results
    
        // Count distinct job seekers who applied for the employer's jobs (Total Candidates)
        $totalJobseekers = Application::whereHas('job', function ($query) use ($employerId) {
            $query->where('id_employeur', $employerId); // Filter applications by jobs of this employer
        })
        ->distinct('id_jobseeker') // Ensure distinct job seekers
        ->count('id_jobseeker'); // Count distinct job seekers
    
        // Return the view with all the collected data for the employer's dashboard
        return view('Employer.employerDashboard', compact('monthlyPostings', 'monthlyApplications', 'candidateQuality', 'totalJobs', 'totaltApplications', 'totalJobseekers'))
        ->with('success', 'You have logged in as a Employer.');
    }
    






    public function create()
    {
        return view("Employer.createjob"); 
    }

    public function index()
    {
        $employerId = auth()->user()->profile->id;
        $jobs = Job::where('id_employeur',$employerId)->paginate(3);
        
        return view("Employer.jobs", compact('jobs'));
    }

    
    // Store a newly created job posting
    public function store(Request $request)
    {
        $data = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'job_type' => 'required|string',
            'categorie' => 'nullable|string',
            'salaire' => 'nullable|numeric',
            'type_contrat' => 'nullable|string',
            'date_publication' => 'required|date',
        ]);

        
        auth()->user()->profile->jobs()->create($data);
        
        return redirect()->route('employer.jobs.index')->with('success', 'Job posted successfully!');
    }





    
    // Show the form for editing a job posting
    public function edit($id)
    {
        $job = Job::findOrFail($id);
        return view("Employer.editjob", compact('job'));
    }

    // Update a job posting
    public function update(Request $request, $id)
    {
        
        $job = Job::findOrFail($id);

        $request->validate([
            'titre' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'job_type' => 'nullable|string',
            'categorie' => 'nullable|string',
            'salaire' => 'nullable|numeric',
            'type_contrat' => 'nullable|string',
            'date_publication' => 'nullable|date',
            
        ]);

        $job->titre = $request->titre ?? $job->titre;
        $job->description = $request->description ?? $job->description;
        $job->location = $request->location ?? $job->location;
        $job->job_type = $request->job_type ?? $job->job_type;
        $job->categorie = $request->categorie ?? $job->categorie;
        $job->salaire = $request->salaire ?? $job->salaire;
        $job->type_contrat = $request->type_contrat ?? $job->type_contrat;
        $job->date_publication = $request->date_publication ?? $job->date_publication;
        $job->save();

        return redirect()->route('employer.jobs.index')->with('success', 'Job updated successfully!');
    }







    // Delete a job posting
    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return redirect()->route('employer.jobs.index')->with('success', 'Job deleted successfully!');
    }


    public function search(Request $request)
{
    $keyword = $request->input('keyword');

    $query = Job::query();

    if ($keyword) {
        // Apply filters based on the keyword
        $query->where(function ($q) use ($keyword) {
            $q->where('location', 'like', '%' . $keyword . '%')
              ->orWhere('categorie', 'like', '%' . $keyword . '%')
              ->orWhere('job_type', 'like', '%' . $keyword . '%')
              ->orWhere('titre', 'like', '%' . $keyword . '%'); // Optional: search by job title as well
        });
    }

    // Get paginated results
    $jobs = $query->paginate(3);

    return view("Employer.jobs", compact('jobs'));
}
}




