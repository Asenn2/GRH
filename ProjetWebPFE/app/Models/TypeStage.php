<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeStage extends Model
{
    use HasFactory;

    protected $table = 'TypeStage';

    protected $primaryKey = 'idTypeStage'; 

    protected $fillable = [ 
        'NomType',
        'Desc',
        
    ];
    
         // Clé étrangère ailleurs : 
         
    public function stage(){

        return $this->hasMany(Stage::class);
    }
}
