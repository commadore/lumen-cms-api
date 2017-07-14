<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{


    public $timestamps = false;

    //
    protected $fillable = ['site','route','name','title', 'footer', 'published'];

     /**
     * Get the contents for the page.
     */
    public function contents()
    {
        return $this->hasMany('App\Content');
    }

    /**
    * Get the metadatas for the page.
    */
    public function metadatas()
    {
        return $this->hasMany('App\Metadata');
    }
}