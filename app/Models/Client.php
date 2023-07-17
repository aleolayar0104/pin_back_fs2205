<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use SoftDeletes;
    protected $table = 'clients';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'apellido', 'correo', 'celular', 'mensaje'];
}