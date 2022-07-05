@extends('layouts.app', ['activePage' => 'actas', 'titlePage' => __('Actas')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Listado de Actas</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12 text-right">
                <a href="{{ route('formActa')}}" class="btn btn-sm btn-primary text-white">Acta MGTIC</a>
                <a href="{{ route('formActaComite')}}" class="btn btn-sm btn-primary text-white">Acta Comite</a>
              </div>
            </div>
            @if (session('status'))
            <div class="row">
              <div class="col-sm-12">
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="material-icons">close</i>
                  </button>
                  <span>{{ session('status') }}</span>
                </div>
              </div>
            </div>
            @endif

            <div class="table-responsive">
              <table class="table table-hover" id="tablaActas">
                <thead class=" text-primary">
                  <th class="text-center" style="width: 100px;">ID</th>
                  <!-- <th class="text-center" style="width: 100px;">Acta</th> -->
                  <th class="text-center" style="width: 400px;">Reunion</th>
                  <th class="text-center" style="width: 800px;">Proceso</th>
                  <th class="text-center" style="width: 250px;">Fecha</th>
                  <th class="text-center" style="width: 300px;">Más</th>
                </thead>
                <tbody>
                  @foreach($actas as $acta)
                  <tr>
                    <td class="text-center">{{ $acta->id_acta }}</td>
                    <!-- <td class="text-center">{{ $acta->asistentes }}</td> -->
                    <td class="text-center">{{ $acta->reuniones->descripcion }}</td>
                    <td class="text-center">{{ $acta->proceso }}</td>
                    <td class="text-center">{{ $acta->fecha }}</td>
                    <td class="text-center">
                      <!-- <button type="button" onclick="verActa('{{$acta->id_acta}}')" name="verActa" class="verActa btn btn-info"><i class="bi bi-aspect-ratio"></i></i></button> -->
                      <a href="{{route('descargarActa', $acta->id_acta)}}" class="btn btn-warning">PDF</a>
                      <form action="{{route('elimActa', $acta->id_acta)}}" class="confirmar" method="POST" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash3"></i></button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection