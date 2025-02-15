<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilEmployer;
use Illuminate\Http\Request;

class AdminProfilEmployerController extends Controller
{
    
   // Display a listing of the employers
   public function index()
   {
       $Employers = ProfilEmployer::all();
       return view('Admin.Employers.AllEmployers', compact('Employers'));
   }


   // Display the specified employer
   public function show($id)
   {
       $Employer = ProfilEmployer::findOrFail($id);
       return view('employers.show', compact('Employer'));
   }

   // Show the form for editing the specified employer
   public function edit($id)
   {
       $Employer = ProfilEmployer::findOrFail($id);
       return view('Admin.Employers.editEmployer',compact('Employer'));
   }

    public function update(Request $request, $id)
    {
    $Employer = ProfilEmployer::findOrFail($id);

    $request->validate([
        'nom_entreprise' => 'required|string|max:255',
        'adresse' => 'required|string|max:255',
        'description' => 'nullable|string',
        'telephone' => 'nullable|string|max:20',
        'secteur_activite' => 'nullable|string|max:255',
    ]);

    // Update each attribute individually
    $Employer->nom_entreprise = $request->nom_entreprise;
    $Employer->adresse = $request->adresse;
    $Employer->description = $request->description;
    $Employer->telephone = $request->telephone;
    $Employer->secteur_activite = $request->secteur_activite;
    $Employer->derniere_mise_a_jour = now();

    // Save the updated employer to the database
    $Employer->save();

    return redirect()->route('employers.index')->with('success', 'Employer updated successfully.');
    }


   // Remove the specified employer from storage
   public function destroy($id)
   {
       $employer = ProfilEmployer::findOrFail($id);
       $employer->delete();

       return redirect()->route('employers.index')->with('success', 'Employer deleted successfully.');
   }



   public function search(Request $request)
{
    $query = $request->input('nom_entreprise'); // Get search query from the request

    // Validate the search query (optional)
    $request->validate([
        'nom_entreprise' => 'nullable|string|max:50',
    ]);

    // Perform search on the 'nom_entreprise' column in the 'profil_employers' table
    $Employers = ProfilEmployer::where('nom_entreprise', 'like', '%' . $query . '%')->get();

    // Return search results to a view (replace 'Employers.AllEmployers' with your view name)
    return view('Admin.Employers.AllEmployers', compact('Employers'));
}







}
