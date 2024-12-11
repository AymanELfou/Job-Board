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

    // Créer une nouvelle offre d'emploi
    /* public function store(Request $request)
{
    $request->validate([
        'titre' => 'required|string',
        'description' => 'required|string',
        'location' => 'required|string',
        'job_type' => 'string|required',
        'categorie' => 'string|nullable',
        'salaire' => 'numeric|nullable',
        'type_contrat' => 'string|nullable',
        'date_publication' => 'required|date',
    ]);

    $job = new Job();
    $job->id_employeur = auth()->user()->id; // Set the employer ID from the logged-in user
    $job->titre = $request->titre;
    $job->description = $request->description;
    $job->location = $request->location;
    $job->job_type = $request->job_type;
    $job->categorie = $request->categorie;
    $job->salaire = $request->salaire;
    $job->type_contrat = $request->type_contrat;
    $job->date_publication = $request->date_publication;
    $job->save();

    return redirect()->route('jobs.index');
}

    // Afficher le formulaire d'édition
    public function edit($id)
    {
        $job = Job::findOrFail($id);
        return view("Admin.Jobs.editJob", compact('job'));
    }

    // Mettre à jour une offre d'emploi
    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);

        $request->validate([
            'titre' => 'string|nullable',
            'company' => 'string|nullable',
            'description' => 'string|nullable',
            'location' => 'string|nullable',
            'job_type' => 'string|nullable',
            'categorie' => 'string|nullable',
            'salaire' => 'numeric|nullable',
            'type_contrat' => 'string|nullable',
            'date_publication' => 'date|nullable',
        ]);

        $job->titre = $request->titre ?? $job->titre;
        $job->company = $request->company ?? $job->company;
        $job->description = $request->description ?? $job->description;
        $job->location = $request->location ?? $job->location;
        $job->job_type = $request->job_type ?? $job->job_type;
        $job->categorie = $request->categorie ?? $job->categorie;
        $job->salaire = $request->salaire ?? $job->salaire;
        $job->type_contrat = $request->type_contrat ?? $job->type_contrat;
        $job->date_publication = $request->date_publication ?? $job->date_publication;
        $job->save();

        return redirect()->route('jobs.index');
    }
 */
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
