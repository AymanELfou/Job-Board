<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\ProfilJobseeker;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
 * Display the user's profile form.
 */
public function edit(Request $request): View
{
    // Retrieve the currently authenticated user
    $user = $request->user();

    // Get the job seeker profile associated with the user
    // Ensure that a relationship has been defined in the User model
    $jobSeekerProfile = $user->profile;

    // Return the edit view for the profile, passing the user and their profile data
    return view('profile.edit', [
        'user' => $user,
        'profile' => $jobSeekerProfile,
    ]);
}

/**
 * Update the user's profile information.
 */
public function update(ProfileUpdateRequest $request)
{
    // Retrieve the currently authenticated user
    $user = $request->user();
    
    // Update the user's information with validated data from the request
    $user->fill($request->validated());

    // Check if the email has changed; if so, set email_verified_at to null
    if ($user->isDirty('email')) {
        $user->email_verified_at = null; // Mark email as unverified
    }

    // Save the updated user information
    $user->save();

    // Prepare the data to update the job seeker profile (including fullName and contact_information)
    $profileData = $request->only([
        'resume',
        'competences',
        'experience',
        'education',
        'fullName',
        'contact_information',
    ]);

    // Update the job seeker profile with the new data
    $user->profile->update($profileData);

    // Redirect to the profile edit page with a success message
    return Redirect::route('profile.edit')->with('success', 'profile-updated');
}

/**
 * Delete the user's account.
 */
public function destroy(Request $request): RedirectResponse
{
    // Validate the request to ensure the current password is provided
    $request->validateWithBag('userDeletion', [
        'password' => ['required', 'current_password'],
    ]);

    // Retrieve the currently authenticated user
    $user = $request->user();

    // Log out the user
    Auth::logout();

    // Delete the user account
    $user->delete();

    // Invalidate the session and regenerate the CSRF token
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Redirect to the home page after account deletion
    return Redirect::to('/');
}

/**
 * Show the form for creating a new profile.
 */
public function create()
{
    // Return the view to create a new profile
    return view('Jobseeker.createjobseeker');
}

/**
 * Store a newly created profile in storage.
 */
public function store(Request $request)
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

    $user = auth()->user(); //authenticated user
    $currentProfileId = $user->profile_id; // get the current profile Id
    $newProfileId = $Jobseeker->id; // get the new profile Id

    $user->profile_id = $newProfileId; // Assign the new profile ID
    
    /** @var \App\Models\User $user */
    $user->save(); // Save the user

    // Redirect to the jobseeker applications index with a success message
    return redirect()->route('jobseeker.jobs.index')->with('success', 'Profile created successfully.');
}

















    
}
