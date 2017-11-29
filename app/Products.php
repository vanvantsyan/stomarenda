<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $fillable = ['name','category_id','type','manufacturer_id','group_id','meta_description','slug','title','image','model','price','description','attributes','delivery','about_brand'];
    public $timestamps = true;

}
