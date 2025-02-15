<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class EmployerCondidateController extends Controller
{


    
    public function candidates(){

        $employerId = auth()->user()->profile->id; // ID de l'employeur connecté

        $candidates =Application::whereHas('job',function ($query) use ($employerId){
            $query->where('id_employeur', $employerId); // Filtrer les emplois de cet employeur
        })->with('job','profilJobseeker')->get();

        return view('Employer.condidates',compact('candidates'));
    }

    public function show($id){
        // Retrieve the application with the associated job and jobseeker profile
        $application = Application::with('profilJobseeker', 'job')->findOrFail($id);


        // Pass the application data to the view
        return view('Employer.showcondidat', compact('application'));
    }

}
