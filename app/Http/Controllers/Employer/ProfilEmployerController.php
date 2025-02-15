<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployerRequest;
use App\Models\ProfilEmployer;
use Illuminate\Http\Request;

class ProfilEmployerController extends Controller
{


    public function create()
{
    // Return the view to create a new profile
    return view('Employer.createEmployer');
}

/**
 * Store a newly created profile in storage.
 */
public function store(EmployerRequest $request)
{
    $user = auth()->user();
   
    // Create a new profile for the job seeker
    $Employer = new ProfilEmployer();
     // Link to the currently logged-in user
    $Employer->id_utilisateur = $user->id; // Link to the currently logged-in user

    
    // Assign other profile data from the request to the job seeker profile
    $Employer->nom_entreprise = $request->nom_entreprise;
    $Employer->adresse = $request->adresse;
    $Employer->description = $request->description;
    $Employer->telephone = $request->telephone;
    $Employer->secteur_activite = $request->secteur_activite;
    $Employer->derniere_mise_a_jour = now(); // Set the last updated timestamp

    // Save the job seeker profile
    $Employer->save();

    
    /** @var \App\Models\User $user */
    $user->update(['profile_id' => $Employer->id]);
   
    
    // Redirect to the jobseeker applications index with a success message
    return redirect()->route('employer.dashboard')->with('success', 'Profile created successfully.');
}




    public function edit(Request $request) {
        // Retrieve the currently authenticated user
        $user = $request->user();
        
        // Get the employer profile associated with the user using the profile() method
        $employerProfile = $user->profile;

        if (!$employerProfile || $user->role !== 'employer') {
            // Handle the case where the employer profile does not exist or user is not an employer
            return redirect()->route('employer.dashboard')->with('error', 'Employer profile not found.');
        }

        // Return the edit view for the profile, passing the user and their profile data
        return view('Employer.editEmployer', [
            'user' => $user,
            'profile' => $employerProfile,
        ]);
    }
    





    public function update(EmployerRequest $request) {
        // Retrieve the currently authenticated user
        $user = $request->user();
    
        // Get the user's employer profile
        $employerProfile = $user->profile; // Adjusted to reference the employer profile
    
        
        if (!$employerProfile || $user->role !== 'employer') {
            // Handle the case where the employer profile does not exist or user is not an employer
            return redirect()->route('employer.dashboard')->with('error', 'Employer profile not found.');
        }

        // Update the employer profile with the validated data from the request
        $employerProfile->update($request->validated());
    
        // Optionally, add a success message to the session to notify the user
        session()->flash('success', 'Profile updated successfully!');
    
        // Redirect to the profile edit page with a success message
        return redirect()->route('employer.profile.edit')->with('success', 'Profile updated successfully!');
    }
    
}
