<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedJob extends Model
{
    use HasFactory;





    public function job()
    {
        return $this->belongsTo(Job::class, 'id_job');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_utilisateur');
    }







    

}