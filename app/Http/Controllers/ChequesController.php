<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Fournisseur;
use App\Cheque;
use Auth;

class ChequesController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
         //$cheques = Auth::user()->cheques->sortByDesc('id');
         $cheques=DB::table('cheques')->where('user_id', Auth::id())->orderBy('id','desc')->paginate(10);
        return view('cheques.index',['cheques'=>$cheques]);
         if ($request->ajax()) {
          return view('cheques.search', ['cheques'=>$cheques])->render();
          }
     }

     public function search(Request $request)
     {
       if ($request->ajax()) {
         $search=$request['search'];
         if (!$search) {
           $search='%';
         }
         $etatCheque=$request['etatCheque'];
         $from=$request['from'].' 00:00:00';
         $to=$request['to'].' 23:59:59';
         if ($etatCheque=='circulation') {
           $option='created_at';
         }else {
           $option='updated_at';
         }
         if (!$etatCheque) {
           $cheques=DB::table('cheques')->where('user_id', Auth::id())->where('numCheque', 'like', '%'.$search.'%')
           ->whereBetween($option, [$from,$to])->orderBy($option,'desc')->paginate(1000);

         }else {
           $cheques=DB::table('cheques')->where('user_id', Auth::id())->where('numCheque', 'like', '%'.$search.'%')
           ->where('etatCheque', $etatCheque)->whereBetween($option, [$from,$to])->orderBy($option,'desc')->paginate(1000);
         }

         //if ($request->ajax()) {
          return view('cheques.search', ['cheques'=>$cheques])->render();
                  //}
        }
     }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $carnet_active=Auth::user()->carnets->where('etat','active')->first();
      if (!isset($carnet_active)) {
        return view ('cheques.error');
       }else{
        $fournisseurs=Fournisseur::orderBy('nom','asc')->get();
        return view('cheques.store',['fournisseurs'=>$fournisseurs]);
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
      $this->validate($request, ['montantChiffre'=>'required',
                                 'label'=>'required|string|max:200'
	                        ]);
      $carnet_active=Auth::user()->carnets->where('etat','active')->first();
      if ($carnet_active) {
        $carnet_id=$carnet_active->id;

           $numCheque=$carnet_active->numFeuilleDebut+$carnet_active->compteur;
           $montantChiffre=$request['montantChiffre'];
           $montantLettre=$request['montantLettre'];

            $cheque=Cheque::create(['numCheque' => $numCheque,
                            'user_id' => Auth::user()->id,
                            'carnet_id' => $carnet_id,
                            'fournisseur_id' => $request['nom'],
                            'dateEcheance' => $request['dateEcheance'],
                            'montantChiffre' => $montantChiffre,
                            'montantLettre' => $montantLettre,
                            'typeCheque' => $request['typeCheque'],
                            'label' => $request['label']
          ]);
             $carnet_active->increment('compteur');
             $end_compteur=$carnet_active->numFeuilles;
      }else {
        return view ('cheques.error');
      }


        if ($carnet_active->compteur==$end_compteur) {
          $carnet_active->update(['etat'=>'complet']);

          $carnet_active=Auth::user()->carnets->where('etat','attent')->first();
        if ($carnet_active) {
          $carnet_active->update(['etat'=>'active']);
        }

      }
      $id=$request['nom'];
        $fournisseur=Fournisseur::find($id);
         if ($cheque->imprimer==0) {
           $cheque->update(['imprimer' => 1]);
           return view('cheques.imprimer',['cheque'=>$cheque, 'fournisseur'=>$fournisseur]);
         }else {
           return redirect ('cheques/create');
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      $cheque= Cheque::find($id);

      $id=$cheque->fournisseur_id;
        $fournisseur= Fournisseur::find($id);

        return view('cheques.view',['cheque'=>$cheque, 'fournisseur'=>$fournisseur]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      if ($request->ajax()) {
        $cheque= Cheque::find($id);
        $date=date('Y-m-d H:i:s');
        $cheque->update([
            'etatCheque'=>$request['etatCheque'],
            'dateSortie'=>$date
          ]);
          return 'Success';
      }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function chifre_en_lettre(Request $request, $devise1='', $devise2='')
    {
        if ($request->ajax()) {
      $montant=$request['montant'];
        if(empty($devise1)) $dev1='Dinars';
        else $dev1=$devise1;
        if(empty($devise2)) $dev2='Mellimes';
        else $dev2=$devise2;
        $valeur_entiere=intval($montant);
        $valeur_decimal=intval(round($montant-intval($montant), 3)*1000);
        $dix_c=intval($valeur_decimal%100/10);
        $cent_c=intval($valeur_decimal%1000/100);
        $unite[1]=$valeur_entiere%10;
        $dix[1]=intval($valeur_entiere%100/10);
        $cent[1]=intval($valeur_entiere%1000/100);
        $unite[2]=intval($valeur_entiere%10000/1000);
        $dix[2]=intval($valeur_entiere%100000/10000);
        $cent[2]=intval($valeur_entiere%1000000/100000);
        $unite[3]=intval($valeur_entiere%10000000/1000000);
        $dix[3]=intval($valeur_entiere%100000000/10000000);
        $cent[3]=intval($valeur_entiere%1000000000/100000000);
        $chif=array('', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf', 'dix', 'onze', 'douze', 'treize', 'quatorze', 'quinze', 'seize', 'dix sept', 'dix huit', 'dix neuf');
            $secon_c='';
            $trio_c='';
        for($i=1; $i<=3; $i++){
            $prim[$i]='';
            $secon[$i]='';
            $trio[$i]='';
            if($dix[$i]==0){
                $secon[$i]='';
                $prim[$i]=$chif[$unite[$i]];
            }
            else if($dix[$i]==1){
                $secon[$i]='';
                $prim[$i]=$chif[($unite[$i]+10)];
            }
            else if($dix[$i]==2){
                if($unite[$i]==1){
                $secon[$i]='vingt et';
                $prim[$i]=$chif[$unite[$i]];
                }
                else {
                $secon[$i]='vingt';
                $prim[$i]=$chif[$unite[$i]];
                }
            }
            else if($dix[$i]==3){
                if($unite[$i]==1){
                $secon[$i]='trente et';
                $prim[$i]=$chif[$unite[$i]];
                }
                else {
                $secon[$i]='trente';
                $prim[$i]=$chif[$unite[$i]];
                }
            }
            else if($dix[$i]==4){
                if($unite[$i]==1){
                $secon[$i]='quarante et';
                $prim[$i]=$chif[$unite[$i]];
                }
                else {
                $secon[$i]='quarante';
                $prim[$i]=$chif[$unite[$i]];
                }
            }
            else if($dix[$i]==5){
                if($unite[$i]==1){
                $secon[$i]='cinquante et';
                $prim[$i]=$chif[$unite[$i]];
                }
                else {
                $secon[$i]='cinquante';
                $prim[$i]=$chif[$unite[$i]];
                }
            }
            else if($dix[$i]==6){
                if($unite[$i]==1){
                $secon[$i]='soixante et';
                $prim[$i]=$chif[$unite[$i]];
                }
                else {
                $secon[$i]='soixante';
                $prim[$i]=$chif[$unite[$i]];
                }
            }
            else if($dix[$i]==7){
                if($unite[$i]==1){
                $secon[$i]='soixante et';
                $prim[$i]=$chif[$unite[$i]+10];
                }
                else {
                $secon[$i]='soixante';
                $prim[$i]=$chif[$unite[$i]+10];
                }
            }
            else if($dix[$i]==8){
                if($unite[$i]==1){
                $secon[$i]='quatre-vingts et';
                $prim[$i]=$chif[$unite[$i]];
                }
                else {
                $secon[$i]='quatre-vingt';
                $prim[$i]=$chif[$unite[$i]];
                }
            }
            else if($dix[$i]==9){
                if($unite[$i]==1){
                $secon[$i]='quatre-vingts et';
                $prim[$i]=$chif[$unite[$i]+10];
                }
                else {
                $secon[$i]='quatre-vingts';
                $prim[$i]=$chif[$unite[$i]+10];
                }
            }
            if($cent[$i]==1) $trio[$i]='cent';
            else if($cent[$i]!=0 || $cent[$i]!='') $trio[$i]=$chif[$cent[$i]] .' cents';
        }


    $chif2=array('', 'dix', 'vingt', 'trente', 'quarante', 'cinquante', 'soixante', 'soixante-dix', 'quatre-vingts', 'quatre-vingts dix');
        $secon_c=$chif2[$dix_c];
        if($cent_c==1) $trio_c='cent';
        else if($cent_c!=0 || $cent_c!='') $trio_c=$chif[$cent_c] .' cents';

        if(($cent[3]==0 || $cent[3]=='') && ($dix[3]==0 || $dix[3]=='') && ($unite[3]==1))
            echo $trio[3]. '  ' .$secon[3]. ' ' . $prim[3]. ' million ';
        else if(($cent[3]!=0 && $cent[3]!='') || ($dix[3]!=0 && $dix[3]!='') || ($unite[3]!=0 && $unite[3]!=''))
            echo $trio[3]. ' ' .$secon[3]. ' ' . $prim[3]. ' millions ';
        else
            echo $trio[3]. ' ' .$secon[3]. ' ' . $prim[3];

        if(($cent[2]==0 || $cent[2]=='') && ($dix[2]==0 || $dix[2]=='') && ($unite[2]==1))
            echo ' mille ';
        else if(($cent[2]!=0 && $cent[2]!='') || ($dix[2]!=0 && $dix[2]!='') || ($unite[2]!=0 && $unite[2]!=''))
            echo $trio[2]. ' ' .$secon[2]. ' ' . $prim[2]. ' milles ';
        else
            echo $trio[2]. ' ' .$secon[2]. ' ' . $prim[2];

        echo $trio[1]. ' ' .$secon[1]. ' ' . $prim[1];

        echo ' '. $dev1 .' ' ;

        if(($cent_c=='0' || $cent_c=='') && ($dix_c=='0' || $dix_c==''))
            echo ' zero  '. $dev2;
        else
            echo $trio_c. ' ' .$secon_c. ' ' . $dev2;
          }

    }
    public function error()
    {
      return view ('cheques.error');

    }



}
