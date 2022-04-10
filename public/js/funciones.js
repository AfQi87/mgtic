$(document).ready(function () {

  $("#tablaActas").dataTable({
    "language": { "url": "//cdn.datatables.net/plug-ins/1.11.4/i18n/es_es.json" },
    processing: true,
    serversite: true,
  });

  $("#datatable_user").dataTable({
    "language": { "url": "//cdn.datatables.net/plug-ins/1.11.4/i18n/es_es.json" },
    processing: true,
    serversite: true,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    ajax: {
      url: "/user",
    },
    success: function (response) {
      console.log("response");
    },
    columns: [
      { data: "id" },
      { data: "name" },
      { data: "email" },
      { data: "telefono" },
      { data: "foto" },
      { data: "cargo" },
      { data: "rol" },
      { data: "estado" },
      { data: "accion", orderable: false },
    ]
  });
});


//=============================================================================================Registrar usuario

$('#btnreguser').click(function () {
  $.get('/user/formuser', function (datos) {
    const $cargo = document.querySelector("#cargo_id");
    for (let i = ($cargo.options.length) + 1; i >= 0; i--) {
      $cargo.remove(i);
    }
    const $rol = document.querySelector("#rol_id");
    for (let i = ($rol.options.length) + 1; i >= 0; i--) {
      $rol.remove(i);
    }
    for (i = 0; i < datos.cargos.length; i++) {
      $("#cargo_id").append('<option value="' + datos.cargos[i].id + '">' + datos.cargos[i].cargo + '</option>');
    }
    for (i = 0; i < datos.roles.length; i++) {
      $("#rol_id").append('<option value="' + datos.roles[i].id + '">' + datos.roles[i].rol + '</option>');
    }
  })
})

