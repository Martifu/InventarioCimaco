<?php

namespace App;

use App\Equipos;
use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'departamentos';
    public $timestamps = true;

    public function equipo() {
        return $this->hasMany(Equipos::class);
    }
}
