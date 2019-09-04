<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
     protected function users(){
    	return $this->belongsTo(User::class);
    }
    
     protected function user(){
    	return $this->belongsTo(User::class);
    }

     protected function posts(){
    	return $this->belongsTo(Post::class);
    }
     protected function post(){
    	return $this->belongsTo(Post::class);
    }
    
    
     protected function booking_code(){
    	return $this->hasOne(Booking_code::class);
    }
}
