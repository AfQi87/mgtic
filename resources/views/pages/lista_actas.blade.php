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
                <a href="{{ route('formActa')}}" class="btn btn-sm btn-primary text-white">Registrar</a>
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
              <table class="table">
                <thead class=" text-primary">
                  <th class="text-center" style="width: 100px;">Acta</th>
                  <th class="text-center" style="width: 400px;">Reunion</th>
                  <th class="text-center" style="width: 800px;">Proceso</th>
                  <th class="text-center" style="width: 250px;">Fecha</th>
                  <th class="text-center" style="width: 250px;">Más</th>
                </thead>
                <tbody>
                  @foreach($actas as $acta)
                  <tr>
                    <td class="text-center">{{ $acta->id }}</td>
                    <td class="text-center">{{ $acta->reuniones->tipo }}</td>
                    <td class="text-center">{{ $acta->proceso }}</td>
                    <td class="text-center">{{ $acta->fecha }}</td>
                    <td class="text-center">
                      <a href="{{route('descargarActa', $acta->id)}}" class="btn btn-warning">PDF</a>
                      <a href="{{route('elimActa', $acta->id)}}" class="btn btn-danger"><i class="bi bi-trash3"></i></a>
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