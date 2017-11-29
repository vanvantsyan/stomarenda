<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $table = 'files';
    protected $fillable = ['name','path','product_id'];
    public $timestamps = false;
}
