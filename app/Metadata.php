<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metadata extends Model
{


    public $timestamps = false;

    //
    protected $fillable = ['page_id','key', 'value'];
    protected $table = 'metadatas';
}