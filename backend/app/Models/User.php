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
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
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

    public function jobs()
    {
        return $this->hasMany(Job::class, 'user_id');
    } 

    // Método para verificar se o usuário é recrutador
    public function isRecruiter() {
        return $this->role === 'recruiter'; // Verifica se o campo 'role' é igual a 'recruiter'
    }

    // Método para verificar se o usuário é candidato
    public function isCandidate() {
        return $this->role === 'candidate'; // Verifica se o campo 'role' é igual a 'candidate'
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
