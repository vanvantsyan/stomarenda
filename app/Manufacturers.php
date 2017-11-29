<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturers extends Model
{
    protected $table = 'manufacturers';
    protected $fillable = ['name','country','information','image'];
    public $timestamps = false;

}
