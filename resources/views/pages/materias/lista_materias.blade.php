@extends('layouts.app', ['activePage' => 'materias', 'titlePage' => __('materias')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title " id="textArea">Listado Materias</h4>
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
                          <form id="formRegMateria" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="card ">
                              <div class="card-header card-header-primary">
                                <h4 class="card-title">Agregar Materia</h4>
                              </div>
                              <div class="card-body ">
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="nombre" class="form-label">Nombre</label>
                                      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese Nombre" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="creditos" class="form-label">Creditos</label>
                                      <input type="text" class="form-control" id="creditos" name="creditos" placeholder="Ingrese creditos" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="semestre" class="form-label">Semestre</label>
                                      <input type="number" class="form-control" id="semestre" name="semestre" placeholder="Ingrese el semestre" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label class="form-label" for="area">Area formación</label>
                                      <input list="areas" autocomplete="off" id="area" name="area" class="form-control" placeholder="Busca/Selecciona">
                                      <datalist name="areas" id="areas" class="instEgresado" required>
                                        @foreach($areas as $area)
                                        <option data-ejemplo="{{ $area->id_area }}" value="{{ $area->nom_area_form }}"></option>
                                        @endforeach
                                      </datalist>
                                    </div>
                                  </div>
                                  <div class="col-sm-12">
                                    <div class="mb-3">
                                      <label for="foa" class="form-label">FOA</label>
                                      <input type="file" class="form-control" accept=".pdf" id="foa" name="foa" placeholder="Ingrese el semestre" required>
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

            <!-- Modal Actualizar -->
            <div class="modal fade" id="modalMateriaAct" tabindex="-1" aria-labelledby="ModalCorteLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="btn-close cerrar_modal" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="container">

                      <div class="row">
                        <div class="col-md-12">
                          <form id="formActMateria" class="form-horizontal">
                            @csrf
                            <div class="card ">
                              <div class="card-header card-header-primary">
                                <h4 class="card-title">Actualizar Materia</h4>
                              </div>
                              <div class="card-body ">
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <input type="hidden" name="id_materia" id="id_materia">
                                      <label for="nombre" class="form-label">Nombre</label>
                                      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese Nombre" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="creditos" class="form-label">Creditos</label>
                                      <input type="text" class="form-control" id="creditos" name="creditos" placeholder="Ingrese creditos" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="semestre" class="form-label">Semestre</label>
                                      <input type="number" class="form-control" id="semestre" name="semestre" placeholder="Ingrese el semestre" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label class="form-label" for="area">Area formación</label>
                                      <input list="areas" autocomplete="off" id="area" name="area" class="form-control" placeholder="Busca/Selecciona">
                                      <datalist name="areas" id="areas" class="instEgresado" required>
                                        @foreach($areas as $area)
                                        <option data-ejemplo="{{ $area->id_area }}" value="{{ $area->nom_area_form }}"></option>
                                        @endforeach
                                      </datalist>
                                    </div>
                                  </div>
                                  <div class="col-sm-12">
                                    <div class="mb-3">
                                      <label for="foa" class="form-label">FOA</label>
                                      <input type="file" class="form-control" accept=".pdf" id="foa" name="foa" placeholder="Ingrese el semestre" required>
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
              <table class="table table-hover" id="tablaMaterias">
                <thead class=" text-primary text-center">
                  <th>Nombre</th>
                  <th>Creditos</th>
                  <th>Semestre</th>
                  <th>Area Formación</th>
                  <th>Más</th>
                </thead>
                <tfoot class=" text-primary">
                  <th>Nombre</th>
                  <th>Creditos</th>
                  <th>Semestre</th>
                  <th>Area Formación</th>
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