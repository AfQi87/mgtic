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
                                  <div class="col-sm-8">
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
                                      <div class="mb-3 col-sm-8">
                                        <label for="correo" class="form-label">Correo</label>
                                        <input type="email" class="form-control" id="correo" name="correo" aria-describedby="correoHelp">
                                        <div id="correoHelp" class="form-text">El correo no puede estar repetido</div>
                                      </div>
                                      <div class="mb-3 col-sm-4">
                                        <label for="fecha" class="form-label">Fecha Nacimiento</label>
                                        <input type="date" class="form-control" id="fecha" name="fecha">
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
                                      <div class="col-sm-6">
                                        <div class="mb-3">
                                          <label for="codigo" class="form-label">Código</label>
                                          <input type="number" class="form-control" id="codigo" name="codigo">
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="mb-3">
                                          <div class="mb-3">
                                            <label for="semestre" class="form-label">Semeste</label>
                                            <input type="number" class="form-control" id="semestre" name="semestre">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <label class="form-label" for="corte">Corte</label>
                                        <select class="form-select" id="corte" name="corte" required>
                                          <option selected>Seleccione una opción</option>
                                          @foreach($cortes as $corte)
                                          <option value="{{$corte->id_cohorte}}">{{$corte->desc_cohorte}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                      <div class="col-sm-6">
                                        <label class="form-label" for="beca">Beca</label>
                                        <select class="form-select" id="beca" name="beca" required>
                                          <option selected>Seleccione una opción</option>
                                          @foreach($becas as $beca)
                                          <option value="{{$beca->id_beca}}">{{$beca->desc_beca}}</option>@endforeach
                                        </select>
                                      </div>
                                      <div class="col-sm-6 mt-3">
                                        <label class="form-label" for="sexo">Sexo</label>
                                        <select class="form-select" id="sexo" name="sexo" required>
                                          <option selected>Seleccione una opción</option>
                                          @foreach($sexos as $sexo)
                                          <option value="{{$sexo->id_sexo}}">{{$sexo->descripcion}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                      <div class="col-sm-6 mt-3">
                                        <label class="form-label" for="estado_civil">Estado Civil</label>
                                        <select class="form-select" id="estado_civil" name="estado_civil" required>
                                          <option selected>Seleccione una opción</option>
                                          @foreach($estadosCivil as $estado)
                                          <option value="{{$estado->id_estado}}">{{$estado->descripcion}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                      <div class="col-sm-6 mt-3">
                                        <label class="form-label" for="tipo_sangre">Tipo de sangre</label>
                                        <select class="form-select" id="tipo_sangre" name="tipo_sangre" required>
                                          <option selected>Seleccione una opción</option>
                                          @foreach($sangres as $sangre)
                                          <option value="{{$sangre->id_tipo}}">{{$sangre->descripcion}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                      <div class="col-sm-6 mt-3">
                                        <div class="mb-3">
                                          <label class="form-label" for="nacimiento">Lugar de nacimiento</label>
                                          <input list="nacimientos" autocomplete="off" id="nacimiento" name="nacimiento" class="form-control" placeholder="Busca/Selecciona">
                                          <datalist name="nacimientos" id="nacimientos" class="instEgresado" onclick="selectProgram()" required>
                                            @foreach($nacimientos as $nacimiento)
                                            <option data-ejemplo="{{ $nacimiento->id_municipio }}" value="{{ $nacimiento->nom_municipio }}"></option>
                                            @endforeach
                                          </datalist>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="mb-3">
                                          <label for="direccion" class="form-label">Dirección residencia</label>
                                          <input type="text" class="form-control" id="direccion" name="direccion">
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="mb-3">
                                          <label class="form-label" for="barrio">Barrio</label>
                                          <input list="barrios" autocomplete="off" id="barrio" name="barrio" class="form-control" placeholder="Busca/Selecciona">
                                          <datalist name="barrios" id="barrios" class="instEgresado" onclick="selectProgram()" required>
                                            @foreach($barrios as $barrio)
                                            <option data-ejemplo="{{ $barrio->id_barrio }}" value="{{ $barrio->nom_barrio }}"></option>
                                            @endforeach
                                          </datalist>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-sm-4 mt-5">
                                    <div>
                                      <div class="row">
                                        <div class="col-md-12">
                                          <div class="card">
                                            <div class="card-header card-header-primary">
                                              <h4 class="card-title ">Fotografia</h4>
                                            </div>
                                            <div class="card-body">
                                              <div class="rounded img-responsive mt-4" style="max-width: 280px">
                                                <img id="imagenSeleccionada" src="avatar/avatar.png" style="max-width: 280px">
                                              </div>
                                              <div class="mb-3 mt-2">
                                                <input type="file" class="form-control" id="foto" name="foto">
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
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
                                                <th>Nivel</th>
                                                <th>institucion</th>
                                                <th>
                                                  <center>Eliminar</center>
                                                </th>
                                              </thead>
                                              <tbody id="tablaProfesion">
                                                <tr>
                                                  <td><textarea name="profesion[]" id="profesion" class="form-control" cols="30" rows="1" required></textarea></td>
                                                  <td>
                                                    <select class="form-select nivel" id="nivel" name="nivel[]" required style="max-width: 250px">
                                                      <option selected value="">Seleccione una opción</option>
                                                      @foreach($niveles as $nivel)
                                                      <option value="{{$nivel->id_nivel}}">{{$nivel->desc_nivel}}</option>
                                                      @endforeach
                                                    </select>
                                                  </td>
                                                  <td>
                                                    <input list="instituciones" autocomplete="off" id="institucion1" required name="institucion[]" class="institucion form-control" placeholder="Busca/Selecciona">
                                                    <datalist name="instituciones[]" id="instituciones" class="instEgresado" onclick="selectProgram()" required>
                                                      @foreach($instituciones as $institucion)
                                                      <option data-ejemplo="{{ $institucion->id_institucion }}" value="{{ $institucion->nom_institucion }}"></option>
                                                      @endforeach
                                                    </datalist>
                                                  </td>
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