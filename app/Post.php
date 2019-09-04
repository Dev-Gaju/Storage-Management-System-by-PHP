<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected function service_provider(){
    	return $this->belongsTo(Service_provider::class);
    }

     protected function bookings(){
    	return $this->hasMany(Booking::class);
    }
    
      protected function booking(){
    	return $this->hasOne(Booking::class);
    }

    protected function images(){
    	return $this->hasMany(Image::class);
    }
}
