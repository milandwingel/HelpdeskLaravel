<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    const EERSTELIJN = 'eerstelijn';
    const EERSTELIJN_TOEGEWEZEN = 'eerstelijn toegewezen';
    const TWEEDELIJN = 'tweedelijn';
    const TWEEDELIJN_TOEGEWEZEN = 'tweedelijn toegewezen';
    const AFGEHANDELD = 'afgehandeld';

    public function tickets(){
        return $this->hasMany('App\Ticket');
    }

}
