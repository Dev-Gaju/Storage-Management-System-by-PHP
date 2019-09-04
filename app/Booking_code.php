<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking_code extends Model
{
    protected function service_provider(){
    	return $this->belongsTo(Service_provider::class);
    }

   /* protected function booking(){
    	return $this->belongsTo(Booking::class);
    }*/
}
