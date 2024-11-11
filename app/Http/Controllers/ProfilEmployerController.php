<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilEmployerController extends Controller
{
    
    public function index(){
        return view('Employers.employers');
    }
}
