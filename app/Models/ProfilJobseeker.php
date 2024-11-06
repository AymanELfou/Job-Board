<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilJobseeker extends Model
{
    use HasFactory;





    //Relashionships:

    public function user()
    {
        return $this->belongsTo(User::class, 'id_utilisateur');
    }

    public function Applications()
    {
        return $this->hasMany(Application::class, 'id_jobseeker');
    }
}
