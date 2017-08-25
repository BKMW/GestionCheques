<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
  protected $fillable = [
    'nom', 'numTel', 'email',
  ];

    public function cheques()
    {
        return $this->hasMany('App\Cheque');
    }
}
