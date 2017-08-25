@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <a href="{{route('carnets.index')}}">
            <span class="fa-stack fa-2x">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-arrow-left fa-stack-1x fa-inverse"></i>
            </span>
           </a>

            <div class="panel panel-default">
                <div class="panel-heading">Ajoute Carnet</div><br>
                <form class="form-horizontal" role="form" method="POST" action="{{ route('carnets.store') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('numCarnet') ? ' has-error' : '' }}">
                        <label for="numCarnet" class="col-md-4 control-label">Numéro De Carnet</label>

                        <div class="col-md-6">
                            <input id="numCarnet" type="number" class="form-control" name="numCarnet" value="{{ old('numCarnet') }}" placeholder="Numéro De Carnet" required  autofocus>

                            @if ($errors->has('numCarnet'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('numCarnet') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('numFeuilleDebut') ? ' has-error' : '' }}">
                        <label for="numFeuilleDebut" class="col-md-4 control-label">Numéro De Première Feuille</label>

                        <div class="col-md-6">
                            <input id="numFeuilleDebut" type="number" class="form-control" name="numFeuilleDebut" value="{{ old('numFeuilleDebut') }}" placeholder="Numéro De Première Feuille" required>

                            @if ($errors->has('numFeuilleDebut'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('numFeuilleDebut') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('numFeuilles') ? ' has-error' : '' }}">
                        <label for="numFeuilles" class="col-md-4 control-label">Numéro Des Feuilles</label>

                        <div class="col-md-6">
                            <input id="numFeuilles" type="number" class="form-control" name="numFeuilles" value="{{ old('numFeuilles') }}" placeholder="Numéro Des Feuilles" required>

                            @if ($errors->has('numFeuilles'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('numFeuilles') }}</strong>
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
