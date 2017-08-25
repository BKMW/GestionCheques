@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <a href="{{route('home')}}">
            <span class="fa-stack fa-2x">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-arrow-left fa-stack-1x fa-inverse"></i>
            </span>
           </a>

            <div class="panel panel-default">
                <div class="panel-heading">Nouveau Chèque</div>
                <br>
                <form class="form-horizontal" role="form" method="POST" action="{{ route('cheques.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
                        <label for="nom" class="col-md-3 control-label">Fournisseur</label>
                        <div class="col-md-6">
                            <select class="col-md-6" name="nom">
                              @foreach ($fournisseurs as $fournisseur)
                                <option value={{$fournisseur->id}}>{{$fournisseur->nom}}</option>
                              @endforeach
                            </select>

                            @if ($errors->has('nom'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nom') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('montantChiffre') ? ' has-error' : '' }}">
                        <label for="montantChiffre" class="col-md-3 control-label">Montant Chifre</label>

                        <div class="col-md-8">
                            <input id="montantChiffre" type="number" step=0.001 class="form-control" name="montantChiffre" value="{{ old('montantChifre') }}" required autofocus>

                            @if ($errors->has('montantChiffre'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('montantChiffre') }}</strong>
                                </span>
                            @endif
                        </div>


                    </div>
                    <div class="form-group{{ $errors->has('montantLettre') ? ' has-error' : '' }}">
                        <label for="montantLettre" class="col-md-3 control-label">Montant Lettre</label>

                        <div class="col-md-8">
                            <input id="montantLettre" type="text" class="form-control" name="montantLettre" value="{{ old('montantLettre') }}" required autofocus>


                            @if ($errors->has('montantLettre'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('montantLettre') }}</strong>
                                </span>
                            @endif
                        </div>


                    </div>


                  <div class="form-group{{ $errors->has('typeCheque') ? ' has-error' : '' }}">
                      <label for="typeCheque" class="col-md-3 control-label">Type De Cheque</label>

                      <div class="col-md-8 btn-group" data-toggle="buttons">
                        <label class="btn btn-default col-md-6">
                          <input type="radio" name="typeCheque" value="cheque" required> Chèque
                        </label>
                        <label class="btn btn-default col-md-6">
                          <input type="radio"  name="typeCheque" value="kembial" required> Kembial
                        </label>
                          @if ($errors->has('typeCheque'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('typeCheque') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>
                  <div class="form-group{{ $errors->has('dateEcheance') ? ' has-error' : '' }}">
                      <label for="dateEcheance" class="col-md-3 control-label">Date D'échéance</label>

                      <div class="col-md-8">
                          <input id="dateEcheance" type="date" class="form-control" name="dateEcheance" value="{{ old('dateEcheance') }}" required autofocus>

                          @if ($errors->has('dateEcheance'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('dateEcheance') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                    <div class="form-group{{ $errors->has('label') ? ' has-error' : '' }}">
                        <label for="label" class="col-md-3 control-label">Label</label>

                        <div class="col-md-8">
                            <textarea id="label" class="form-control" name="label" rows="3" cols="50" value="{{ old('label') }}"required></textarea>

                            @if ($errors->has('label'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('label') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
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
<script type="text/javascript">

$('button').on('click',function(){
  if( !confirm('Please vérifiez vos informations ! es tu  sure ? ') )
           event.preventDefault();

});



  $('#montantChiffre').on('keyup',function(){

    $montantChiffre=$(this).val();

    //alert($montantChiffre);
$.ajax({
url:'{{route("cheques.chifre_en_lettre")}}',
type:'get',
dataType:'html',
data:{'montant':$montantChiffre},
success:function(response){
$('#montantLettre').val(response);
//alert(response);
}
});
return false;
});
</script>

@endsection
