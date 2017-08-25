<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carnet extends Model
{
  protected $fillable = [
       'numCarnet', 'user_id', 'numFeuilleDebut', 'numFeuilles', 'compteur', 'etat'
  ];
  public function cheques()
  {
      return $this->hasMany('App\Cheque');
  }
  public function user()
  {
      return $this->belongsTo('App\User');
  }
}
