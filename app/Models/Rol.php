<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    protected $table    = "roles";
    protected $fillable = [
        'nombre', 'created_at', 'updated_at'
    ];
    public $timestamps = false;

    public function empleados(){
        return $this->belongsToMany('App\Model\Empleado', 'empleado_rol');
    }
}
