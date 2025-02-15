<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;


    protected $fillable = [
        'id_jobseeker',
        'id_job',
        'status',
        'resume',
        'cover_letter'
    ];



    public function profilJobseeker()
    {
        return $this->belongsTo(ProfilJobseeker::class, 'id_jobseeker');
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'id_job');
    }
}
