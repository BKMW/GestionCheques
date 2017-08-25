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

                <div class="panel-heading">Numero De Chèque: {{$cheque->numCheque}}</div>
                  </div>
                </div>


                    <div class="col-md-8 col-md-offset-2">

                        <div class="panel panel-default">
                          <table class="table table-striped">
                    <tr>
                      <td class="col-md-4">Montant</td>
                      <td>{{$cheque->montantChiffre}}</td>
                    </tr>
                    <tr>
                      <td>Fournisseur</td>
                      <td>{{$fournisseur->nom}}</td>
                    </tr>
                    <tr>
                      <td>Type De Chèque</td>
                      <td>{{$cheque->typeCheque}}</td>
                    </tr>
                    <tr>
                      <td>Date D'échéance</td>
                      <td>{{$cheque->dateEcheance}}</td>
                    </tr>
                    <tr>
                      <td>Label</td>
                      <td>{{$cheque->label}}</td>
                    </tr>
                      </table>

 </div>
@if ($cheque->etatCheque=='circulation')
  <div class="btn-group col-md-4">
      <input class="etat btn btn-primary col-md-6" type="button" name="{{route('cheques.update',$cheque->id)}}" value="annuler" >
      <input class="etat btn btn-primary col-md-6" type="button" name="{{route('cheques.update',$cheque->id)}}" value="sortie">
  </div>
@endif

</div>
        </div>

    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
$('.etat').on('click',function(){
  $etatCheque=$(this).attr('value');
  $url=$(this).attr('name');
  //alert($url);
$.ajax({
url:$url,
type:'put',
dataType:'html',
data:{_token:'{{csrf_token()}}','etatCheque':$etatCheque},
success:function(response){
alert(response);
}
});
return false;
});

return false;
});

</script>

@endsection
