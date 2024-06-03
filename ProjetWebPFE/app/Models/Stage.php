<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $table = 'Stage';

    protected $primaryKey = 'idStage';

    protected $fillable = [
        'Type',
        'Objectif',
        'Desc',
        'idDepartement',
    ];

    // Clé étrangère ici :

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'idDepartement', 'idDepartement');
    }
    public function typestage()
    {

        return $this->belongsTo(typestage::class, 'Type', 'idTypeStage');
    }
    // Clé étrangère ailleurs : 

    public function stagiaire()
    {

        return $this->hasMany(Stagiaire::class);
    }
}
