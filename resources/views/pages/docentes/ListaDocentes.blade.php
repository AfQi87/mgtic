@extends('layouts.app', ['activePage' => 'docentes', 'titlePage' => __('docentes')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Listado Docentes</h4>
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
                          <form id="formregDocente" class="form-horizontal">
                            @csrf
                            <div class="card ">
                              <div class="card-header card-header-primary">
                                <h4 class="card-title">Agregar Docente</h4>
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
                                            @foreach($tipoDocs as $tipo)
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
                                      <div class="mb-3 col-sm-12">
                                        <label for="nombre" class="form-label">Nombre Completo</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre">
                                      </div>
                                      <div class="mb-3 col-sm-12">
                                        <label for="correo" class="form-label">Correo</label>
                                        <input type="email" class="form-control" id="correo" name="correo" aria-describedby="correoHelp">
                                        <div id="correoHelp" class="form-text">El correo no puede estar repetido</div>
                                      </div>
                                      <div class="mb-3 col-sm-6">
                                        <label for="fecha" class="form-label">Fecha nacimiento</label>
                                        <input type="date" class="form-control" id="fecha" name="fecha">
                                      </div>
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
                                        <label class="form-label" for="corte">Tipo</label>
                                        <select class="form-select" id="tipo" name="tipo" required>
                                          <option selected>Seleccione una opción</option>
                                          @foreach($tipos as $tipo)
                                          <option value="{{$tipo->id_tipo}}">{{$tipo->tipo}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                      <div class="col-sm-6">
                                        <label class="form-label" for="sexo">Sexo</label>
                                        <select class="form-select" id="sexo" name="sexo" required>
                                          <option selected>Seleccione una opción</option>
                                          @foreach($sexos as $sexo)
                                          <option value="{{$sexo->id_sexo}}">{{$sexo->descripcion}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                      <div class="col-sm-6">
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
                                      <div class="col-sm-6">
                                        <div class="mb-3">
                                          <label for="descripcion" class="form-label">Descripcion</label>
                                          <textarea name="descripcion" class="form-control textAreaD" id="descripcion" cols="30" rows="10"></textarea>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="mb-3">
                                          <div class="mb-3">
                                            <label for="cvlac" class="form-label">CVLAC</label>
                                            <textarea name="cvlac" class="form-control textAreaD" id="cvlac" cols="30" rows="10"></textarea>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-sm-4 mt-5" style="max-width: 100%;">
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
                                <div>
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="card">
                                        <div class="card-header card-header-primary">
                                          <button type="button" class="btn btn-success" onclick="agregarArea()" style="float: right;"><i class="bi bi-align-middle h5"></i></button>
                                          <h4 class="card-title ">Area de Conocimiento</h4>
                                        </div>
                                        <div class="card-body">
                                          <div class="table-responsive">
                                            <table class="table">
                                              <thead class="text-primary">
                                                <th>Area conocimiento</th>
                                                <th>
                                                  <center>Eliminar</center>
                                                </th>
                                              </thead>
                                              <tbody id="tablaArea">
                                                <tr>
                                                  <td>
                                                    <input type="text" name="area_conocimiento[]" id="area_conocimiento" class="form-control" required>
                                                  </td>
                                                  <td>
                                                    <center><button type="button" class="btn btn-danger" onclick="eliminarArea(1)">--</button></center>
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
            <div class="modal fade" id="modalVerDocente" tabindex="-1" aria-labelledby="ModalUsuarioLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="container">

                      <div class="row">
                        <div class="col-md-12">
                          <form id="mostrarDocente" class="form-horizontal">
                            @csrf
                            <div class="card ">
                              <div class="card-header card-header-primary">
                                <h4 class="card-title">Datos docente</h4>
                              </div>
                              <div class="card-body ">
                                <div>
                                  <div class="card mb-3" style="max-width: 100%;">
                                    <div class="row g-0">
                                      <div class="col-md-4">
                                        <img id="fotoverdoc" src="/images/docentes/20220616095723.jpg" class="img-fluid rounded-start" alt="...">
                                      </div>
                                      <div class="col-md-8" id="datDocente">
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
                                      <ul id="profVer"></ul>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-12">
                                  <div class="card ">
                                    <div class="card-header card-header-primary" style="height: 50px;">
                                      <h4 class="card-title">Areas de conocimiento</h4>
                                    </div>
                                    <div class="card-body ">
                                      <div class="row">
                                        <div class="col-sm-12">
                                          <ul id="areaVer"></ul>
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

            <!-- Modal Actualizar -->
            <div class="modal fade" id="modalActDocente" tabindex="-1" aria-labelledby="ModalUsuarioLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="container">

                      <div class="row">
                        <div class="col-md-12">
                          <form id="formActDocente" class="form-horizontal">
                            @csrf
                            <div class="card ">
                              <div class="card-header card-header-primary">
                                <h4 class="card-title">Editar Docente</h4>
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
                                            @foreach($tipoDocs as $tipo)
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
                                      <div class="mb-3 col-sm-12">
                                        <label for="nombre" class="form-label">Nombre Completo</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre">
                                      </div>
                                      <div class="mb-3 col-sm-12">
                                        <label for="correo" class="form-label">Correo</label>
                                        <input type="email" class="form-control" id="correo" name="correo" aria-describedby="correoHelp">
                                        <div id="correoHelp" class="form-text">El correo no puede estar repetido</div>
                                      </div>
                                      <div class="mb-3 col-sm-6">
                                        <label for="fecha" class="form-label">Fecha nacimiento</label>
                                        <input type="date" class="form-control" id="fecha" name="fecha">
                                      </div>
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
                                        <label class="form-label" for="corte">Tipo</label>
                                        <select class="form-select" id="tipo" name="tipo" required>
                                          <option selected>Seleccione una opción</option>
                                          @foreach($tipos as $tipo)
                                          <option value="{{$tipo->id_tipo}}">{{$tipo->tipo}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                      <div class="col-sm-6">
                                        <label class="form-label" for="sexo">Sexo</label>
                                        <select class="form-select" id="sexo" name="sexo" required>
                                          <option selected>Seleccione una opción</option>
                                          @foreach($sexos as $sexo)
                                          <option value="{{$sexo->id_sexo}}">{{$sexo->descripcion}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                      <div class="col-sm-6">
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
                                      <div class="col-sm-6">
                                        <div class="mb-3">
                                          <label for="descripcion" class="form-label">Descripcion</label>
                                          <textarea name="descripcion" class="form-control textAreaD" id="descripcion" cols="30" rows="10"></textarea>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="mb-3">
                                          <div class="mb-3">
                                            <label for="cvlac" class="form-label">CVLAC</label>
                                            <textarea name="cvlac" class="form-control textAreaD" id="cvlac" cols="30" rows="10"></textarea>
                                          </div>
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
                                              <img src="" class="img-fluid rounded-start" id="imagenSeleccionada">
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
                                <div>
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="card">
                                        <div class="card-header card-header-primary">
                                          <button type="button" class="btn btn-success" onclick="agregarAreaAct()" style="float: right;"><i class="bi bi-align-middle h5"></i></button>
                                          <h4 class="card-title ">Area de Conocimiento</h4>
                                        </div>
                                        <div class="card-body">
                                          <div class="table-responsive">
                                            <table class="table" id="tablaAreaA">
                                              <thead class="text-primary">
                                                <th>Area conocimiento</th>
                                                <th>
                                                  <center>Eliminar</center>
                                                </th>
                                              </thead>
                                              <tbody id="tablaAreaAct">
                                                <tr>
                                                  <td>
                                                    <input type="text" name="area_conocimiento[]" id="area_conocimiento" class="form-control" required>
                                                  </td>
                                                  <td>
                                                    <center><button type="button" class="btn btn-danger" onclick="eliminarArea(1)">--</button></center>
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
              <table class="table table-hover" id="tablaDocentes">
                <thead class=" text-primary text-center">
                  <th>Cedula</th>
                  <th>Foto</th>
                  <th>Nombre</th>
                  <th>Correo</th>
                  <th>Telefono</th>
                  <th>Tipo</th>
                  <th>Más</th>
                </thead>
                <tfoot class=" text-primary">
                  <th>ID</th>
                  <th>Foto</th>
                  <th>Nombre</th>
                  <th>Correo</th>
                  <th>Telefono</th>
                  <th>Tipo</th>
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