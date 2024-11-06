<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;






    public function profilJobseeker()
    {
        return $this->belongsTo(ProfilJobseeker::class, 'id_jobseeker');
    }

    public function jobs()
    {
        return $this->belongsTo(Job::class, 'id_job');
    }
}
