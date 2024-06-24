<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;

    protected $table = 'tache';
    public $timestamps = false;

    protected $primaryKey = 'idTache';

    protected $fillable = [
        'contenu',
        'idEmploye'
    ];

    // Clé étrangère ici :

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'idEmploye', 'idEmploye');
    }
}
