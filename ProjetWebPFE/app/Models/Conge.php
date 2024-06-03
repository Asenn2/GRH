<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conge extends Model
{
    use HasFactory;

    protected $table = 'Conge';

    protected $primaryKey = 'idConge';

    protected $fillable = [
        'NomConge',
        'TypeConge',
        'DateDebut',
        'DateFin',
        'Description',
        'status'
    ];

    //Clé étrangère ici :

    public function typeConge()
    {
        return $this->belongsTo(TypeConge::class, 'TypeConge', 'idTypeConge');
    }
}
