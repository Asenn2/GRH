<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;

    protected $table = 'Candidature';

    protected $primaryKey = 'idCandidature';

    protected $fillable = [
        'idOffreEmploi',
        'idCandidat',
        'Motivation',

    ];

    //Clé étrangère ici :

    public function offreEmploi()
    {
        return $this->belongsTo(OffreEmploi::class, 'idOffreEmploi', 'idOffreEmploi');
    }

    public function Candidat()
    {
        return $this->belongsTo(Candidat::class, 'idCandidat', 'idCandidat');
    }
}
