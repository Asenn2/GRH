<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Employe extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'Employe';

    protected $primaryKey = 'idEmploye';

    protected $fillable = [
        'mail',
        'nom',
        'prenom',
        'sexe',
        'LieuNaiss',
        'DateNaiss',
        'Num',
        'Adresse',
        'idPoste',
        'idDepartement'

    ];
    public function getId()
    {
        return $this->idEmploye;
    }

    //Clé étrangère ici :
    public function poste()
    {

        return $this->belongsTo(Poste::class, 'idPoste', 'idPoste');
    }

    public function departement()
    {

        return $this->belongsTo(Departement::class, 'idDepartement', 'idDepartement');
    }
    //Clé étrangère ailleurs


    public function conge()
    {

        return $this->hasMany(Conge::class);
    }

    public function tache()
    {

        return $this->hasMany(Tache::class);
    }

    public function contrats()
    {

        return $this->hasMany(Contrat::class, 'Employe');
    }

    public function promotions()
    {

        return $this->hasMany(Promotion::class);
    }

    public function demandeFormation()
    {

        return $this->hasMany(demandeFormation::class);
    }

    public function stage()
    {
        return $this->hasOne(Stagiaire::class, 'Employe');
    }
}
