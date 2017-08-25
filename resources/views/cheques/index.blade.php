@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <a href="{{route('cheques.create')}}" class="col-md-offset-11">
            <span class="fa-stack fa-2x">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
            </span>
          </a>


  <!--======================================================================================================-->
                  <div class="form-group">

                    <label for="from" class="col-md-4 control-label"></label>
                       <div class="col-md-6">
                        <div class="input-group">

                          <input type="number" class="form-control" id="search" name="search" value="{{old('search')}}" placeholder="Search By Numero De Cheque...">
                          <span class="input-group-addon">
                          <i class="fa fa-search" aria-hidden="true"></i></span>

                          </div>
                        </div>
                    </div><br>
                    <br>
                    <div class="form-group">
                        <label for="etatCheque" class="col-md-4 control-label">Etat De Chèque</label>

                        <div class="col-md-6 btn-group" data-toggle="buttons">
                          <label class="btn btn-success col-md-4">
                            <input type="radio" name="etatCheque" value="circulation"> Circulation
                          </label>
                          <label class="btn btn-primary col-md-4">
                            <input type="radio"  name="etatCheque" value="sortie"> Sortie
                          </label>
                          <label class="btn btn-default col-md-4">
                            <input type="radio"  name="etatCheque" value="annuler"> Annulé
                          </label>

                        </div>
                    </div>
                    <br>

                    <div class="form-group{{ $errors->has('from') ? ' has-error' : '' }}">
                        <label for="from" class="col-md-4 control-label">Du</label>

                        <div class="col-md-6">
                            <input id="from" type="date" class="form-control" name="from" value="{{date('Y').'-01-01'}}">

                            @if ($errors->has('from'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('from') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <br>

                    <div class="form-group{{ $errors->has('to') ? ' has-error' : '' }}">
                        <label for="to" class="col-md-4 control-label">Au</label>

                        <div class="col-md-6">
                            <input id="to" type="date" class="form-control" name="to" value="{{date('Y-m-d')}}">

                            @if ($errors->has('to'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('to') }}</strong>
                                </span>
                            @endif
                        </div>

                  </div>

                </div>

              </div>

        <!--======================================================================================================-->

      <div id="table" class="row">
          <div class="col-md-8 col-md-offset-2">
            {{$cheques->links()}}
              <div class="panel panel-default">
                <table class="table table-striped">
                   <thead>
                    <tr>
                      <th>Numero De Cheque</th>
                      <th>Montant En Dinars</th>
                      <th>Date D'échéance</th>
                      <th>Type</th>
                      <th>Action/Date Sortie</th>
                      <th></th>

                    </tr>
                   </thead>
                   <tbody>
                     @foreach ($cheques as $cheque)
                        <tr>
                                   <td>{{$cheque->numCheque}}</td>
                                   <td>{{$cheque->montantChiffre}}</td>
                                   <td>{{$cheque->dateEcheance}}</td>
                                   <td>{{$cheque->typeCheque}}</td>
                                   <td>
                                     @if ($cheque->etatCheque=='circulation')
                                       <div class="btn-group" data-toggle="buttons">
                                           <label class="btn btn-primary btn-sm col-md-6">
                                             <input class="etat" type="radio" name="{{route('cheques.update',$cheque->id)}}" value="sortie"> Sortie
                                           </label>
                                           <label class="btn btn-default btn-sm col-md-6">
                                           <input class="etat" type="radio" name="{{route('cheques.update',$cheque->id)}}" value="annuler" > Annulé
                                         </label>

                                       </div>
                                     @else
                                       {{$cheque->dateSortie}}
                                     @endif
                                   </td>
                                   <td>

                                       <a class="btn btn-link btn-sm" href="{{route('cheques.show',$cheque->id)}}"> Vue</a>

                                   </td>
                        </tr>
                     @endforeach

                   </tbody>
               </table>

            </div>
            {{$cheques->links()}}
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {

  $('#search').on('keyup',function(){

    $search=$(this).val();
    $etatCheque=$('input[name=etatCheque]:checked').val();
    $from=$('input[name=from]').val();
    $to=$('input[name=to]').val();
    //alert($etatCheque);
$.ajax({
url:'{{route("cheques.search")}}',
type:'get',
dataType:'html',
data:{'search':$search,'etatCheque':$etatCheque,'from':$from,'to':$to},
success:function(response){
$('#table').html(response);
}
});
return false;
});

  $('input[name=etatCheque]:radio').on('change',function(){

    $etatCheque=$(this).val();
    $search=$('#search').val();
    $from=$('input[name=from]').val();
    $to=$('input[name=to]').val();


    //alert($etatCheque);
$.ajax({
url:'{{route("cheques.search")}}',
type:'get',
dataType:'html',
data:{'search':$search,'etatCheque':$etatCheque,'from':$from,'to':$to},
success:function(response){
$('#table').html(response);
}
});
return false;
});
$('input[name=from]').on('change',function(){
  $from=$(this).val();
  $search=$('#search').val();
  $etatCheque=$('input[name=etatCheque]:checked').val();
  $to=$('input[name=to]').val();
//alert($from+' 00:00:00');
$.ajax({
url:'{{route("cheques.search")}}',
type:'get',
dataType:'html',
data:{'search':$search,'etatCheque':$etatCheque,'from':$from,'to':$to},
success:function(response){
$('#table').html(response);
}
});
return false;
});
$('input[name=to]').on('change',function(){
  $to=$(this).val();
  $search=$('#search').val();
  $etatCheque=$('input[name=etatCheque]:checked').val();
  $from=$('input[name=from]').val();
  //alert($to+' 00:00:00');
$.ajax({
url:'{{route("cheques.search")}}',
type:'get',
dataType:'html',
data:{'search':$search,'etatCheque':$etatCheque,'from':$from,'to':$to},
success:function(response){
$('#table').html(response);
}
});
return false;
});
$('.etat').on('change',function(){
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
