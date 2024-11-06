<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilEmployer extends Model
{
    use HasFactory;



    //Relashionships:

    public function user()
    {
        return $this->belongsTo(User::class, 'id_utilisateur');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'id_employeur');
    }
}
