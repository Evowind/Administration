<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $primaryKey = 'id';
    protected $fillable = ['intitule'];
    protected array $user_id = ['user_id'];

    protected $table = 'formations';

    public function cours()
    {
        return $this->hasMany(Cour::class);
    }

    function plannings()
    {
        return $this->hasMany(Planning::class, 'cour_id');
    }

    function etudiants()
    {
        return $this->belongsToMany(Cour_user::class, 'cours_etudiants', 'cours_id', 'etudiant_id');
    }

    function users()
    {
        return $this->belongsToMany(User::class, 'cours_users', 'cours_id', 'user_id');
    }
}
