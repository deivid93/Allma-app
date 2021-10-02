<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $table    = "empleado";
    protected $fillable = [
        'nombre', 'email', 'sexo','area_id', 'boletin', 'descripcion'
    ];
    public $timestamps = false;

    public function area(){
        return $this->belongsTo('App\Models\Area');
    }

    public function roles(){
        return $this->belongsToMany('App\Models\Rol', 'empleado_rol');
    }

}
