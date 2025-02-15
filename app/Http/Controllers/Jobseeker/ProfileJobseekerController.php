<?php

namespace App\Http\Controllers\Jobseeker;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobseekerRequest;
use App\Models\ProfilJobseeker;
use Illuminate\Http\Request;

class ProfileJobseekerController extends Controller
{

    public function edit(Request $request) {
        // Retrieve the currently authenticated user
        $user = $request->user();
    
        
        // Ensure that a relationship has been defined in the User model

        // Get the job seeker profile associated with the user
        $jobSeekerProfile = $user->profile;
      

        // Return the edit view for the profile, passing the user and their profile data
        return view('profile.edit', [
            'user' => $user,
            'profile' => $jobSeekerProfile,
        ]);
    }
    


    
    public function update(JobseekerRequest $request) {
        // Retrieve the currently authenticated user
        $user = $request->user();
    
        // Get the user's job seeker profile
        $jobSeekerProfile = $user->profile;
    
        // Check if a resume file has been uploaded
        if ($request->hasFile('resume')) {
            // Store the uploaded resume in the 'storage/app/public/resumes' directory
            $filePath = $request->file('resume')->store('resumes', 'public');
    
            // Merge the file path into the request data for later use
            $request->merge(['resume' => $filePath]);
        }
    
        // Update the job seeker profile with the validated data from the request
        $jobSeekerProfile->update($request->validated());
    
        // Optionally, add a success message to the session to notify the user
        session()->flash('success', 'Profile updated successfully!');
    
        // Redirect to the profile edit page with a success message
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }
    

   
    
    /**
     * Show the form for creating a new profile.
     */
    /* public function create()
    {
        // Return the view to create a new profile
        return view('Jobseeker.createjobseeker');
    } */
    
    /**
     * Store a newly created profile in storage.
     */
    /* public function store(Request $request)
    {
        
        // Validate the incoming request data
        $request->validate([
            'resume' => 'nullable|file|max:2048', // Validate that resume is a file with a max size of 2MB
            'competences' => 'string|nullable',
            'experience' => 'string|nullable',
            'education' => 'string|nullable',
            'fullName' => 'string|nullable',
            'contact_information' => 'string|nullable',
        ]);
    
        // Create a new profile for the job seeker
        $Jobseeker = new ProfilJobseeker();
        $Jobseeker->id_utilisateur = auth()->user()->id; // Link to the currently logged-in user
        
        // Handle PDF upload if a resume file is provided
        if ($request->hasFile('resume')) {
            // Store the file in the 'resumes' directory in the public disk
            $pdfPath = $request->file('resume')->store('resume', 'public'); 
            $Jobseeker->resume = $pdfPath; // Set the resume path in the profile
        }
    
        // Assign other profile data from the request to the job seeker profile
        $Jobseeker->competences = $request->competences;
        $Jobseeker->fullName = $request->fullName;
        $Jobseeker->contact_information = $request->contact_information;
        $Jobseeker->experience = $request->experience;
        $Jobseeker->education = $request->education;
        $Jobseeker->derniere_mise_a_jour = now(); // Set the last updated timestamp
    
        // Save the job seeker profile
        $Jobseeker->save();

        // Update the user's profile_id with the newly created profile's ID
        $user = auth()->user();
        $UserProfileId = $user->profile_id;
        $profileId = $UserProfileId->$Jobseeker->id;
        dd($profileId);
        //$user->profile_id = $Jobseeker->id; // Assign the new profile ID
        $profileId->save(); // Save the user

        return dd($profileId); */
    

    
        /* // Redirect to the jobseeker applications index with a success message
        return redirect()->route('jobseeker.applications.index')->with('success', 'Profile created successfully.'); 
    }
    */







}
