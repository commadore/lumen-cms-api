<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{


    public $timestamps = false;

    protected $hidden = ['created_at', 'updated_at', 'layout_id'];
    //
    protected $fillable = ['name'];

    public function layout()
    {
        return $this->belongsTo('App\Layout');
    }

}