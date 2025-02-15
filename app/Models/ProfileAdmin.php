<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileAdmin extends Model
{
    use HasFactory;

    // Specify the table if different from the pluralized model name
    protected $table = 'profil_admins';

    // Define fillable fields if using mass assignment
    protected $fillable = [
        'id_utilisateur',
        'name',
        'email',
    ];

    // Define relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class, 'profile_id');
    }
}
