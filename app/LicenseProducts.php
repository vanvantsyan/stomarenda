<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LicenseProducts extends Model
{
    protected $table = 'license_products';
    protected $fillable = ['type_name','product_info','image','meta_description','slug','title',];
    public $timestamps = false;

}
