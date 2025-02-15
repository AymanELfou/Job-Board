<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\ProfileAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.createProfile');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
{
    // Verify the user has admin privileges
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Unauthorized action.');
    }
    
    $user = auth()->user();

    // Create a new profile for the Admin
    $adminProfile=ProfileAdmin::create([
        'id_utilisateur' => $user->id, // Link to the currently logged-in user
        'name'=>$request->name,
        'email'=>$request->email,
    ]);
    
    
    /** @var \App\Models\User $user */
    $user->update(['profile_id' => $adminProfile->id]);

    return redirect()->route('admin.dashboard')->with('success', 'Profile Admin created successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
