<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilEmployer extends Model
{
    use HasFactory;



    protected $fillable = [
        'nom_entreprise',
        'adresse',
        'description',
        'telephone',
        'secteur_activite',
    ];





    //Relashionships:

    public function user()
    {
        return $this->belongsTo(User::class, 'profile_id');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'id_employeur');
    }
}
