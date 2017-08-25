@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <a href="{{route('fournisseurs.index')}}">
            <span class="fa-stack fa-2x">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-arrow-left fa-stack-1x fa-inverse"></i>
            </span>
           </a>

            <div class="panel panel-default">
                <div class="panel-heading">Ajoute Fournisseur</div><br>

                <form class="form-horizontal" role="form" method="POST" action="{{ route('fournisseurs.update',$fournisseur->id) }}">
                  <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
                        <label for="nom" class="col-md-4 control-label">Nom</label>

                        <div class="col-md-6">
                            <input id="nom" type="text" class="form-control" name="nom" value="{{$fournisseur->nom}}" placeholder="Fournisseur" disabled>

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
                            <input id="numTel" type="number" class="form-control" name="numTel" value="{{ $fournisseur->numTel }}" placeholder="Mobile" autofocus>

                            @if ($errors->has('numTel'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('numTel') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">Email</label>

                        <div class="col-md-6">
                            <input id="email" type="text" class="form-control" name="email" value="{{ $fournisseur->email }}" placeholder="E-mail">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary col-md-4">
                                Valider
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
