<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;





    public function profilEmployer()
    {
        return $this->belongsTo(ProfilEmployer::class, 'id_employeur');
    }

    public function Applications()
    {
        return $this->hasMany(Application::class, 'id_job');
    }
}
