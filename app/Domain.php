<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $connection = 'mysql_core';

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}