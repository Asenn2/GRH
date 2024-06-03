<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeConge extends Model
{
    use HasFactory;

    protected $table = 'TypeConge';

    protected $primaryKey = 'idTypeConge'; 

    protected $fillable = [ 
        'NomType',
        'Desc',
        
    ];
    
         // Clé étrangère ailleurs : 
         
    public function conge(){

        return $this->hasMany(Conge::class);
    }
}
