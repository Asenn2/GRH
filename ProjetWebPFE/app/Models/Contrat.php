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
        'Conditions',
        'Type',
        'Debut',
        'Fin',
        'DateResiliation',
        'contratFile',
    ];

    //Clé étrangère ici :

    public function typeContrat()
    {
        return $this->belongsTo(TypeContrat::class);
    }
    public function employe()
    {

        return $this->belongsTo(Employe::class);
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
}
