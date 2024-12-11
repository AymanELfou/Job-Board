<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilJobseeker extends Model
{
    use HasFactory;


    protected $fillable = [
        'resume',
        'competences',
        'experience',
        'education',
        'fullName',
        'contact_information',
    ];
    


    //Relashionships:

    public function user()
    {
        return $this->belongsTo(User::class, 'profile_id');
    }

    public function Applications()
    {
        return $this->hasMany(Application::class, 'id_jobseeker');
    }
}
