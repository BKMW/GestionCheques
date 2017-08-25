<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
          'numCompte',  'prenom', 'nom', 'numTel', 'email',  'lieu',  'gender', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function carnets()
   {
       return $this->hasMany('App\Carnet');
   }
   public function cheques()
   {
       return $this->hasMany('App\Cheque');
   }
}
