<?php

namespace App\Http\Controllers\Jobseeker;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class JobseekerApplicationController extends Controller
{
    public function index(){

        // Get the authenticated user
        $user=auth()->user()->profile;

        // Retrieve applications for the user
        $applications = Application::with('job')->where('id_jobseeker',$user->id)->get();

        return view("Jobseeker.applicationjobs",compact('applications'));
    }


    public function show($id){
        $application=Application::with('job')->find($id);

        return view("Jobseeker.showapplication",compact("application"));
    }
}
