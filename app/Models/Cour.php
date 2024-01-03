<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cour extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $primaryKey = 'id';
    protected $fillable = ['intitule', 'user_id', 'formation_id'];

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    function users()
    {
        return $this->belongsToMany(User::class, 'cours_users', 'cours_id', 'user_id');
    }
}

