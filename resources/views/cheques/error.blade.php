@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-warning">
              <table>
                <tr>
                  <td class="col-md-8">
                     <h3 class="col-md-offset-1">Ajoute Carnet ! il n'y a aucune carnet Disponible!</h2>
                  </td>
                  <td class="col-md-4">
                    <a href="{{route('carnets.create')}}" class="col-md-offset-8">
                      <span class="fa-stack fa-2x">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
                      </span>
                    </a>
                  </td>
                </tr>
              </table>

            </div>
        </div>
    </div>
</div>
@endsection
