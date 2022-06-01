@extends('layouts.app', ['activePage' => 'estudiantes', 'titlePage' => __('estudiantes')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Listado Estudiantes</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12 text-right">
                <button type="button" id="btnregDocente" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalDocente">
                  Registrar
                </button>
              </div>
            </div>
            <!-- Modal Registro -->
            <div class="modal fade" id="modalDocente" tabindex="-1" aria-labelledby="ModalUsuarioLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="container">

                      <div class="row">
                        <div class="col-md-12">
                          <form id="formRegEstudiante" class="form-horizontal">
                            @csrf
                            <div class="card ">
                              <div class="card-header card-header-primary">
                                <h4 class="card-title">Agregar Estudiante</h4>
                              </div>
                              <div class="card-body ">
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <div class="mb-3">
                                          <label for="nombre" class="form-label">Nombre</label>
                                          <input type="text" class="form-control" id="nombre" name="nombre">
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="mb-3">
                                          <label for="codigo" class="form-label">Codigó</label>
                                          <input type="text" class="form-control" id="codigo" name="codigo">
                                        </div>
                                      </div>
                                    </div>


                                    <div class="mb-3">
                                      <label for="correo" class="form-label">Correo</label>
                                      <input type="email" class="form-control" id="correo" name="correo" aria-describedby="correoHelp">
                                      <div id="correoHelp" class="form-text">El correo no puede estar repetido</div>
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
                                          <label class="form-label" for="corte">Corte</label>
                                          <select class="form-select" id="corte" name="corte" required>
                                            <option selected>Seleccione una opción</option>
                                            @foreach($cortes as $corte)
                                            @if($corte->estado_id == 1)
                                            <option value="{{$corte->id}}">{{$corte->nombre}}</option>
                                            @endif
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="mb-3">
                                      <label for="foto" class="form-label">Imagen</label>
                                      <input type="file" class="form-control" id="foto" name="foto">
                                    </div>
                                  </div>
                                </div>
                                <div>
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="card">
                                        <div class="card-header card-header-primary">
                                          <button type="button" class="btn btn-success" onclick="agregarProfesion()" style="float: right;"><i class="bi bi-align-middle h5"></i></button>
                                          <h4 class="card-title ">Estudios</h4>
                                          <p class="card-category">Escriba los Estudios del Estudiante</p>

                                        </div>
                                        <div class="card-body">
                                          <div class="table-responsive">
                                            <table class="table">
                                              <thead class="text-primary">
                                                <th>Profesión</th>
                                                <th>
                                                  <center>Eliminar</center>
                                                </th>
                                              </thead>
                                              <tbody id="tablaProfesion">
                                                <tr>
                                                  <td><textarea name="profesion[]" id="profesion" class="form-control" cols="30" rows="1" required></textarea></td>
                                                  <td>
                                                    <center><button type="button" class="btn btn-danger" onclick="eliminarProfesion(1)">--</button></center>
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

            <!-- Actualizar Docente  -->
            <div class="modal fade" id="ModalDocenteAct" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="container">

                      <div class="row">
                        <div class="col-md-12">
                          <form id="formDocenteAct" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="card ">
                              <div class="card-header card-header-primary">
                                <h4 class="card-title">Actualizar Docente</h4>
                              </div>
                              <div class="card-body ">
                                <div class="row">
                                  <div class="col-sm-8">
                                    <div class="mb-3">
                                      <label for="id_user_d" class="form-label">ID</label>
                                      <input type="hidden" class="form-control" id="docente_id" name="id_user">
                                      <input type="text" class="form-control" id="id_disabled" name="id_user_d" disabled>
                                    </div>
                                    <div class="mb-3">
                                      <label for="name" class="form-label">Nombre</label>
                                      <input type="text" class="form-control" id="nombre_act" name="nombre_act" value="user1">
                                    </div>
                                    <div class="mb-3">
                                      <label for="correo_act" class="form-label">Correo</label>
                                      <input type="email" class="form-control" id="correo_act" name="correo_act" value="111111">
                                    </div>
                                    <div class="mb-3">
                                      <label for="telefono_act" class="form-label">Teléfono</label>
                                      <input type="number" class="form-control" id="telefono_act" name="telefono_act" value="111111">
                                    </div>
                                    <div class="mb-3">
                                      <label class="form-label" for="campo_act">campo</label>
                                      <select class="form-select" id="campo_act" name="campo_act" required>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-sm-4">
                                    <div class="mb-3 foto_act" id="fotoact">
                                    </div>
                                  </div>
                                </div>
                                <div>
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="card">
                                        <div class="card-header card-header-primary">
                                          <button type="button" class="btn btn-success" onclick="agregarProfesionact()" style="float: right;"><i class="bi bi-align-middle h5"></i></button>
                                          <h4 class="card-title ">Estudios</h4>
                                          <p class="card-category">Escriba los Estudios del Docente</p>

                                        </div>
                                        <div class="card-body">
                                          <div class="table-responsive">
                                            <table class="table" id="tablaDoc">
                                              <thead class="text-primary">
                                                <th>Profesión</th>
                                                <th>
                                                  <center>Eliminar</center>
                                                </th>
                                              </thead>
                                              <tbody id="tablaProfesionAct">

                                              </tbody>
                                            </table>
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
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Tabla -->
            <div class="table-responsive">
              <table class="table table-hover" id="tablaEstudiantes">
                <thead class=" text-primary text-center">
                  <th>ID</th>
                  <th>Foto</th>
                  <th>Nombre</th>
                  <th>Codigó</th>
                  <th>Correo</th>
                  <th>Corte</th>
                  <th>Más</th>
                </thead>
                <tfoot class=" text-primary">
                  <th>ID</th>
                  <th>Foto</th>
                  <th>Nombre</th>
                  <th>Codigó</th>
                  <th>Correo</th>
                  <th>Corte</th>
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