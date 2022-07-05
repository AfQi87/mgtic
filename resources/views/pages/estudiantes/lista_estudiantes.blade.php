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
                <button type="button" id="btnregDocente" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalestudiante">
                  Registrar
                </button>
              </div>
            </div>
            <!-- Modal Registro -->
            <div class="modal fade" id="modalestudiante" tabindex="-1" aria-labelledby="ModalUsuarioLabel" aria-hidden="true">
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
                                      <div class="col-sm-12">
                                        <div class="mb-3">
                                          <label for="direccion" class="form-label">Dirección residencia y barrio</label>
                                          <input type="text" class="form-control" id="direccion" name="direccion">
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
                                              <img src="avatar/avatar.png" class="img-fluid rounded-start" id="imagenSeleccionada">
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
                                        <div>
                                          <datalist name="profesiones[]" id="profesiones" class="instEgresado" onclick="selectProgram()" required>
                                            @foreach($profesiones as $profesion)
                                            <option data-ejemplo="{{ $profesion->id_estudio }}" value="{{ $profesion->nom_estudio }}"></option>
                                            @endforeach
                                          </datalist>
                                          <datalist name="instituciones[]" id="instituciones" class="instEgresado" onclick="selectProgram()" required>
                                            @foreach($instituciones as $institucion)
                                            <option data-ejemplo="{{ $institucion->id_institucion }}" value="{{ $institucion->nom_institucion }}"></option>
                                            @endforeach
                                          </datalist>
                                        </div>
                                        <div class="card-body">
                                          <div class="table-responsive">
                                            <table class="table">
                                              <thead class="text-primary">
                                                <th>Profesión</th>
                                                <th>Nivel</th>
                                                <th>Institución</th>
                                                <th>
                                                  <center>Eliminar</center>
                                                </th>
                                              </thead>
                                              <tbody id="tablaProfesion">
                                                <tr>
                                                  <td>
                                                    <input list="profesiones" autocomplete="off" id="profesion" required name="profesion[]" class="profesion form-control" placeholder="Busca/Selecciona">
                                                  </td>
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

            <!-- Modal Ver -->
            <div class="modal fade" id="modalVerEstudiante" tabindex="-1" aria-labelledby="ModalUsuarioLabel" aria-hidden="true">
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
                              <h4 class="card-title">Datos Estudiante</h4>
                            </div>
                            <div class="card-body ">
                              <div>
                                <div class="card mb-3" style="max-width: 100%;">
                                  <div class="row g-0">
                                    <div class="col-md-4">
                                      <img id="fotoverest" src="/images/estudiantes/20220616095723.jpg" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8" id="datEstudiante">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-12">
                                <div class="card ">
                                  <div class="card-header card-header-primary" style="height: 50px;">
                                    <h4 class="card-title">Profesiones</h4>
                                  </div>
                                  <div class="card-body">
                                    <ul id="profVerEst"></ul>
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

            <!-- Actualizar Docente  -->
            <div class="modal fade" id="ModalEstudianteAct" tabindex="-1" aria-labelledby="ModalUsuarioLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="container">

                      <div class="row">
                        <div class="col-md-12">
                          <form id="formActEstudiante" class="form-horizontal">
                            @csrf
                            <div class="card ">
                              <div class="card-header card-header-primary">
                                <h4 class="card-title">Editar Estudiante</h4>
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
                                      <div class="col-sm-12">
                                        <div class="mb-3">
                                          <label for="direccion" class="form-label">Dirección residencia</label>
                                          <input type="text" class="form-control" id="direccion" name="direccion">
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
                                              <img src="avatar/avatar.png" class="img-fluid rounded-start" id="imagenSeleccionada">
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
                                          <button type="button" class="btn btn-success" onclick="agregarProfesionact()" style="float: right;"><i class="bi bi-align-middle h5"></i></button>
                                          <h4 class="card-title ">Estudios</h4>
                                          <p class="card-category">Escriba los Estudios del Estudiante</p>

                                        </div>
                                        <div class="card-body">
                                          <div class="table-responsive">
                                            <table class="table" id="tablaDoc">
                                              <thead class="text-primary">
                                                <th>Profesión</th>
                                                <th>Nivel</th>
                                                <th>Institución</th>
                                                <th>
                                                  <center>Eliminar</center>
                                                </th>
                                              </thead>
                                              <tbody id="tablaProfesionAct">
                                                <tr>
                                                  <td>
                                                    <input type="hidden" class="form-control" id="estudio" name="estudio[]">
                                                    <textarea name="profesion[]" id="profesion" class="form-control" cols="30" rows="1" required></textarea>
                                                  </td>
                                                  <td>
                                                    <select class="form-select nivel" id="nivel" name="nivel[]" required style="max-width: 250px">
                                                      <option selected value="">Seleccione una opción</option>
                                                      @foreach($niveles as $nivel)
                                                      <option value="{{$nivel->id_nivel}}">{{$nivel->desc_nivel}}</option>
                                                      @endforeach
                                                    </select>
                                                  </td>
                                                  <td>
                                                    <input list="instituciones" autocomplete="off" id="institucion1" required name="institucion[]" class="institucionact form-control" placeholder="Busca/Selecciona">
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