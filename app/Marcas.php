<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'marcas';
    public $timestamps = false;

    public function equipo() {
        return $this->hasMany(Equipos::class);
    }
}
