<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipos extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'tipos';
    public $timestamps = true;

    public function equipo() {
        return $this->hasMany(Equipos::class);
    }
}
