<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_id', // Include profile_id here
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relationships:
    public function profile(){

    if ($this->role === 'admin') {
        return $this->belongsTo(ProfileAdmin::class, 'profile_id'); // Use profile_id
    } elseif ($this->role === 'Job Seeker') {
        return $this->belongsTo(ProfilJobseeker::class, 'profile_id'); // Use profile_id
    } elseif ($this->role === 'employer') {
        return $this->belongsTo(ProfilEmployer::class, 'profile_id'); // Use profile_id
    }

    return null;
}

    /* 
    public function profilEmployer()
    {
        return $this->hasOne(ProfilEmployer::class, 'id_utilisateur');
    }

    public function profilJobseeker()
    {
        return $this->hasOne(ProfilJobseeker::class, 'id_utilisateur');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'id_utilisateur');
    } 
    */
}
