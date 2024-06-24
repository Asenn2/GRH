<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeFormation extends Model
{
    use HasFactory;

    protected $table = 'DemandeFormation';

    protected $primaryKey = 'idDemandeFormation';

    public $timestamps = false;


    protected $fillable = [
        'Formation',
        'Employe',
        'status',

    ];

    //Clé étrangère ici :

    public function formation()
    {
        return $this->belongsTo(Formation::class, 'Formation', 'idFormation');
    }

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'Employe', 'idEmploye');
    }
}
