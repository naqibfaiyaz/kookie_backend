<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class BackOfficeUsers extends Authenticatable
{
    use Notifiable;

    protected $table = 'backofficeusers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','username','email', 'passcode','active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'passcode', 'remember_token',
    ];


    public function getAuthPassword()
    {
      return $this->passcode;
    }
}
