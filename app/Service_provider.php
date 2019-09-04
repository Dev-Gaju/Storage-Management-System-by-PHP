<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Service_provider extends Authenticatable
{

	use Notifiable;

	protected $guard = 'service_provider';

    protected $fillable = [
        'name', 'email', 'password',
    ];
   
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function social_networks(){
    	return $this->hasMany(Social_network::class);
    }
    protected function posts(){
    	return $this->hasMany(Post::class);
    }
    protected function booking_codes(){
    	return $this->hasMany(Booking_code::class);
    }
}
