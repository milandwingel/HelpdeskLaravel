<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const USER = 'user';
    const EERSTELIJNSMEDEWERKERS = 'eerstelijnsmedewerkers';
    const TWEEDELIJNSMEDEWERKERS = 'tweedelijnsmedewerkers';
    const ADMIN = 'administrator';

    public function users(){
        return $this->hasMany('App\User');
    }



}
