<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilJobseeker;
use Illuminate\Http\Request;

class AdminProfilJobseekerController extends Controller
{
    
    
    
    //Display a listing of job seekers' profiles.

    public function index(){
        $Jobseekers=ProfilJobseeker::paginate(3);
        return view('Admin.Jobseekers.AllJobseekers',compact('Jobseekers'));
    }

/* 
    //Show the form for creating a new job seeker profile.

     public function create()
    {
       return view("Admin.Jobseekers.createJobseeker");
    }




    public function store(Request $request){

        
    
    $request->validate([
        'resume' => 'nullable|file|max:2048', // Validate that resume is a PDF file with a max size of 2MB
        'competences' => 'string|nullable',
        'experience' => 'string|nullable',
        'education' => 'string|nullable',
        'fullName' => 'string|nullable',
        'contact_information' => 'string|nullable',
    ]);

    

    // Create a new profile for the job seeker
    $Jobseeker = new ProfilJobseeker();
    $Jobseeker->id_utilisateur = auth()->user()->id; // Link to the currently logged-in user

    // Handle PDF upload
    if ($request->hasFile('resume')) {
        $pdfPath = $request->file('resume')->store('resume', 'public'); // Store the file in the 'resumes' directory in the public disk
        $Jobseeker->resume = $pdfPath; 
    }

    $Jobseeker->competences = $request->competences;
    $Jobseeker->fullName = $request->fullName;
    $Jobseeker->contact_information = $request->contact_information;
    $Jobseeker->experience = $request->experience;
    $Jobseeker->education = $request->education;
    $Jobseeker->derniere_mise_a_jour = now();
    
    $Jobseeker->save();

    return redirect()->route('jobseeker.index');
} */



/* 
    public function edit($id){
        $Jobseeker=ProfilJobseeker::find($id);
        return view('Admin.Jobseekers.editJobseeker',compact('Jobseeker'));
    }



    public function update(Request $request, $id)
{
    $Jobseeker = ProfilJobseeker::findOrFail($id);

    $request->validate([
        'resume' => 'nullable|file|max:2048', // Validate resume as a PDF file
        'competences' => 'string|nullable',
        'experience' => 'string|nullable',
        'education' => 'string|nullable',
        'fullName' => 'string|nullable',
        'contact_information' => 'string|nullable',
    ]);

    $Jobseeker->fullName = $request->fullName ?? $Jobseeker->fullName;
    $Jobseeker->contact_information = $request->contact_information ?? $Jobseeker->contact_information;
    $Jobseeker->competences = $request->competences ?? $Jobseeker->competences;
    $Jobseeker->experience = $request->experience ?? $Jobseeker->experience;
    $Jobseeker->education = $request->education ?? $Jobseeker->education;

    // Handle PDF upload if a new file is provided
    if ($request->hasFile('resume')) {
        $pdfPath = $request->file('resume')->store('resume', 'public'); // Store the file in 'resume' directory in the public disk
        $Jobseeker->resume = $pdfPath;
    }

    $Jobseeker->derniere_mise_a_jour = now(); // Update timestamp
    $Jobseeker->save();

    return redirect()->route('jobseeker.index')->with('success', 'Profile updated successfully.');
} */





    public function destroy($id){
        $Jobseeker=ProfilJobseeker::findOrFail($id);
        $Jobseeker->delete();

        return redirect()->route('jobseeker.index')->with('success', 'JobSeeker deleted successfully.');
    }


    public function search(Request $request)
    {
        $query = $request->input('fullName'); // Get search query from the request
    
        // Validate the search query (optional)
        $request->validate([
            'query' => 'nullable|string|max:255',
        ]);
    
        // Perform search on the 'fullName' column in the 'profil_jobseekers' table
        $Jobseekers = ProfilJobseeker::where('fullName', 'like', '%' . $query . '%')->paginate(10);
    
        // Return search results to a view (replace 'jobseekers.index' with your view name)
        return view('Admin.Jobseekers.AllJobseekers',compact('Jobseekers'));
    }
    






    










































}
