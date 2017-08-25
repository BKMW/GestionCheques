

<div class="col-md-8 col-md-offset-2">
  {{$fournisseurs->links()}}
  <div class="panel panel-default">

 <table class="table table-striped">
    <thead>
     <tr>
       <th>Nom</th>
       <th>Mobile</th>
       <th>Email</th>
       <th></th>
     </tr>
    </thead>
    <tbody>
      @foreach ($fournisseurs as $fournisseur)
        <tr>
           <td>{{$fournisseur->nom}}</td>
           <td>{{$fournisseur->numTel}}</td>
           <td>{{$fournisseur->email}}</td>
           <td>
             <a href="{{route('fournisseurs.edit',$fournisseur->id)}}"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
           </td>
         </tr>

      @endforeach
    </tbody>
</table>
</div>
{{$fournisseurs->links()}}
</div>
