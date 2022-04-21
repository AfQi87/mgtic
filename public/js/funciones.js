


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
        $('.btn-close').click();
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
            toastr.error("El docente no se desactivo", 'Error',
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
            toastr.error("El docente no se activo", 'Error',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
          }
        }
      });
    }
  })
});

