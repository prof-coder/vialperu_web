<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Redeem extends Model
{
    
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'redeem_transaction';
    protected $fillable = [
        'user_id','redeem_point','redeem_amount'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
 
}
