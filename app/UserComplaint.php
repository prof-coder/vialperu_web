<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserComplaint extends Model
{
    
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $table = 'user_complaints';
     protected $fillable = [
        'complaint_type',
        'description',
        'user_id',
        'booking_id',
        'provider_id'
       
    ];

   
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    	 
}
