@extends('layouts.app', ['activePage' => 'trabajos', 'titlePage' => __('trabajos')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title " id="textArea">Trabajos de grado</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12 text-right">
                <button type="button" id="btnRegMateria" class="btn btn-sm btn-primary" style="font-size: 15px;" data-bs-toggle="modal" data-bs-target="#modalTrabGrados">
                  Registrar
                </button>
              </div>
            </div>
            <!-- Modal Registro -->
            <div class="modal fade" id="modalTrabGrados" tabindex="-1" aria-labelledby="ModalCorteLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="btn-close cerrar_modal" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="container">

                      <div class="row">
                        <div class="col-md-12">
                          <form id="formRegTrabGrado" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="card ">
                              <div class="card-header card-header-primary">
                                <h4 class="card-title">Trabajo de Grado</h4>
                              </div>
                              <div class="card-body ">
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="nombre" class="form-label">Nombre</label>
                                      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre del trabajo de grado" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label class="form-label" for="estudiante">Estudiante</label>
                                      <input list="estudiantes" autocomplete="off" id="estudiante" name="estudiante" class="form-control" placeholder="Busca/Selecciona">
                                      <datalist name="estudiantes" id="estudiantes" required>
                                        @foreach($estudiantes as $estudiante)
                                        @if($estudiante->personas->estado_id == 1)
                                        <option data-ejemplo="{{ $estudiante->ced_persona }}" value="{{ $estudiante->personas->nom_persona }}"></option>
                                        @endif
                                        @endforeach
                                      </datalist>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label class="form-label" for="asesor">Asesor</label>
                                      <input list="asesores" autocomplete="off" id="asesor" name="asesor" class="form-control" placeholder="Busca/Selecciona">
                                      <datalist name="asesores" id="asesores" required>
                                        @foreach($docentes as $docente)
                                        @if($docente->personas->estado_id == 1)
                                        <option data-ejemplo="{{ $docente->ced_persona }}" value="{{ $docente->personas->nom_persona }}"></option>
                                        @endif
                                        @endforeach
                                      </datalist>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="estado" class="form-label">Estado</label>
                                      <select class="form-select" id="estado" name="estado" required>
                                        <option selected>Seleccione una opción</option>
                                        <option value="1">Inscrito</option>
                                        <option value="2">En ejecución</option>
                                        <option value="3">Cancelado</option>
                                        <option value="4">Finalizado</option>
                                      </select>
                                    </div>
                                  </div>

                                  <h4 class="mt-2 mb-4">Asignación jurados</h4>

                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="numero_acuerdo" class="form-label">Número de acuerdo</label>
                                      <input type="text" class="form-control" id="numero_acuerdo" name="numero_acuerdo" placeholder="Ingrese el número de acuerdo de jurados" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="fecha_inscripcion" class="form-label">Fecha Acuerdo</label>
                                      <input type="date" class="form-control" id="fecha_inscripcion" name="fecha_inscripcion" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label class="form-label" for="jurado_1">Jurado No. 1</label>
                                      <input list="jurados_1" autocomplete="off" id="jurado_1" name="jurado_1" class="form-control" placeholder="Busca/Selecciona">
                                      <datalist name="jurados_1" id="jurados_1" required>
                                        @foreach($docentes as $docente)
                                        @if($docente->personas->estado_id == 1)
                                        <option data-ejemplo="{{ $docente->ced_persona }}" value="{{ $docente->personas->nom_persona }}"></option>
                                        @endif
                                        @endforeach
                                      </datalist>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label class="form-label" for="jurado_2">Jurado No. 2</label>
                                      <input list="jurados_2" autocomplete="off" id="jurado_2" name="jurado_2" class="form-control" placeholder="Busca/Selecciona">
                                      <datalist name="jurados_2" id="jurados_2" required>
                                        @foreach($docentes as $docente)
                                        @if($docente->personas->estado_id == 1)
                                        <option data-ejemplo="{{ $docente->ced_persona }}" value="{{ $docente->personas->nom_persona }}"></option>
                                        @endif
                                        @endforeach
                                      </datalist>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label class="form-label" for="jurado_3">Jurado No. 3</label>
                                      <input list="jurados_3" autocomplete="off" id="jurado_3" name="jurado_3" class="form-control" placeholder="Busca/Selecciona">
                                      <datalist name="jurados_3" id="jurados_3" required>
                                        @foreach($docentes as $docente)
                                        @if($docente->personas->estado_id == 1)
                                        <option data-ejemplo="{{ $docente->ced_persona }}" value="{{ $docente->personas->nom_persona }}"></option>
                                        @endif
                                        @endforeach
                                      </datalist>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="acuerdo" class="form-label">Acuerdo</label>
                                      <input type="file" class="form-control" id="acuerdo" name="acuerdo" accept=".pdf">
                                    </div>
                                  </div>

                                  <h4 class="mt-2 mb-4">Aprobación</h4>

                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="numero_acuerdo_inicio" class="form-label">Número de acuerdo</label>
                                      <input type="text" class="form-control" id="numero_acuerdo_inicio" name="numero_acuerdo_inicio" placeholder="Ingrese el numero del acuerdo de inicio">
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="fecha_aprobacion" class="form-label">Fecha de aprobacion</label>
                                      <input type="date" class="form-control" id="fecha_aprobacion" name="fecha_aprobacion">
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="acuerdo_inicio" class="form-label">Acuerdo</label>
                                      <input type="file" class="form-control" id="acuerdo_inicio" name="acuerdo_inicio">
                                    </div>
                                  </div>

                                  <h4 class="mt-2 mb-4">Evaluación</h4>

                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="fecha_entrega" class="form-label">Fecha de entrega</label>
                                      <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega">
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="puntuacion" class="form-label">Puntuación</label>
                                      <input type="number" class="form-control" id="puntuacion" name="puntuacion" placeholder="Ingrese puntuacion entre 0 - 100">
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="calificacion" class="form-label">Calificación</label>
                                      <input type="text" class="form-control" id="calificacion" name="calificacion" placeholder="Ingrese calificación valida">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                    <button type="button" class="btn btn-danger cerrar" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal actualizar -->
            <div class="modal fade" id="modalActTrabGrados" tabindex="-1" aria-labelledby="ModalCorteLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="btn-close cerrar_modal" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="container">

                      <div class="row">
                        <div class="col-md-12">
                          <form id="formActTrabGrado" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="card ">
                              <div class="card-header card-header-primary">
                                <h4 class="card-title">Actualizar trabajo de Grado</h4>
                              </div>
                              <div class="card-body ">
                                <div class="row">
                                  <input type="hidden" id="id_tg" name="id_tg">
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="nombre" class="form-label">Nombre</label>
                                      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre del trabajo de grado" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label class="form-label" for="estudiante">Estudiante</label>
                                      <input list="estudiantes" autocomplete="off" id="estudiante" name="estudiante" class="form-control" placeholder="Busca/Selecciona">
                                      <datalist name="estudiantes" id="estudiantes" required>
                                        @foreach($estudiantes as $estudiante)
                                        <option data-ejemplo="{{ $estudiante->ced_persona }}" value="{{ $estudiante->personas->nom_persona }}"></option>
                                        @endforeach
                                      </datalist>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label class="form-label" for="asesor">Asesor</label>
                                      <input list="asesores" autocomplete="off" id="asesor" name="asesor" class="form-control" placeholder="Busca/Selecciona">
                                      <datalist name="asesores" id="asesores" required>
                                        @foreach($docentes as $docente)
                                        <option data-ejemplo="{{ $docente->ced_persona }}" value="{{ $docente->personas->nom_persona }}"></option>
                                        @endforeach
                                      </datalist>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="estado" class="form-label">Estado</label>
                                      <select class="form-select" id="estado" name="estado" required>
                                        <option selected>Seleccione una opción</option>
                                        <option value="1">Inscrito</option>
                                        <option value="2">En ejecución</option>
                                        <option value="3">Cancelado</option>
                                        <option value="4">Finalizado</option>
                                      </select>
                                    </div>
                                  </div>

                                  <h4 class="mt-2 mb-4">Asignación jurados</h4>

                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="numero_acuerdo" class="form-label">Número de acuerdo</label>
                                      <input type="text" class="form-control" id="numero_acuerdo" name="numero_acuerdo" placeholder="Ingrese el número de acuerdo de jurados" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="fecha_inscripcion" class="form-label">Fecha Acuerdo</label>
                                      <input type="date" class="form-control" id="fecha_inscripcion" name="fecha_inscripcion" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label class="form-label" for="jurado_1">Jurado No. 1</label>
                                      <input list="jurados_1" autocomplete="off" id="jurado_1" name="jurado_1" class="form-control" placeholder="Busca/Selecciona">
                                      <datalist name="jurados_1" id="jurados_1" required>
                                        @foreach($docentes as $docente)
                                        <option data-ejemplo="{{ $docente->ced_persona }}" value="{{ $docente->personas->nom_persona }}"></option>
                                        @endforeach
                                      </datalist>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label class="form-label" for="jurado_2">Jurado No. 2</label>
                                      <input list="jurados_2" autocomplete="off" id="jurado_2" name="jurado_2" class="form-control" placeholder="Busca/Selecciona">
                                      <datalist name="jurados_2" id="jurados_2" required>
                                        @foreach($docentes as $docente)
                                        <option data-ejemplo="{{ $docente->ced_persona }}" value="{{ $docente->personas->nom_persona }}"></option>
                                        @endforeach
                                      </datalist>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label class="form-label" for="jurado_3">Jurado No. 3</label>
                                      <input list="jurados_3" autocomplete="off" id="jurado_3" name="jurado_3" class="form-control" placeholder="Busca/Selecciona">
                                      <datalist name="jurados_3" id="jurados_3" required>
                                        @foreach($docentes as $docente)
                                        <option data-ejemplo="{{ $docente->ced_persona }}" value="{{ $docente->personas->nom_persona }}"></option>
                                        @endforeach
                                      </datalist>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="acuerdo" class="form-label">Acuerdo</label>
                                      <input type="file" class="form-control" id="acuerdo" name="acuerdo" accept=".pdf">
                                    </div>
                                  </div>

                                  <h4 class="mt-2 mb-4">Aprobación</h4>

                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="numero_acuerdo_inicio" class="form-label">Número de acuerdo</label>
                                      <input type="text" class="form-control" id="numero_acuerdo_inicio" name="numero_acuerdo_inicio" placeholder="Ingrese el numero del acuerdo de inicio">
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="fecha_aprobacion" class="form-label">Fecha de aprobación</label>
                                      <input type="date" class="form-control" id="fecha_aprobacion" name="fecha_aprobacion">
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="acuerdo_inicio" class="form-label">Acuerdo</label>
                                      <input type="file" class="form-control" id="acuerdo_inicio" name="acuerdo_inicio">
                                    </div>
                                  </div>

                                  <h4 class="mt-2 mb-4">Evaluación</h4>

                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="fecha_entrega" class="form-label">Fecha de entrega</label>
                                      <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega">
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="puntuacion" class="form-label">Puntuación</label>
                                      <input type="number" class="form-control" id="puntuacion" name="puntuacion" placeholder="Ingrese puntuacion entre 0 - 100">
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="calificacion" class="form-label">Calificación</label>
                                      <input type="text" class="form-control" id="calificacion" name="calificacion" placeholder="Ingrese calificación valida">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                    <button type="button" class="btn btn-danger cerrar" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Tabla -->
            <div class="table-responsive">
              <table class="table table-hover" id="tablaTrabGrado">
                <thead class=" text-primary text-center">
                  <th>Nombre</th>
                  <th>Fecha Inscripción</th>
                  <th>Estudiante</th>
                  <th>Asesor</th>
                  <th>Jurado 1</th>
                  <th>Jurado 2</th>
                  <th>Jurado 3</th>
                  <th>Más</th>
                </thead>
                <tfoot class=" text-primary">
                  <th>Docente</th>
                  <th>Materia</th>
                  <th>Promoción</th>
                  <th>Fecha Inició</th>
                  <th>Fecha fin</th>
                  <th>Resolución</th>
                  <th>Más</th>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection