<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;



    public function savedJobs()
    {
        return $this->hasMany(SavedJob::class, 'id_job');
    }

    // Define the isSavedBy method
    public function isSavedBy($user)
    {
        // Check if the job is saved by the given user
        return $this->savedJobs()->where('id_utilisateur', $user->id)->exists();
    }









    public function profilEmployer()
    {
        return $this->belongsTo(ProfilEmployer::class, 'id_employeur');
    }

    public function Applications()
    {
        return $this->hasMany(Application::class, 'id_job');
    }
}
