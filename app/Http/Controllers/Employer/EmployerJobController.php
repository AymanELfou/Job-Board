<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class EmployerJobController extends Controller
{


    public function dashboardEmployer(){
        return view('Employer.employerDashboard');
    }

    public function create()
    {
        return view("Employer.createjob"); 
    }

    public function index()
    {
        $jobs = Job::all();
        return view("Employer.jobs", compact('jobs'));
    }

    
    // Store a newly created job posting
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'job_type' => 'required|string',
            'categorie' => 'nullable|string',
            'salaire' => 'nullable|numeric',
            'type_contrat' => 'nullable|string',
            'date_publication' => 'required|date',
            'company' => 'nullable|string|max:255',
        ]);

        $job = new Job();
        $job->id_employeur = auth()->user()->id; // Set the employer ID from the logged-in user
        $job->titre = $request->titre;
        $job->description = $request->description;
        $job->location = $request->location;
        $job->job_type = $request->job_type;
        $job->categorie = $request->categorie;
        $job->salaire = $request->salaire;
        $job->type_contrat = $request->type_contrat;
        $job->company = $request->company;
        $job->date_publication = $request->date_publication;
        $job->save();

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
            'company' => 'nullable|string|max:255',
        ]);

        $job->titre = $request->titre ?? $job->titre;
        $job->description = $request->description ?? $job->description;
        $job->location = $request->location ?? $job->location;
        $job->job_type = $request->job_type ?? $job->job_type;
        $job->categorie = $request->categorie ?? $job->categorie;
        $job->salaire = $request->salaire ?? $job->salaire;
        $job->type_contrat = $request->type_contrat ?? $job->type_contrat;
        $job->company = $request->company;
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
        $query->where(function ($q) use ($keyword) {
            $q->where('location', 'like', '%' . $keyword . '%')
              ->orWhere('categorie', 'like', '%' . $keyword . '%')
              ->orWhere('job_type', 'like', '%' . $keyword . '%')
              ->orWhere('titre', 'like', '%' . $keyword . '%'); // Optional: search by job title as well
        });
    }

    $jobs = $query->get();

    return view("Employer.jobs", compact('jobs'));
}

}




