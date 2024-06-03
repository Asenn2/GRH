<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeContrat extends Model
{
    use HasFactory;

    protected $table = 'typeContrat';

    protected $primaryKey = 'idTypeContrat';

    protected $fillable = [
        'NomTypeContrat',
        'Desc',

    ];

    // Clé étrangère ailleurs :

    public function contrat()
    {

        return $this->hasMany(Contrat::class);
    }
}
