<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

    public function calendar()
    {
        return $this->morphTo();
    }
}   
