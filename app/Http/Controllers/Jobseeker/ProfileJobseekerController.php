<?php

namespace App\Http\Controllers\Jobseeker;

use App\Http\Controllers\Controller;
use App\Models\ProfilJobseeker;
use Illuminate\Http\Request;

class ProfileJobseekerController extends Controller
{

    public function edit($id){
        $Jobseeker=ProfilJobseeker::find($id);
        return view('Admin.Jobseekers.editJobseeker',compact('Jobseeker'));
    }











}
