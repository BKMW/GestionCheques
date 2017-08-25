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
<script type="text/javascript">
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

</script>
