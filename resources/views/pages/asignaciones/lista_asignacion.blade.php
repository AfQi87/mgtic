@extends('layouts.app', ['activePage' => 'asignacion', 'titlePage' => __('asignacion')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title " id="textArea">Asignaciones Docente</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12 text-right">
                <button type="button" id="btnRegMateria" class="btn btn-sm btn-primary" style="font-size: 15px;" data-bs-toggle="modal" data-bs-target="#modalMateria">
                  Registrar
                </button>
              </div>
            </div>
            <!-- Modal Registro -->
            <div class="modal fade" id="modalMateria" tabindex="-1" aria-labelledby="ModalCorteLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="btn-close cerrar_modal" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="container">

                      <div class="row">
                        <div class="col-md-12">
                          <form id="formRegasignacion" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="card ">
                              <div class="card-header card-header-primary">
                                <h4 class="card-title">Asignacion Docente</h4>
                              </div>
                              <div class="card-body ">
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label class="form-label" for="docente">Docente</label>
                                      <input list="docentes" autocomplete="off" id="docente" name="docente" class="form-control" placeholder="Busca/Selecciona">
                                      <datalist name="docentes" id="docentes" required>
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
                                      <label class="form-label" for="materia">Materia</label>
                                      <input list="materias" autocomplete="off" id="materia" name="materia" class="form-control" placeholder="Busca/Selecciona">
                                      <datalist name="materias" id="materias" required>
                                        @foreach($materias as $materia)
                                        <option data-ejemplo="{{ $materia->id_materia }}" value="{{ $materia->nom_materia }}"></option>
                                        @endforeach
                                      </datalist>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label class="form-label" for="corte">Promoción</label>
                                      <input list="cortes" autocomplete="off" id="corte" name="corte" class="form-control" placeholder="Busca/Selecciona">
                                      <datalist name="cortes" id="cortes" required>
                                        @foreach($cortes as $corte)
                                        <option data-ejemplo="{{ $corte->id_cohorte }}" value="{{ $corte->desc_cohorte }}"></option>
                                        @endforeach
                                      </datalist>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="fecha_inicio" class="form-label">Fecha inicio</label>
                                      <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" placeholder="Ingrese Nombre" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="fecha_fin" class="form-label">Fecha Fin</label>
                                      <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" placeholder="Ingrese creditos" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="numero_resolucion" class="form-label">Número resolución</label>
                                      <input type="number" class="form-control" id="numero_resolucion" name="numero_resolucion" placeholder="Ingrese el semestre" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="fecha_resolucion" class="form-label">Fecha resolución</label>
                                      <input type="date" class="form-control" id="fecha_resolucion" name="fecha_resolucion" placeholder="Ingrese el semestre" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="resolucion" class="form-label">Resolución</label>
                                      <input type="file" class="form-control" accept=".pdf" id="resolucion" name="resolucion">
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

            <!-- Modal Actualización -->
            <div class="modal fade" id="modalAsignacionAct" tabindex="-1" aria-labelledby="ModalCorteLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="btn-close cerrar_modal" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="container">

                      <div class="row">
                        <div class="col-md-12">
                          <form id="formActAsignacion" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="card ">
                              <div class="card-header card-header-primary">
                                <h4 class="card-title">Asignacion Docente</h4>
                              </div>
                              <div class="card-body ">
                                <div class="row">
                                  <input type="hidden" id="id_ced" name="id_ced">
                                  <input type="hidden" id="id_mat" name="id_mat">
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label class="form-label" for="docente">Docente</label>
                                      <input list="docentes" autocomplete="off" id="docente" name="docente" class="form-control" placeholder="Busca/Selecciona">
                                      <datalist name="docentes" id="docentes" required>
                                        @foreach($docentes as $docente)
                                        <option data-ejemplo="{{ $docente->ced_persona }}" value="{{ $docente->personas->nom_persona }}"></option>
                                        @endforeach
                                      </datalist>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label class="form-label" for="materia">Materia</label>
                                      <input list="materias" autocomplete="off" id="materia" name="materia" class="form-control" placeholder="Busca/Selecciona">
                                      <datalist name="materias" id="materias" required>
                                        @foreach($materias as $materia)
                                        <option data-ejemplo="{{ $materia->id_materia }}" value="{{ $materia->nom_materia }}"></option>
                                        @endforeach
                                      </datalist>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label class="form-label" for="corte">Promoción</label>
                                      <input list="cortes" autocomplete="off" id="corte" name="corte" class="form-control" placeholder="Busca/Selecciona">
                                      <datalist name="cortes" id="cortes" required>
                                        @foreach($cortes as $corte)
                                        <option data-ejemplo="{{ $corte->id_cohorte }}" value="{{ $corte->desc_cohorte }}"></option>
                                        @endforeach
                                      </datalist>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="fecha_inicio" class="form-label">Fecha inicio</label>
                                      <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" placeholder="Ingrese Nombre" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="fecha_fin" class="form-label">Fecha Fin</label>
                                      <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" placeholder="Ingrese creditos" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="numero_resolucion" class="form-label">Número resolución</label>
                                      <input type="number" class="form-control" id="numero_resolucion" name="numero_resolucion" placeholder="Ingrese el semestre" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="fecha_resolucion" class="form-label">Fecha resolución</label>
                                      <input type="date" class="form-control" id="fecha_resolucion" name="fecha_resolucion" placeholder="Ingrese el semestre" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="resolucion" class="form-label">Resolución</label>
                                      <input type="file" class="form-control" accept=".pdf" id="resolucion" name="resolucion">
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

            <!-- Modal Ver -->
            <div class="modal fade" id="modalVerAsignacion" tabindex="-1" aria-labelledby="ModalUsuarioLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="container">

                      <div class="row">
                        <div class="col-md-12">
                          <div class="card ">
                            <div class="card-header card-header-primary">
                              <h4 class="card-title">Datos Asignación docente</h4>
                            </div>
                            <div class="card-body ">
                              <div>
                                <div class="card mb-3" style="max-width: 100%;">
                                  <div class="row g-0">
                                    <table class="table table-bordered table-hover" id="tablaVerAsignacion">
                                      <thead class=" text-primary text-center">
                                        <th>Docente</th>
                                        <th>Materia</th>
                                        <th>Promoción</th>
                                        <th>Fecha Inició</th>
                                        <th>Fecha fin</th>
                                        <th>Resolución</th>
                                        <th>Fecha resolución</th>
                                      </thead>
                                      <tbody>

                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-12">
                                <div class="card ">
                                  <div class="card-header card-header-primary" style="height: 50px;">
                                    <h4 class="card-title">Foa</h4>
                                  </div>
                                  <div class="card-body">
                                    <div class="col-sm-12">
                                      <iframe id="verDocAsignacion" style="width: 100%; min-height: 500px" src="" frameborder="0"></iframe>

                                    </div>
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
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Tabla -->
            <div class="table-responsive">
              <table class="table table-hover" id="tablaAsignaciones">
                <thead class=" text-primary text-center">
                  <th>Docente</th>
                  <th>Materia</th>
                  <th>Promoción</th>
                  <th>Fecha Inició</th>
                  <th>Fecha fin</th>
                  <th>Resolución</th>
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