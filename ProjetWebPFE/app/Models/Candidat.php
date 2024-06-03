<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    use HasFactory;

    protected $table = 'Candidat';

    protected $primaryKey = 'idCandidat';

    protected $fillable = [
        'nom',
        'prenom',
        'Mail',
        'Competence',
        'Cv',
    ];

    public function candidatures()
    {

        return $this->hasMany(Candidature::class);
    }
}
