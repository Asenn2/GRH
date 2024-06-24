<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeStage extends Model
{
    use HasFactory;

    protected $table = 'DemandeStage';

    protected $primaryKey = 'idDemandeStage';

    protected $fillable = [
        'idStage',
        'idStageCandidat',
        'Motivation',
        'status'

    ];

    //Clé étrangère ici :

    public function stage()
    {
        return $this->belongsTo(Stage::class, 'idStage', 'idStage');
    }

    public function stagecandidat()
    {
        return $this->belongsTo(StageCandidat::class, 'idStageCandidat', 'idStageCandidat');
    }
}
