<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Fournisseur;
use App\User;
use Auth;

class FournisseursController extends Controller
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
     public function index()
     {
       $fournisseurs=Fournisseur::orderBy('nom','asc')
       ->paginate(10);//->appends('nom', 'asc');//->sortBy('nom');
       return view('fournisseurs.index',['fournisseurs'=>$fournisseurs]);
     }

    public function search(Request $request)
    {

      if ($request->ajax()) {
        //$output="";
        $search=$request['search'];
        /*$fournisseurs=Search::search(
          "Fournisseur" ,
          'nom',
          $search ,
          null,
          ['id'  , 'asc'] ,
          true ,
          5
        );*/
       //return $search;
       $fournisseurs=DB::table('fournisseurs')->where('nom', 'like', '%'.$search.'%')->orderBy('nom','asc')->paginate(10);//->sortBy('nom');

       /*if ($fournisseurs) {
         foreach ($fournisseurs as $fournisseur) {
           $output.=  '<tr>'.
                         '<td>'.$fournisseur->nom.'</td>'.
                         '<td>'.$fournisseur->numTel.'</td>'.
                         '<td>'.$fournisseur->email.'</td>'.
                         '<td><a class="btn btn-primary" href="#" role="button">Edit</a></td>'.
                       '</tr>';

         }*/
         //$users->withPath('custom/url');

         return view('fournisseurs.search', ['fournisseurs'=>$fournisseurs]);
         //return esponse()->json(['data'=>$output]);

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
        return view('fournisseurs.store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, ['nom'=>'required|string|unique:fournisseurs|max:50',
                          ]);
      if ($request['numTel']!==null) {
        $this->validate($request, [ 'numTel'=>'string|max:8|min:8|unique:fournisseurs'
                            ]);
      }
      if ($request['email']) {
        $this->validate($request, [ 'email'=>'email|string|max:255|unique:fournisseurs'
                            ]);
      }



        Fournisseur::create($request->all());
        return redirect('/fournisseurs');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $fournisseur=Fournisseur::find($id);
        return view('fournisseurs.edit',['fournisseur'=>$fournisseur]);
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

      if ($request['numTel']!==null) {
        $this->validate($request, [ 'numTel'=>'string|max:8|min:8|unique:fournisseurs'
                            ]);
      }
      if ($request['email']) {
        $this->validate($request, [ 'email'=>'email|string|max:255|unique:fournisseurs'
                            ]);
      }
      $fournisseur = Fournisseur::find($id);
      $fournisseur->update([
          'numTel' => $request['numTel'],
          'email' => $request['email']
        ]);

      return redirect()->route('fournisseurs.index');
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
}
