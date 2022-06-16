@extends('layouts.app', ['activePage' => 'egresados', 'titlePage' => __('egresados')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title " id="textArea">Listado Egresados</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12 text-right">
                <button type="button" id="btnregEgresado" class="btn btn-sm btn-primary" style="font-size: 15px;" data-bs-toggle="modal" data-bs-target="#modalEgresado">
                  Registrar
                </button>
                <a href="javascript:void(0)" onclick="copiarCorreo()" class="btn btn-danger">Copiar Correos <i class="bi bi-clipboard2-plus"></i></a>
              </div>
            </div>
            <!-- Modal Registro -->
            <div class="modal fade" id="modalEgresado" tabindex="-1" aria-labelledby="ModalUsuarioLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="btn-close cerrar_modal" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="container">

                      <div class="row">
                        <div class="col-md-12">
                          <form id="formregEgresado" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="card ">
                              <div class="card-header card-header-primary">
                                <h4 class="card-title">Agregar Egresado</h4>
                              </div>
                              <div class="card-body ">
                                <div class="row">
                                  <div class="col-sm-12">
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <div class="mb-3">
                                          <label for="tipo_doc" class="form-label">Tipo Documento</label>
                                          <select class="form-select" id="tipo_doc" name="tipo_doc" required>
                                            <option selected>Seleccione una opción</option>
                                            @foreach($tipos as $tipo)
                                            <option value="{{$tipo->id_tipo}}">{{$tipo->nom_tipo}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="mb-3">
                                          <label for="documento" class="form-label">Documento</label>
                                          <input type="number" class="form-control" id="documento" name="documento">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="mb-3">
                                      <label for="nombre" class="form-label">Nombre Completo</label>
                                      <input type="text" class="form-control" id="nombre" name="nombre">
                                    </div>
                                    <div class="row">
                                      <div class="mb-3 col-sm-12">
                                        <label for="correo" class="form-label">Correo</label>
                                        <input type="email" class="form-control" id="correo" name="correo" aria-describedby="correoHelp">
                                        <div id="correoHelp" class="form-text">El correo no puede estar repetido</div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <div class="mb-3">
                                          <label for="telefono" class="form-label">Teléfono</label>
                                          <input type="number" class="form-control" id="telefono" name="telefono">
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="mb-3">
                                          <div class="mb-3">
                                            <label for="celular" class="form-label">Celular</label>
                                            <input type="number" class="form-control" id="celular" name="celular">
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label class="form-label" for="institucion">Institución</label>
                                      <input list="instituciones" autocomplete="off" id="institucion" name="institucion" class="form-control" placeholder="Busca/Selecciona">
                                      <datalist name="instituciones" id="instituciones" class="instEgresado" onclick="selectProgram()" required>
                                        @foreach($instituciones as $institucion)
                                        <option data-ejemplo="{{ $institucion->id_institucion }}" value="{{ $institucion->nom_institucion }}"></option>
                                        @endforeach
                                      </datalist>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3 programa">

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
                    <button type="button" class="btn btn-danger cerrar" data-bs-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Actualizar Docente  -->
            <div class="modal fade" id="ModalEgresadoAct" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="container">

                      <div class="row">
                        <div class="col-md-12">
                          <form id="formEgresadoAct" class="form-horizontal">
                            @csrf
                            <div class="card ">
                              <div class="card-header card-header-primary">
                                <h4 class="card-title">Editar Datos Egresado</h4>
                              </div>
                              <div class="card-body ">
                                <div class="row">
                                  <div class="col-sm-12">
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <div class="mb-3">
                                          <label for="tipo_doc" class="form-label">Tipo Documento</label>
                                          <select class="form-select" id="tipo_doc" name="tipo_doc" required>
                                            <option selected>Seleccione una opción</option>
                                            @foreach($tipos as $tipo)
                                            <option value="{{$tipo->id_tipo}}">{{$tipo->nom_tipo}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="mb-3">
                                          <label for="documento" class="form-label">Documento</label>
                                          <input type="number" class="form-control" id="documento" name="documento">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="mb-3">
                                      <label for="nombre" class="form-label">Nombre Completo</label>
                                      <input type="text" class="form-control" id="nombre" name="nombre">
                                    </div>
                                    <div class="row">
                                      <div class="mb-3 col-sm-12">
                                        <label for="correo" class="form-label">Correo</label>
                                        <input type="email" class="form-control" id="correo" name="correo" aria-describedby="correoHelp">
                                        <div id="correoHelp" class="form-text">El correo no puede estar repetido</div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <div class="mb-3">
                                          <label for="telefono" class="form-label">Teléfono</label>
                                          <input type="number" class="form-control" id="telefono" name="telefono">
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="mb-3">
                                          <div class="mb-3">
                                            <label for="celular" class="form-label">Celular</label>
                                            <input type="number" class="form-control" id="celular" name="celular">
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label class="form-label" for="institucionAct">Institución</label>
                                      <input list="institucionesAct" autocomplete="off" id="institucionAct" name="institucion" class="form-control">
                                      <datalist name="institucionesAct" id="institucionesAct" class="instEgresado" required>
                                        @foreach($instituciones as $institucion)
                                        <option data-ejemplo="{{ $institucion->id_institucion }}" value="{{ $institucion->nom_institucion }}"></option>
                                        @endforeach
                                      </datalist>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3 programaAct">

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
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Tabla -->
            <div class="table-responsive">
              <table class="table table-hover" id="tablaEgresados">
                <thead class=" text-primary text-center">
                  <th>Cédula</th>
                  <th>Nombre</th>
                  <th>Correo</th>
                  <th>Telefono</th>
                  <th>Institución</th>
                  <th>Programa</th>
                  <th>Más</th>
                </thead>
                <tfoot class=" text-primary">
                  <th>Cédula</th>
                  <th>Nombre</th>
                  <th>Correo</th>
                  <th>Telefono</th>
                  <th>Institución</th>
                  <th>Programa</th>
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