<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $table = 'Formation';

    protected $primaryKey = 'idFormation';

    protected $fillable = [
        'NomFormation',
        'DateFormation',
        'DureeHeure',
        'Objectif',
        'Format'
    ];

    // Clé étrangère ailleurs:
    public function promotion()
    {
        return $this->hasMany(Promotion::class);
    }

    public function demandeF()
    {
        return $this->hasMany(DemandeFormation::class, 'Formation');
    }
}
