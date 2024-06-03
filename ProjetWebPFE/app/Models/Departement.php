<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Departement extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'departement';

    protected $primaryKey = 'idDepartement';

    protected $fillable = [
        'nom',
        'Desc',
        'photo'
    ];

            //Clé étrangère ailleurs :
            
    public function stage(){

        return $this->hasMany(Stage::class);
    }
    public function employes(){

        return $this->hasMany(Employe::class);
    }
}