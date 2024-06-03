<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poste extends Model
{
    use HasFactory;

    protected $table = 'Poste';

    protected $primaryKey = 'idPoste';

    protected $fillable = [
        'Fonction',
        'AdresseLieuTravail',
        'Salaire',
    ];

    // Clé étrangère ailleurs : 

    public function promotion()
    {

        return $this->hasOne(Conge::class);
    }
    public function employes()
    {

        return $this->hasMany(Employe::class);
    }

    public function promotions()
    {

        return $this->hasMany(Promotion::class);
    }
}
