@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <a href="{{route('carnets.create')}}" class="col-md-offset-11">
              <span class="fa-stack fa-2x">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
              </span>
            </a>

        </div>
      </div>
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
            {{$carnets->links()}}
              <div class="panel panel-default">

                   <table class="table table-striped">
                      <thead>
                       <tr>
                         <th>Numero De Carnet</th>
                         <th>nombre de feuile</th>
                         <th>number</th>
                         <th>etat</th>
                         <th></th>
                       </tr>
                      </thead>
                      <tbody>
                    @foreach ($carnets as $carnet)
                      <tr>
                         <th scope="row">{{$carnet->numCarnet}}</th>
                         <td>{{$carnet->numFeuilleDebut}}</td>
                         <td>{{$carnet->numFeuilles}}</td>
                          <td>{{$carnet->etat}}</td>
                         <td>
                           @if ($carnet->etat=='attent')
                             <a href="{{route('carnets.edit',$carnet->id)}}"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
                           @endif
                         </td>
                       </tr>

                    @endforeach
                      </tbody>
                  </table>
            </div>
            {{$carnets->links()}}
        </div>
    </div>
</div>
@endsection
