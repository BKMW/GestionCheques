@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('numCompte') ? ' has-error' : '' }}">
                            <label for="numCompte" class="col-md-4 control-label">Numéro De Compte</label>

                            <div class="col-md-6">
                                <input id="numCompte" type="text" class="form-control" name="numCompte" value="{{ old('numCompte') }}" required autofocus >

                                @if ($errors->has('numCompte'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('numCompte') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('prenom') ? ' has-error' : '' }}">
                            <label for="prenom" class="col-md-4 control-label">Prénom</label>

                            <div class="col-md-6">
                                <input id="prenom" type="text" class="form-control" name="prenom" value="{{ old('prenom') }}" required autofocus>

                                @if ($errors->has('prenom'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('prenom') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
                            <label for="nom" class="col-md-4 control-label">Nom</label>

                            <div class="col-md-6">
                                <input id="nom" type="text" class="form-control" name="nom" value="{{ old('nom') }}" required  autofocus>

                                @if ($errors->has('nom'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nom') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('numTel') ? ' has-error' : '' }}">
                            <label for="numTel" class="col-md-4 control-label">Mobile</label>

                            <div class="col-md-6">
                                <input id="numTel" type="text" class="form-control" name="numTel" value="{{ old('numTel') }}" required autofocus>

                                @if ($errors->has('numTel'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('numTel') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('lieu') ? ' has-error' : '' }}">
                          <label for="lieu" class="col-md-4 control-label">lieu</label>

                          <div class="col-md-6">
                              <input id="lieu" type="text" class="form-control" name="lieu" value="{{ old('lieu') }}" required autofocus>

                              @if ($errors->has('lieu'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('lieu') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                          <label for="gender" class="col-md-4 control-label">Gender</label>

                          <div class="col-md-6 btn-group" data-toggle="buttons">
                           <label class="">
                              <input type="radio" name="gender" value="male" required checked> Male
                           </label>
                           <label class="">
                              <input type="radio"  name="gender" value="female" required> Female
                            </label>
                              @if ($errors->has('gender'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('gender') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary col-md-4">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
