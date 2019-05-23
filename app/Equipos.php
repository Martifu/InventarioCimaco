<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipos extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'equipos';
    public $timestamps = false;

    public function departamento() {
        return $this->belongsTo(Departamentos::class,'id_departamento');
    }

    public function marca() {
        return $this->belongsTo(Marcas::class,'id_marca');
    }

    public function proveedor() {
        return $this->belongsTo(Proveedores::class,'id_proveedor');
    }

    public function tienda() {
        return $this->belongsTo(Tiendas::class,'id_tienda');
    }

    public function tipo() {
        return $this->belongsTo(Tipos::class,'id_tipo');
    }
}
