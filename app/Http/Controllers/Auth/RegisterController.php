<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'numCompte' => 'required|integer',
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'numTel' => 'required|string|unique:users|min:8|max:8',
            'email' => 'required|string|email|max:255|unique:users',
            'lieu' => 'required|string|max:255',
            'gender' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'numCompte' => $data['numCompte'],
            'prenom' => ucfirst($data['prenom']),
            'nom' => ucfirst($data['nom']),
            'numTel' => $data['numTel'],
            'email' => $data['email'],
            'lieu' => ucfirst($data['lieu']),
            'gender' => $data['gender'],
            'password' => bcrypt($data['password']),
        ]);
      // return redirect('/cheques');
    }
}
