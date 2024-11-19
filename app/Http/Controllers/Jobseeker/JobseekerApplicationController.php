<?php

namespace App\Http\Controllers\Jobseeker;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class JobseekerApplicationController extends Controller
{
    public function index(){

        $user=auth()->user();
        $applications = Application::with('job')->where('id_utilisateur',$user->id)->get();

        return view("Jobseeker.applicationjobs",compact('applications'));
    }
}
