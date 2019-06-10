<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'roles';
    public $timestamps = false;

    public function user() {
        return $this->hasMany(User::class);
    }
}
