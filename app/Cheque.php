<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{
  protected $fillable = [
    'numCheque', 'user_id', 'carnet_id', 'fournisseur_id', 'dateEcheance', 'dateSortie', 'montantChiffre', 'montantLettre', 'typeCheque', 'etatCheque', 'imprimer', 'label'
  ];

    public function cheques()
    {
        return $this->hasMany('App\Cheque');
    }
    public function carnet()
    {
        return $this->belongsTo('App\Carnet');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
