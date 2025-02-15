<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;


class AdminJobController extends Controller
{
    // Afficher le formulaire de création
    public function create()
    {
        return view("Admin.Jobs.createJob"); 
    }

    // Afficher toutes les offres d'emploi
    public function index()
    {
        $jobs = Job::paginate(3);
        return view("Admin.Jobs.jobs", compact('jobs'));
    }

    // Supprimer une offre d'emploi
    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return redirect()->route('jobs.index');
    }

    // Filtrer les offres d'emploi par critères
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

    $jobs = $query->paginate(10);

    return view("Admin.Jobs.jobs", compact('jobs'));
}

}
