@extends('layouts.app', ['activePage' => 'actas', 'titlePage' => __('Actas')])

@section('content')
<div class="content mb-5">
  <div class="container-fluid mb-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Formulario Acta Comite</h4>
          </div>
          <div class="card-body">
            <form action="{{route('actas_guardarComite')}}" class="form-horizontal" method="POST" id="actaComite">
              @csrf
              <!-- Encabezado -->
              <div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">Tipo de reunion: </label>
                  <label class="col-sm-2 col-form-label">Ordinaria </label>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <input class="form-check-input" value="1" name="reunion" id="ordinaria" type="radio" required>
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">Extraordinaria </label>
                  <div class="col-sm-1">
                    <div class="form-group">
                      <input class="form-check-input" value="2" name="reunion" id="extraordinaria" type="radio" required>
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">Obligatoria </label>
                  <div class="col-sm-1">
                    <div class="form-group">
                      <input class="form-check-input" class="form-check-input" value="3" name="reunion" id="urgente" type="radio" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="col-sm-12">
                      <label class="col-form-label">Proceso </label>
                      <input class="form-control" style="height: 60px;" name="proceso" id="proceso" type="text" required>
                    </div>
                    <div class="col-sm-12 mt-3">
                      <label class="col-form-label">Lugar </label>
                      <input class="form-control" style="height: 60px;" name="lugar" id="lugar" type="text" required>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="col-sm-12">
                      <label class="col-form-label">Fecha Reunion</label>
                      <input class="form-control" name="fecha" style="height: 60px;" id="fecha" type="date" min="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>" required>
                    </div>
                    <div class="row p-3">
                      <div class="col-sm-6">
                        <label class="col-form-label">Hora inicio </label>
                        <input class="form-control" name="hora_ini" id="hora_ini" type="time" style="height: 60px;" required>
                      </div>
                      <div class="col-sm-6">
                        <label class="col-form-label">Hora finalizacion </label>
                        <input class="form-control" name="hora_fin" id="hora_fin" type="time" style="height: 60px;" required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Lista Asistentes -->
              <div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header card-header-primary">
                        <h4 class="card-title ">Asistentes</h4>
                        <p class="card-category">Seleccione asistentes</p>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table">
                            <thead class=" text-primary">
                              <th>Id</th>
                              <th>Nombre</th>
                              <th>Cargo</th>
                              <th class="text-center">Dependencia</th>
                              <th>Seleccionar</th>
                            </thead>
                            <tbody>
                              @foreach($asistentes as $asistente)
                              <tr>
                                <td>{{ $asistente->persona }}</td>
                                <td>{{ $asistente->personas->nom_persona }}</td>
                                <td>{{ $asistente->cargos->desc_cargo }}</td>
                                <td>{{ $asistente->cargo }}</td>
                                <td class="text-center">
                                  <input type="checkbox" style="width: 15px;" class="asistente" value="{{ $asistente->id }}" name="asistente[]" id="asistente">
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
              <!-- Orden del dia(programación) -->
              <div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header card-header-primary">
                        <button type="button" class="btn btn-success" onclick="agregar_programacion()" style="float: right;"><i class="bi bi-align-middle h5"></i></button>
                        <h4 class="card-title ">Orden del dia</h4>
                        <p class="card-category">Escriba el orden del dia</p>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table">
                            <thead class="text-primary">
                              <th>Tematica</th>
                              <th>Responsable</th>
                              <th>
                                <center>Eliminar</center>
                              </th>
                            </thead>
                            <tbody id="tabla_programacion">
                              <tr>
                                <td><textarea name="tematica[]" id="tematica" class="form-control" cols="30" rows="4" required></textarea></td>
                                <td>
                                  <select class="form-control" aria-label="Default select example" id="responsable1" name="responsable[]" required>
                                    <option selected>Seleccione una opción</option>
                                    @foreach($asistentes as $asistente)
                                    <option value="{{ $asistente->persona }}">{{ $asistente->cargos->desc_cargo }}</option>
                                    @endforeach
                                  </select>
                                </td>
                                <td class="text-center"><button type="button" class="btn btn-danger" onclick="eliminar_programacion(1)">--</button></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Conclusiones -->
              <div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header card-header-primary">
                        <button type="button" class="btn btn-success" onclick="agregar_conclusion()" style="float: right;"><i class="bi bi-align-middle h5"></i></button>
                        <h4 class="card-title ">Conclusiones</h4>
                        <p class="card-category">escriba las conclusiones</p>

                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table">
                            <thead class="text-primary">
                              <th>Conclusión</th>
                              <th>
                                <center>Eliminar</center>
                              </th>
                            </thead>
                            <tbody id="tabla_conclusiones">
                              <tr>
                                <td><textarea name="conclusion[]" id="conclusion" class="form-control" cols="30" rows="4" required></textarea></td>
                                <td>
                                  <center><button type="button" class="btn btn-danger" onclick="eliminar_conclusion(1)">--</button></center>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Tareas -->
              <div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header card-header-primary">
                        <button type="button" class="btn btn-success" onclick="agregar_tareaC()" style="float: right;"><i class="bi bi-align-middle h5"></i></button>
                        <h4 class="card-title ">Tareas</h4>
                        <p class="card-category">Escriba las tareas</p>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table">
                            <thead class="text-primary">
                              <th>Tarea</th>
                              <th>
                                <center>Eliminar</center>
                              </th>
                            </thead>
                            <tbody id="tabla_tarea">
                              <tr>
                                <td><textarea name="tarea[]" id="tarea" class="form-control" cols="90" rows="3" required></textarea></td>
                                <td>
                                  <select class="form-control" aria-label="Default select example" id="responsable1" name="responsable[]" required>
                                    <option selected>Seleccione una opción</option>
                                    @foreach($asistentes as $asistente)
                                    <option value="{{$asistente->persona}}" class="form-control">{{$asistente->cargos->desc_cargo}}</option>
                                    @endforeach
                                  </select>
                                </td>
                                <td class="text-center"><button type="button" class="btn btn-danger" onclick="eliminar_tareaC(1)">--</button></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('actas')}}" class="btn btn-danger">Cancelar</a>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection