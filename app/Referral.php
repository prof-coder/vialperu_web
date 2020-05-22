<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'referral_history';
    protected $fillable = [
        'user_id','referral_used_by','referral_discount','referral_status'
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
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function user_request()
    {
        return $this->belongsTo('App\UserRequests');
    }
}
