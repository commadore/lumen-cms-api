<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{

    public $timestamps = true;

    //
    protected $fillable = ['name', 'site_id'];


    /**
    * Get the zones for the page.
    */
    public function zones()
    {
        return $this->hasMany('App\Zone');
    }
}