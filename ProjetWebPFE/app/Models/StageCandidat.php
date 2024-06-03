<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StageCandidat extends Model
{
    use HasFactory;

    protected $table = 'StageCandidat';

    protected $primaryKey = 'idStageCandidat';

    protected $fillable = [
        'nom',
        'prenom',
        'Mail',
        'Cv',
    ];

    public function demandeStage()
    {

        return $this->hasMany(DemandeStage::class);
    }
}
