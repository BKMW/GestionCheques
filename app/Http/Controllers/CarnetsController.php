<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Carnet;
use App\User;
use Auth;
class CarnetsController extends Controller
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
    //  $carnets = User::find(Auth::id())->carnets->sortByDesc('id');
    //  $carnets = Auth::user()->carnets->sortByDesc('id');
    //$carnets = DB::table('carnets')->where('user_id',Auth::id())->paginate(5);
    $carnets = Carnet::where('user_id',Auth::id())->orderBy('id','desc')->paginate(10);
        return view('carnets.index',['carnets'=> $carnets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('carnets.store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, ['numCarnet'=>'required|integer',
	                               'numFeuilleDebut'=>'required|integer',
                                 'numFeuilles'=>'required|integer|max:255'
	                        ]);
      $check_numCarnet=Auth::user()->carnets->where('numCarnet',$request['numCarnet'])->first();
      if (isset($check_numCarnet)) {
        $this->validate($request, ['numCarnet'=>'required|integer|unique:carnets']);

      }else{
        $carnet_active = Auth::user()->carnets->where('etat','active')->first();
        if (!isset($carnet_active)) {
          $etat='active';
        }else{
          $etat='attent';
        }
          Carnet::create(['numCarnet' => $request['numCarnet'],
                          'user_id' => Auth::user()->id,
                          'numFeuilleDebut' => $request['numFeuilleDebut'],
                          'numFeuilles' => $request['numFeuilles'],
                          'compteur' => 0,
                          'etat' => $etat
                             ]);
        return redirect()->route('carnets.index');
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
      $carnet=Auth::user()->carnets->find($id);
        return view('carnets.edit',['carnet'=>$carnet]);
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
      $carnet = Auth::user()->carnets->find($id);
      $carnet->update([
          'numCarnet' => $request['numCarnet'],
          'numFeuilleDebut' => $request['numFeuilleDebut'],
          'numFeuilles' => $request['numFeuilles']
        ]);

      return redirect()->route('carnets.index');
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
