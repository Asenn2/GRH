<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TacheStage extends Model
{
    use HasFactory;

    protected $table = 'tacheStage';
    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = [
        'contenu',
        'idStagiaire',
        'status'
    ];

    // Clé étrangère ici :

    public function stagiaire()
    {
        return $this->belongsTo(Stagiaire::class, 'idStagiaire', 'idStagiaire');
    }
}
