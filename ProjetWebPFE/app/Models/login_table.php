<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class login_table extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'login_table';

    protected $primaryKey = 'idlogin_table';

    public $timestamps = false;

    protected $fillable = [
        'email',
        'password',
        'role',
    ];
}
