<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipos extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'equipos';
    public $timestamps = false;
}
