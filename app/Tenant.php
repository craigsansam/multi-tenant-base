<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $connection = 'mysql_core';

    public function domains()
    {
        return $this->hasMany(Domain::class);
    }

    public function getDatabaseNameAttribute()
    {
        return $this->slug;
    }
}