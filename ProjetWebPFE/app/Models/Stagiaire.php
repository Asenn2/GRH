<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stagiaire extends Model
{
    use HasFactory;

    protected $table = 'Stagiaire';

    protected $primaryKey = 'idStagiaire';

    protected $fillable = [
        'NomStagiaire',
        'PrenomStagiaire',
        'DebutStage',
        'FinStage',
        'Mail',
        'idStage',
        'Manager'
    ];

    // Clé étrangère ici :

    public function stage()
    {
        return $this->belongsTo(Stage::class, 'idStage', 'idStage');
    }

    public function tacheStage()
    {
        return $this->hasMany(tacheStage::class, 'Stagiaire');
    }
    public function manager()
    {
        return $this->belongsTo(Employe::class, 'Manager', 'idEmploye');
    }
}
