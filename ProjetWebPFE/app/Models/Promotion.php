<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $table = 'Promotion';

    protected $primaryKey = 'idPromotion';

    protected $fillable = [
        'DatePromo',
        'NouveauPoste',
        'Formation',
        'Evaluation',
        'EmployePromu',
        'Commentaire',
    ];

    // Clé étrangère ici :

    public function poste()
    {
        return $this->belongsTo(Poste::class, 'NouveauPoste', 'idPoste');
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class, 'Formation', 'idFormation');
    }


    public function employe()
    {
        return $this->belongsTo(Employe::class, 'EmployePromu', 'idEmploye');
    }

    public function demandepromotions()
    {

        return $this->hasMany(DemandePromotion::class, 'Promotion');
    }
}
