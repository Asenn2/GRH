<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandePromotion extends Model
{
    use HasFactory;

    protected $table = 'DemandePromotion';

    protected $primaryKey = 'idDemandePromotion';

    protected $fillable = [
        'Promotion',
        'Employe',
        'status',

    ];

    //Clé étrangère ici :

    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'Promotion', 'idPromotion');
    }

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'Employe', 'idEmploye');
    }
}