$('#formreguser').submit(function (e) {
  e.preventDefault();
  let = formData = new FormData($('#formreguser')[0]);

  $.ajax({
    method: "POST",
    url: "/user/formuser",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      if (response == 0) {
        $('#formreguser')[0].reset();
        $('#ModalUsuario').modal('hide');
        $('#datatable_user').DataTable().ajax.reload();
        toastr.success("El Usuario se registro de forma correcta", 'Correcto',
          { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
      } else {
        Object.keys(response).forEach(key => toastr.error(response[key], 'Error',
          { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" }));
      }
    }
  });
});
//=============================================================================================Desactivar usuario usuario

var idactdesusu;
$(document).on('click', '.actdesUser', function () {
  idactdesusu = $(this).attr('id');
  $('#actdesusuario').modal('toggle');
});

$('#btnActDesUsu').click(function () {
  $.ajax({
    url: "/user/delete/" + idactdesusu,
    method: "GET",
    success: function (response) {
      if (response == 0) {
        $('#actdesusuario').modal('hide');
        $('#datatable_user').DataTable().ajax.reload();
        toastr.success("Registro Desactivado/Activado Correctamente", 'Correcto',
          { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
      } else {
        toastr.error("El usuario no se desactivo/activo", 'Error',
          { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
      }
    }
  });
})

//===============================================================Editar datos Usuario
function editarUsuario(id) {
  $.get('/user/formactualizar/' + id, function (datos,) {
    // $('#formActPro')[0].reset();
    $('#id_user').val(datos.usuario.id);
    $('#id_user_d').val(datos.usuario.id);
    $('#name_act').val(datos.usuario.name);
    $('#telefono_act').val(datos.usuario.telefono);
    if (datos.usuario.foto != '') {
      var div = document.querySelector("#fotoact");
      while (div.firstChild) {
        div.removeChild(div.firstChild);
      }

      $('#fotoact').append('<center><img id="foto_mostrar" src="./images/' + datos.usuario.foto + '" alt="" width="280" height="335"></center><br><input type="file" class="form-control" id="foto_act" name="foto_act">');
    } else {
      var div = document.querySelector("#fotoact");
      while (div.firstChild) {
        div.removeChild(div.firstChild);
      }

      $('#fotoact').append('<center><img id="foto_mostrar" src="./avatar/avatar.png" alt="" width="280" height="335"></center><br><input type="file" class="form-control" id="foto_act" name="foto_act">');

    }
    const $cargo = document.querySelector("#cargo_id_act");
    for (let i = $cargo.options.length; i >= 0; i--) {
      $cargo.remove(i);
    }
    $("#cargo_id_act").append('<option selected value="' + datos.usuario.cargo_id + '">' + datos.cargos[(datos.usuario.cargo_id - 1)].cargo + '</option>');
    for (i = 0; i < datos.cargos.length; i++) {
      if (datos.usuario.cargo_id != datos.cargos[i].id) {
        $("#cargo_id_act").append('<option value="' + datos.cargos[i].id + '">' + datos.cargos[i].cargo + '</option>');
      }
    }

    const $rol = document.querySelector("#rol_id_act");
    for (let i = $rol.options.length; i >= 0; i--) {
      $rol.remove(i);
    }
    $("#rol_id_act").append('<option selected value="' + datos.usuario.rol_id + '">' + datos.roles[(datos.usuario.rol_id - 1)].rol + '</option>');
    for (i = 0; i < datos.roles.length; i++) {
      if (datos.usuario.rol_id != datos.roles[i].id) {
        $("#cargo_id_act").append('<option value="' + datos.roles[i].id + '">' + datos.roles[i].rol + '</option>');
      }
    }
    $('#ModalUsuarioAct').modal('toggle');
  })
}

$('#formActUsuario').submit(function (e) {
  e.preventDefault();
  let = formAct = new FormData($('#formActUsuario')[0]);
  var id = $('#id_user').val();
  $.ajax({
    url: "/user/formactualizar/" + id,
    method: "POST",
    data: formAct,
    contentType: false,
    processData: false,
    success: function (response) {
      if (response == 0) {
        $('#ModalUsuarioAct').modal('hide');
        $('#datatable_user').DataTable().ajax.reload();
        toastr.success("Usuario actualizado correctamente", 'Correcto',
          { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
      } else {
        Object.keys(response).forEach(key => toastr.error(response[key], 'Error',
          { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" }));
      }
    }
  });
})
cont = 2;
function agregar_conclusion() {
  console.log("Agregar Conclusion")
  var table = document.getElementById("tabla_conclusiones");
  var row = table.insertRow(table.rows.length);

  var cell1 = row.insertCell(0);
  cell1.innerHTML = cont;

  var cell2 = row.insertCell(1);
  cell2.innerHTML = '<textarea name="conclusion[]" id="conclusion" class="form-control" cols="30" rows="4" required></textarea>';

  var cell3 = row.insertCell(2);
  var button = document.createElement("button");
  button.textContent = "--";
  button.type = "button";
  button.className = "btn btn-danger"
  cell3.appendChild(button);
  cell3.className = "text-center";
  cont++;

  button.addEventListener("click", () => {
    event.target.parentNode.parentNode.remove();
  })
}

function eliminar_conclusion(x) {
  console.log("Eliminar Conclusion")
  var table = document.getElementById("tabla_conclusiones");
  console.log(x)
  var row = table.deleteRow(x - 1);
  cont--;
}

var cont_prog = 2;
var bandera_prog = 2;
function agregar_programacion() {
  cont_prog++;
  bandera_prog++;
  console.log("Agregar Programacion")
  var table = document.getElementById("tabla_programacion");
  var row = table.insertRow(table.rows.length);

  var cell1 = row.insertCell(0);
  cell1.innerHTML = cont_prog - 1;

  var cell2 = row.insertCell(1);
  cell2.innerHTML = '<textarea name="tematica[]" id="tematica" class="form-control" cols="30" rows="4" required></textarea>';

  var cell3 = row.insertCell(2);
  cell3.innerHTML = '<select class="form-control" aria-label="Default select example" id="responsable' + (cont_prog - 1) + '" name="responsable[]"><option selected>Seleccione una opción</option>';
  $.get('/responsables', function (datos) {
    var id = "#responsable" + (cont_prog - 1);
    for (i = 0; i < datos.responsables.length; i++) {
      $("#responsable" + (cont_prog - 1)).append('<option value="' + datos.responsables[i].id + '">' + datos.responsables[i].nombre + ' - ' + datos.responsables[i].dependencia + '</option>');
    }
  })
  var cell4 = row.insertCell(3);
  var button = document.createElement("button");
  button.textContent = "--";
  button.type = "button";
  button.className = "btn btn-danger"
  cell4.appendChild(button);
  cell4.className = "text-center";

  button.addEventListener("click", () => {
    if (bandera_prog <= 2) {
      toastr.success("Debe tener como minimo una tematica", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    } else {
      event.target.parentNode.parentNode.remove();
      bandera_prog--;
    }
    console.log(bandera_prog)
  })
}

function eliminar_programacion(x) {
  if (bandera_prog <= 2) {
    toastr.success("Debe tener como minimo una tematica", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
  } else {
    console.log("Eliminar programacion")
    var table = document.getElementById("tabla_programacion");
    console.log(x)
    var row = table.deleteRow(x - 1);
    cont_prog--;
    bandera_prog--;

  }
  console.log(bandera_prog)

}



//=====================================================================Lista docentes

$(document).ready(function () {
  $("#tablaDocentes").dataTable({
    "language": { "url": "//cdn.datatables.net/plug-ins/1.11.4/i18n/es_es.json" },
    processing: true,
    serversite: true,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    ajax: {
      url: "/docentes",
    },
    success: function (response) {
      console.log("response");
    },
    columns: [
      { data: "id", className: "text-center" },
      { data: "fotoD", className: "fotoDocente" },
      { data: "nombre", className: "text-center" },
      { data: "correo", className: "text-center" },
      { data: "telefono", className: "text-center" },
      { data: "campo", className: "text-center" },
      { data: "estado", className: "text-center" },
      { data: "accion", orderable: false, className: "text-center" },
    ]
  });
});

//=============================================================================================Registrar Docente

$('#btnregDocente').click(function () {
  $.get('/docentes/form', function (datos) {
    const $campo = document.querySelector("#campo");
    for (let i = ($campo.options.length) + 1; i >= 0; i--) {
      $campo.remove(i);
    }
    $("#campo").append('<option value="" selected>Selecione un Campo</option>');
    for (i = 0; i < datos.campos.length; i++) {
      $("#campo").append('<option value="' + datos.campos[i].id + '">' + datos.campos[i].campo + '</option>');
    }
  })
})

var contProfesion = 2;
var banderaProfesion = 2;

function agregarProfesion() {
  contProfesion++;
  banderaProfesion++;
  var table = document.getElementById("tablaProfesion");
  var row = table.insertRow(table.rows.length);

  var cell2 = row.insertCell(0);
  cell2.innerHTML = '<textarea name="profesion[]" id="profesion" class="form-control" cols="30" rows="2" required></textarea>';

  var cell3 = row.insertCell(1);
  var button = document.createElement("button");
  button.textContent = "--";
  button.type = "button";
  button.className = "btn btn-danger"
  cell3.appendChild(button);
  cell3.className = "text-center";

  button.addEventListener("click", () => {
    if (banderaProfesion <= 2) {
      toastr.error("Debe tener como minimo una Profesión", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    } else {
      event.target.parentNode.parentNode.remove();
      banderaProfesion--;
    }
  })
}

function eliminarProfesion(x) {
  if (banderaProfesion <= 2) {
    toastr.error("Debe tener como minimo una Profesión", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
  } else {
    console.log("Eliminar Profesión")
    var table = document.getElementById("tablaProfesion");
    console.log(x)
    var row = table.deleteRow(x - 1);
    banderaProfesion--;

  }
}

$('#formregDocente').submit(function (e) {
  e.preventDefault();
  let = formData = new FormData($('#formregDocente')[0]);

  $.ajax({
    method: "POST",
    url: "/docentes/form",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      if (response == 0) {
        $('#formregDocente')[0].reset();
        $('#modalDocente').modal('hide');
        $('#tablaDocentes').DataTable().ajax.reload();
        toastr.success("El Docente se registro de forma correcta", 'Correcto',
          { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
      } else {
        Object.keys(response).forEach(key => toastr.error(response[key], 'Error',
          { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" }));
      }
    }
  });
});
//============================================================================Editar Docente
function agregarProfesionact() {
  var table = document.getElementById("tablaProfesionAct");
  var row = table.insertRow(table.rows.length);

  var cell2 = row.insertCell(0);
  cell2.innerHTML = '<input type="hidden" class="form-control" id="profesion_id" value="-1" name="profesion_id[]"><textarea name="profesionact[]" id="profesionact" class="form-control" cols="30" rows="2" required></textarea>';

  var cell3 = row.insertCell(1);
  var button = document.createElement("button");
  button.textContent = "--";
  button.type = "button";
  button.className = "btn btn-danger"
  cell3.appendChild(button);
  cell3.className = "text-center";

  button.addEventListener("click", () => {
    var n = 0;
    $("#tablaDoc tbody tr").each(function () {
      n++;
    });
    if (n <= 1) {
      toastr.error("Debe tener como minimo una Profesión", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    } else {
      event.target.parentNode.parentNode.remove();
    }
  })
}

function editarDocente(id) {
  $.get('/docente/form/' + id, function (datos,) {
    // $('#formActPro')[0].reset();
    console.log(datos.docente.foto)
    $('#docente_id').val(datos.docente.id);
    $('#id_disabled').val(datos.docente.id);
    $('#nombre_act').val(datos.docente.nombre);
    $('#correo_act').val(datos.docente.correo);
    $('#telefono_act').val(datos.docente.telefono);
    if (datos.docente.foto != '') {
      var div = document.querySelector("#fotoact");
      while (div.firstChild) {
        div.removeChild(div.firstChild);
      }
      $('#fotoact').append('<center><img id="foto_act" src="./images/docentes/' + datos.docente.foto + '" alt="" width="280" height="335"></center><br><input type="file" class="form-control" id="foto_act" name="foto_act">');
    } else {
      var div = document.querySelector("#fotoact");
      while (div.firstChild) {
        div.removeChild(div.firstChild);
      }
      $('#fotoact').append('<center><img id="foto_act" src="./avatar/avatar.png" alt="" width="280" height="335"></center><br><input type="file" class="form-control" id="foto_act" name="foto_act">');

    }
    const $campo = document.querySelector("#campo_act");
    for (let i = $campo.options.length; i >= 0; i--) {
      $campo.remove(i);
    }
    $("#campo_act").append('<option selected value="' + datos.docente.campo_id + '">' + datos.campos[(datos.docente.campo_id - 1)].campo + '</option>');
    for (i = 0; i < datos.campos.length; i++) {
      if (datos.docente.campo_id != datos.campos[i].id) {
        $("#campo_act").append('<option value="' + datos.campos[i].id + '">' + datos.campos[i].campo + '</option>');
      }
    }
    var table = document.getElementById("tablaProfesionAct");

    var n = 0;
    $("#tablaDoc tbody tr").each(function () {
      n++;
    });
    for (i = n - 1; i >= 0; i--) {
      $("#tablaDoc tbody tr:eq('" + i + "')").remove();
    };

    var x = 0;
    datos.profesiones.forEach(element => {
      x++;
      console.log(element)
      var row = table.insertRow(table.rows.length);

      var cell2 = row.insertCell(0);
      cell2.innerHTML = '<input type="hidden" class="form-control" id="profesion_id" value="' + element.id + '" name="profesion_id[]"><textarea name="profesionact[]" id="profesionact" class="form-control" cols="30" rows="2" required>' + element.estudios + '</textarea>';

      var cell3 = row.insertCell(1);
      var button = document.createElement("button");
      button.textContent = "--";
      button.type = "button";
      button.className = "btn btn-danger elim"
      cell3.appendChild(button);
      cell3.className = "text-center";

      button.addEventListener("click", () => {
        if (x <= 1) {
          toastr.error("Debe tener como minimo una Profesión", 'Error',
            { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
        } else {
          s = event.target.parentNode.parentNode;



          Swal.fire({
            title: 'Eliminar Registro',
            text: "¿Esta seguro que desea eliminar el registro?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: "/docente/delete/" + element.id,
                method: "GET",
                success: function (response) {
                  if (response == 0) {
                    s.remove();
                    x--;
                    toastr.success("Registro eliminado Correctamente", 'Correcto',
                      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
                  } else {
                    toastr.error("El registro no se elimino", 'Error',
                      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
                  }
                }
              });
            }
          })
        }
      })
    });
    $('#ModalDocenteAct').modal('toggle');
  })
}
$('#formDocenteAct').submit(function (e) {
  e.preventDefault();
  let = formAct = new FormData($('#formDocenteAct')[0]);
  var id = $('#docente_id').val();
  $.ajax({
    url: "/docente/actualizar/" + id,
    method: "POST",
    data: formAct,
    contentType: false,
    processData: false,
    success: function (response) {
      if (response == 0) {
        $('#ModalDocenteAct').modal('hide');
        $('#tablaDocentes').DataTable().ajax.reload();
        toastr.success("Docente actualizado correctamente", 'Correcto',
          { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
      } else {
        Object.keys(response).forEach(key => toastr.error(response[key], 'Error',
          { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" }));
      }
    }
  });
});

//=============================================================================================Desactivar Docente

var idDocente;
$(document).on('click', '.desDocente', function () {
  idDocente = $(this).attr('id');
  Swal.fire({
    title: 'Desactivar Docente',
    text: "¿Esta seguro que desea desactivar el Docente?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, desactivar!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "/docente/desactivar/" + idDocente,
        method: "GET",
        success: function (response) {
          if (response == 0) {
            $('#tablaDocentes').DataTable().ajax.reload();
            toastr.success("Registro Desactivado Correctamente", 'Correcto',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
          } else {
            toastr.error("El usuario no se desactivo", 'Error',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
          }
        }
      });
    }
  })
});

$(document).on('click', '.actDocente', function () {
  idDocente = $(this).attr('id');
  Swal.fire({
    title: 'Activar Docente',
    text: "¿Esta seguro que desea activar el Docente?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, activar!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "/docente/activar/" + idDocente,
        method: "GET",
        success: function (response) {
          if (response == 0) {
            $('#tablaDocentes').DataTable().ajax.reload();
            toastr.success("Registro Activado Correctamente", 'Correcto',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
          } else {
            toastr.error("El usuario no se activo", 'Error',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
          }
        }
      });
    }
  })
});
