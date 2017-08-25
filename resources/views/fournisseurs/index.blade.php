@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <a href="{{route('fournisseurs.create')}}" class="col-md-offset-11">
            <span class="fa-stack fa-2x">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
            </span>
          </a>

                <div class="form-group">

                  <label for="from" class="col-md-3 control-label"></label>
                     <div class="col-md-6">
                      <div class="input-group">

                        <input type="text" class="form-control" id="search" name="search" value="{{old('search')}}" placeholder="Search By Nom..." autofocus>
                        <span class="input-group-addon">
                        <i class="fa fa-search" aria-hidden="true"></i></span>
                        </div>

                  </div>
                </div>

              </div>

          </div>
          <br>


              <div class="row" id="table-f">
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

    </div>
</div>

<script type="text/javascript">
$(document).on('keyup','#search',function(){

    $search=$('#search').val();
    //alert('search');
$.ajax({
url:'{{route("fournisseurs.search")}}',
type:'get',
dataType:'html',
data:{'search':$search},
success:function(response){
$('#table-f').html(response);
}
});
return false;
});

</script>
@endsection
