<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class AdminApplicationController extends Controller
{


    public function index(){
        
        // Retrieve applications with related job and jobseeker data

        $applications = Application::with(['job','profilJobseeker'])->get();

        // Retrieve applications with related job and jobseeker data

        return view('Admin.Application.Applications',compact('applications'));
    }


    public function show($id){

        $application = Application::with(['job','profilJobseeker'])->find($id);

        return view('Admin.Application.show',compact('application'));

    }

    public function destroy($id){
        $application = Application::find($id);

        $application->delete();

        return redirect()->route('applications.index');
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





    
}
