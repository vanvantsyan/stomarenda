<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelatedProducts extends Model
{
    protected $table = 'related_products';
    protected $fillable = ['name','model','manufacturer_id','group_id','price','image'];
    public $timestamps = true;

}