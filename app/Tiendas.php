<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tiendas extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'tiendas';
    public $timestamps = false;

    public function equipo() {
        return $this->hasMany(Equipos::class);
    }
}
