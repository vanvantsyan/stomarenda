<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductGroups extends Model
{
    protected $table = 'product_groups';
    protected $fillable = ['name','image'];
    public $timestamps = false;

}
