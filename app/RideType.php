<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RideType extends Model
{

     protected $fillable = [
        'name',
        'icon',
        'status'
    ];
    
    
    protected $hidden = [
         'created_at', 'updated_at'
    ];

}
