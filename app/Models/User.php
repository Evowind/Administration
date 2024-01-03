<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    public $timestamps = false;

    protected $hidden = ['mdp'];

    protected $fillable = ['login', 'mdp', 'type'];


    public function getAuthPassword()
    {
        return $this->mdp;
    }

    public function isAdmin()
    {
        return $this->type == 'admin';
    }

    public function isGestionnaire()
    {
        return $this->type == 'gestionnaire';
    }

    public function isEnseignant()
    {
        return $this->type == 'enseignant';
    }

    function cours()
    {
        return $this->belongsToMany(Cour::class, 'cours_users', 'user_id', 'cours_id');
    }
}
