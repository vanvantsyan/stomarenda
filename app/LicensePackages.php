<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LicensePackages extends Model
{
    protected $table = 'license_packages';
    protected $fillable = ['name','information','price','image','slug','title','meta_description'];
    public $timestamps = false;

}
