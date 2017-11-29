<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CallQueries extends Model
{
    protected $table = 'call_me_back';
    protected $fillable = ['name','tel','status','seen'];
    public $timestamps = true;

}
