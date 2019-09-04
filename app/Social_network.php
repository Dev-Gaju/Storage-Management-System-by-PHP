<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social_network extends Model
{
    protected function service_provider(){
    	return $this->belongsTo(Service_provider::class);
    }

    protected function user(){
    	return $this->belongsTo(User::class);
    }
}
