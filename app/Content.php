<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    public $timestamps = true;

    //
    protected $fillable = ['name', 'content'];

}