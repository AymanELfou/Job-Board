<?php

namespace App\Http\Controllers\Jobseeker;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\SavedJob;
use Illuminate\Http\Request;

class SavedJobsController extends Controller
{
    public function index(){

        // Get the authenticated user
        $user = auth()->user();

        // Retrieve saved jobs for the user
        $savedjobs = SavedJob::with('job')->where('id_utilisateur',$user->id)->get();

        // Pass saved jobs to the view
        return view('Jobseeker.savedjobs',compact('savedjobs'));
    }
}