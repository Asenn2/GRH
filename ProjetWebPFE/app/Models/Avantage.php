<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avantage extends Model
{
    use HasFactory;

    protected $table = 'Avantage';

    protected $primaryKey = 'idAvantage';


    protected $fillable = ['nom', 'description'];

    public function contrats()
    {
        return $this->belongsToMany(Contrat::class, 'contrat_avantage');
    }
}
