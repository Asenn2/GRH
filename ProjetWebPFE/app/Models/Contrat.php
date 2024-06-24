<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;

    protected $table = 'Contrat';

    protected $primaryKey = 'idContrat';

    protected $fillable = [
        'status',
        'Employe',
        'Avantage',
        'poste',
        'Type',
        'Debut',
        'Fin',
        'soldeCG',
        'DateResiliation',
        'contratFile',
    ];

    //Clé étrangère ici :

    public function typeContrat()
    {
        return $this->belongsTo(TypeContrat::class, 'Type', 'idTypeContrat');
    }
    public function employe()
    {

        return $this->belongsTo(Employe::class, 'Employe', 'idEmploye');
    }

    public function isStatus()
    {

        $dateActuelle = now();


        if ($this->DateSignature > $dateActuelle) {
            return "Actif";
        } elseif ($this->Fin < $dateActuelle) {
            return "Expiré";
        } else {
            return "En cours";
        }
    }
    public function avantages()
    {
        return $this->belongsToMany(Avantage::class, 'contrat_avantage');
    }
}
