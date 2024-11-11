<?php

namespace App\Http\Controllers;

use App\Models\ProfilJobseeker;
use Illuminate\Http\Request;

class ProfilJobseekerController extends Controller
{
    

    
    //Display a listing of job seekers' profiles.

    public function index(){
        $Jobseekers=ProfilJobseeker::all();
        return view('Jobseekers.AllJobseekers',compact('Jobseekers'));
    }


    //Show the form for creating a new job seeker profile.

     public function create()
    {
       return view("Jobseekers.createJobseeker");
    }




    public function store(Request $request){
    
    $request->validate([
        'resume' => 'nullable|file:pdf|max:2048', // Validate that resume is a PDF file with a max size of 2MB
        'competences' => 'string|nullable',
        'experience' => 'string|nullable',
        'education' => 'string|nullable',
        'fullName' => 'string|nullable',
        'contact_information' => 'string|nullable',
    ]);
    dd($request);

    // Create a new profile for the job seeker
    $Jobseeker = new ProfilJobseeker();
    $Jobseeker->id_utilisateur = auth()->user()->id; // Link to the currently logged-in user

    // Handle PDF upload
    if ($request->hasFile('resume')) {
        $pdfPath = $request->file('resume')->store('resume', 'public'); // Store the file in the 'resumes' directory in the public disk
        $Jobseeker->resume = $pdfPath; 
    }

    $Jobseeker->competences = $request->competences;
    $Jobseeker->experience = $request->experience;
    $Jobseeker->education = $request->education;
    $Jobseeker->derniere_mise_a_jour = now();
    $Jobseeker->save();

    return redirect()->route('jobseekers.index')->with('success', 'Profile created successfully.');
}




    public function edit($id){
        $Jobseeker=ProfilJobseeker::find($id);
        return view('Jobseekers.editJobseeker',compact('Jobseeker'));
    }



    public function update(Request $request, $id){

    $profile = ProfilJobseeker::findOrFail($id);

    $request->validate([
        'resume' => 'string|nullable',
        'competences' => 'string|nullable',
        'experience' => 'string|nullable',
        'education' => 'string|nullable',
    ]);

    $profile->resume = $request->resume ?? $profile->resume;
    $profile->competences = $request->competences ?? $profile->competences;
    $profile->experience = $request->experience ?? $profile->experience;
    $profile->education = $request->education ?? $profile->education;
    $profile->derniere_mise_a_jour = now(); //Update the timestamp

    $profile->save();

    return redirect()->route('jobseekers.index')->with('success', 'Profile updated successfully.');
    
    }




    public function destroy($id){
        $Jobseeker=ProfilJobseeker::findOrFail($id);
        $Jobseeker->delete();
        
        return redirect()->route('jobseekers.index')->with('success', 'Profile deleted successfully.');
    }






    










































}
