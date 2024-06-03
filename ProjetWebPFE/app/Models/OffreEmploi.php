<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffreEmploi extends Model
{
    use HasFactory;

    protected $table = 'OffreEmploi';

    protected $primaryKey = 'idOffreEmploi';

    protected $fillable = [
        'idTypeContrat',
        'idPoste',
        'idDepartement',
        'CompetenceRequise',
        'Commentaire'
    ];

    // Clé étrangère ici :

    public function typecontrat()
    {
        return $this->belongsTo(TypeContrat::class, 'idTypeContrat', 'idTypeContrat');
    }


    public function poste()
    {
        return $this->belongsTo(Poste::class, 'idPoste', 'idPoste');
    }


    public function departement()
    {
        return $this->belongsTo(Departement::class, 'idDepartement', 'idDepartement');
    }

    // Clé étrangère ailleurs :

    public function candidature()
    {

        return $this->hasMany(Candidature::class);
    }
}
