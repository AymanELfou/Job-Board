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
    
        // Get the job seeker profile associated with the user
        // Ensure that a relationship has been defined in the User model
        $jobSeekerProfile = $user->profilJobseeker;
    
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
        $jobSeekerProfile = $user->profilJobseeker;
    
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
    









}
