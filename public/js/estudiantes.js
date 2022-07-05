//=====================================================================Lista docentes
$(document).ready(function () {
  $("#tablaEstudiantes").dataTable({
    "language": { "url": "//cdn.datatables.net/plug-ins/1.11.4/i18n/es_es.json" },
    processing: true,
    serversite: true,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    ajax: {
      url: "/estudiantes",
    },
    success: function (response) {
      console.log("response");
    },
    columns: [
      { data: "ced_persona", className: "text-center" },
      { data: "fotoD", className: "fotoDocente" },
      { data: "nombre", className: "text-center" },
      { data: "codigo", className: "text-center" },
      { data: "correo", className: "text-center" },
      { data: "corte", className: "text-center" },
      { data: "accion", orderable: false, className: "text-center" },
    ]
  });
  $('#formActEstudiante #foto').change(function () {
    let reader = new FileReader();
    reader.onload = (e) => {
      $('#formActEstudiante #imagenSeleccionada').attr('src', e.target.result);
    }
    reader.readAsDataURL(this.files[0]);
  });
});

//=======================================================================Agregar Estudiante
$('#formRegEstudiante').submit(function (e) {
  e.preventDefault();
  let = formData = new FormData($('#formRegEstudiante')[0]);
  var cont = 0;
  $('#formRegEstudiante .institucion').each(function () {
    val_inst = $('#instituciones').find('option[value="' + $(this).val() + '"]').data('ejemplo');
    formData.append('instituciones[]', val_inst);

    if (val_inst == undefined) {
      toastr.error("Debe seleccionar una institucion", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
      cont++;
    }
  });
  $('#formRegEstudiante .profesion').each(async function () {
    val_prof = $('#profesiones').find('option[value="' + $(this).val() + '"]').data('ejemplo');
    formData.append('profesiones[]', val_prof);
    if (val_inst == undefined) {
      toastr.error("Debe seleccionar una institucion", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
      cont++;
    }
  });

  if (cont < 1) {
    var nacimiento;
    var barrio;
    var inst = $('#nacimiento').val();
    nacimiento = $('#nacimientos').find('option[value="' + inst + '"]').data('ejemplo');
    if (nacimiento == undefined) {
      toastr.error("Debe seleccionar un lugar de nacimiento", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
      cont++;
    }

    if (cont < 1) {
      formData.append('nacimiento', nacimiento);
      $.ajax({
        method: "POST",
        url: "/estudiante/form",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        success: function (response) {
          if (response == 0) {
            $('#formRegEstudiante')[0].reset();
            $('.btn-close').click();
            $('#tablaEstudiantes').DataTable().ajax.reload();
            toastr.success("El estudiante se registro de forma correcta", 'Correcto',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
          } else {
            Object.keys(response).forEach(key => toastr.error(response[key], 'Error',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" }));
          }
        }
      });
    }
  }
});

//=============================================================================================Actualizar Estudiante

function agregarProfesionact() {
  contprofesion++;

  var table = document.getElementById("tablaProfesionAct");
  var row = table.insertRow(table.rows.length);

  var cell1 = row.insertCell(0);
  cell1.innerHTML = '<input type="hidden" class="form-control" id="profesion" name="profesion[]"><input list="profesiones" autocomplete="off" id="profesionact' + contProfesion + '" name="profesionact[]" class="form-control profesionact" required placeholder="Busca/Selecciona">';

  var cell2 = row.insertCell(1);
  cell2.innerHTML = '<select class="form-select nivel" id="nivel' + contprofesion + '" required name="nivel[]" style="max-width: 250px" ><option selected>Seleccione una opción</option>';
  $.get('/niveles', function (datos) {
    for (i = 0; i < datos.niveles.length; i++) {
      $("#nivel" + (contprofesion)).append('<option value="' + datos.niveles[i].id_nivel + '">' + datos.niveles[i].desc_nivel + '</option>');
    }
  })

  var cell3 = row.insertCell(2);
  cell3.innerHTML = '<input list="instituciones" autocomplete="off" id="institucion' + contProfesion + '" name="institucion[]" class="form-control institucionact" required placeholder="Busca/Selecciona">';

  var cell3 = row.insertCell(3);
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
      toastr.error("Debe tener como minimo una Profesión", 'Error', { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    } else {
      event.target.parentNode.parentNode.remove();
    }
  })
}
var contprofesion = 0;


function delay(n, element) {
  return new Promise(function (resolve) {
    $.get('/niveles', function (data) {
      for (i = 0; i < data.niveles.length; i++) {
        if (element == data.niveles[i].id_nivel) {
          $("#formActEstudiante #nivel" + n).append('<option selected value="' + data.niveles[i].id_nivel + '">' + data.niveles[i].desc_nivel + '</option>');
        } else {
          $("#formActEstudiante #nivel" + n).append('<option value="' + data.niveles[i].id_nivel + '">' + data.niveles[i].desc_nivel + '</option>');
        }
      }
    })
    setTimeout(resolve, 1);
  });
}

function editarEstudiante(id) {
  contprofesion = 0;
  $.get('/estudiante/actu/' + id, function (datos) {
    // $('#formActPro')[0].reset();
    $('#formActEstudiante #tipo_doc').val(datos.estudiante.personas.tipo_doc);
    $('#formActEstudiante #documento').val(datos.estudiante.ced_persona);
    $('#formActEstudiante #nombre').val(datos.estudiante.personas.nom_persona);
    $('#formActEstudiante #correo').val(datos.estudiante.personas.email_persona);
    $('#formActEstudiante #fecha').val(datos.estudiante.personas.fecha_nac);
    $('#formActEstudiante #telefono').val(datos.estudiante.personas.tel_persona);
    $('#formActEstudiante #celular').val(datos.estudiante.personas.cel_persona);
    $('#formActEstudiante #codigo').val(datos.estudiante.codigo);
    $('#formActEstudiante #semestre').val(datos.estudiante.semestre);
    $('#formActEstudiante #direccion').val(datos.estudiante.personas.direccion);
    $('#formActEstudiante #corte').val(datos.estudiante.cohorte);
    $('#formActEstudiante #beca').val(datos.estudiante.beca);
    $('#formActEstudiante #sexo').val(datos.estudiante.personas.sexo);
    $('#formActEstudiante #estado_civil').val(datos.estudiante.personas.estado_civil);
    $('#formActEstudiante #tipo_sangre').val(datos.estudiante.personas.tipo_sangre);
    $('#formActEstudiante #tipo_sangre').val(datos.estudiante.personas.tipo_sangre);
    $('#formActEstudiante #nacimiento').val(datos.estudiante.personas.municipios.nom_municipio);
    if (datos.estudiante.personas.foto == null || datos.estudiante.personas.foto == '') {
      $('#formActEstudiante #imagenSeleccionada').attr('src', 'avatar/avatar.png');
    } else {
      $('#formActEstudiante #imagenSeleccionada').attr('src', 'images/estudiantes/' + datos.estudiante.personas.foto);
    }

    $('#formActEstudiante #estudio').val(datos.estudiante.personas.id_estudio);

    var table = document.getElementById("tablaProfesionAct");

    var n = 0;
    $("#tablaDoc tbody tr").each(function () {
      n++;
    });
    for (i = n - 1; i >= 0; i--) {
      $("#tablaDoc tbody tr:eq('" + i + "')").remove();
    };

    var x = 0;
    datos.profesiones.forEach(async function (element) {
      contprofesion++;
      x++;
      var row = table.insertRow(table.rows.length);
      var cell1 = row.insertCell(0);
      cell1.innerHTML = '<input type="hidden" class="form-control" id="profesion" value="' + element.id_estudio + '" name="profesion[]"><input list="profesiones" autocomplete="off" id="profesionact' + contprofesion + '" name="profesionact[]" class="form-control profesionact" required value="' + element.nom_estudio + '">';
      var cell2 = row.insertCell(1);
      cell2.innerHTML = '<select class="form-select" id="nivel' + contprofesion + '" required name="nivel[]" style="max-width: 250px" >';
      await delay(contprofesion, element.id_nivel);
      var cell3 = row.insertCell(2);
      cell3.innerHTML = '<input list="instituciones" autocomplete="off" id="institucion' + contprofesion + '" name="institucion[]" class="form-control institucionact" required value="' + element.nom_institucion + '">'
      var cell4 = row.insertCell(3);
      var button = document.createElement("button");
      button.textContent = "--";
      button.type = "button";
      button.className = "btn btn-danger elim"
      cell4.appendChild(button);
      cell4.className = "text-center";

      button.addEventListener("click", () => {
        if (x <= 1) {
          toastr.error("Debe tener como minimo una Profesión", 'Error', { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
        } else {
          s = event.target.parentNode.parentNode;
          Swal.fire({
            title: 'Eliminar Registro',
            text: "¿Esta seguro que desea eliminar el registro?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!',
            cancelButtonText: "Cancelar",
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: "/estudiante/delete/prof/" + element.id_estudio,
                method: "GET",
                success: function (response) {
                  console.log(response)
                  if (response == 0) {
                    s.remove();
                    x--;
                    toastr.success("Registro eliminado Correctamente", 'Correcto', { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
                  } else {
                    toastr.error("El registro no se elimino", 'Error', { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
                  }
                }
              });
            }
          })
        }
      })
    });
    $('#ModalEstudianteAct').modal('toggle');
  })
}

$('#formActEstudiante').submit(function (e) {
  e.preventDefault();
  let = formData = new FormData($('#formActEstudiante')[0]);
  var cont = 0;
  $('#formActEstudiante .institucionact').each(function () {
    val_inst = $('#instituciones').find('option[value="' + $(this).val() + '"]').data('ejemplo');
    formData.append('instituciones[]', val_inst);

    if (val_inst == undefined) {
      toastr.error("Debe seleccionar una institucion", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
      cont++;
    }
  });
  $('#formActEstudiante .profesionact').each(function () {
    val_inst = $('#profesiones').find('option[value="' + $(this).val() + '"]').data('ejemplo');
    formData.append('profesiones[]', val_inst);

    if (val_inst == undefined) {
      toastr.error("Debe seleccionar una profesion", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    }
  });
  if (cont < 1) {
    var nacimiento;
    var barrio;
    var inst = $('#formActEstudiante #nacimiento').val();
    nacimiento = $('#formActEstudiante #nacimientos').find('option[value="' + inst + '"]').data('ejemplo');
    if (nacimiento == undefined) {
      toastr.error("Debe seleccionar un lugar de nacimiento", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
      cont++;
    }
    if (cont < 1) {
      formData.append('nacimiento', nacimiento);
      formData.append('barrio', barrio);
      id = $('#formActEstudiante #documento').val();
      $.ajax({
        method: "POST",
        url: "/estudiante/act/" + id,
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        success: function (response) {
          if (response == 0) {
            $('#formActEstudiante')[0].reset();
            $('.btn-close').click();
            $('#tablaEstudiantes').DataTable().ajax.reload();
            toastr.success("Estudiante Actualizado de forma correcta", 'Correcto',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
          } else {
            Object.keys(response).forEach(key => toastr.error(response[key], 'Error',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" }));
          }
        }
      });
    }
  }
});

//=============================================================================================desactivar Estudiante
var idEst;
$(document).on('click', '.desEstudiante', function () {
  idEst = $(this).attr('id');
  Swal.fire({
    title: 'Desactivar Estudiante',
    text: "¿Esta seguro que desea desactivar el estudiante?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, desactivar!',
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "/estudiante/des/" + idEst,
        method: "GET",
        success: function (response) {
          if (response == 0) {
            $('#tablaEstudiantes').DataTable().ajax.reload();
            toastr.success("Registro desactivado Correctamente", 'Correcto',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
          } else {
            toastr.error("El estudiante no se desactivo", 'Error',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
          }
        },
        error: function () {
          toastr.error("Por favor vuelva a intentarlo mas tarde", 'Error',
            { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
        }
      });
    }
  })
});

//=============================================================================================activar Estudiante
var idEst;
$(document).on('click', '.actEstudiante', function () {
  idEst = $(this).attr('id');
  Swal.fire({
    title: 'Activar Estudiante',
    text: "¿Esta seguro que desea activar el estudiante?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, activar!',
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "/estudiante/act/" + idEst,
        method: "GET",
        success: function (response) {
          if (response == 0) {
            $('#tablaEstudiantes').DataTable().ajax.reload();
            toastr.success("Registro activado Correctamente", 'Correcto',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
          } else {
            toastr.error("El estudiante no se activo", 'Error',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
          }
        },
        error: function () {
          toastr.error("Por favor vuelva a intentarlo mas tarde", 'Error',
            { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
        }
      });
    }
  })
});
//================================================================Ver estudiante
function verEstudiante(id) {
  $.get('/estudiante/actu/' + id, function (datos) {
    if (datos.estudiante.personas.foto == null || datos.estudiante.personas.foto == '') {
      $('#fotoverest').attr('src', 'avatar/avatar.png');
    } else {
      $('#fotoverest').attr('src', 'images/estudiantes/' + datos.estudiante.personas.foto);
    }
    var div = document.querySelector("#datEstudiante");
    while (div.firstChild) {
      div.removeChild(div.firstChild);
    }
    $("#datEstudiante").append(
      '<h3 class="card-title">' + datos.estudiante.personas.nom_persona + '</h3>' +
      '<div class="row">' +
      '<div class="card-body col-sm-6  mt-2">' +
      '<p class="card-text">' + datos.estudiante.personas.tipodocs.nom_tipo + ' ' + datos.estudiante.personas.ced_persona + '</p>' +
      '<p class="card-text">Correo: ' + datos.estudiante.personas.email_persona + '</p>' +
      '<p class="card-text">Tel: ' + datos.estudiante.personas.tel_persona + '</p>' +
      '<p class="card-text">Cel: ' + datos.estudiante.personas.cel_persona + '</p>' +
      '<p class="card-text">Fecha nacimiento: ' + datos.estudiante.personas.fecha_nac + '</p>' +
      '<p class="card-text">Lugar nacimiento: ' + datos.estudiante.personas.municipios.nom_municipio + '</p>' +
      '<p class="card-text">Dirección: ' + datos.estudiante.personas.direccion + '</p>' +
      '</div>' +
      '<div class="card-body col-sm-6  mt-2">' +
      '<p class="card-text">Sexo: ' + datos.estudiante.personas.sexos.descripcion + '</p>' +
      '<p class="card-text">Estado Civil: ' + datos.estudiante.personas.estadocivil.descripcion + '</p>' +
      '<p class="card-text">Tipo sangre: ' + datos.estudiante.personas.tiposangre.descripcion + '</p>' +
      '<p class="card-text">Promocion: ' + datos.estudiante.cortes.desc_cohorte + '</p>' +
      '<p class="card-text">Beca: ' + datos.estudiante.becas.desc_beca + '</p>' +
      '<p class="card-text">Semestre: ' + datos.estudiante.semestre + '</p>' +
      '</div></div>'
    );
    var div = document.querySelector("#profVerEst");
    while (div.firstChild) {
      div.removeChild(div.firstChild);
    }
    datos.profesiones.forEach(function (element) {
      $("#profVerEst").append(
        '<li>' +
        '<div class="row">' +
        '<div class="col-sm-4">' +
        '<p>' + element.nom_estudio + '</p>' +
        '</div>' +
        '<div class="col-sm-4">' +
        '<p>' + element.desc_nivel + '</p>' +
        '</div>' +
        '<div class="col-sm-4">' +
        '<p>' + element.nom_institucion + '</p>' +
        '</div>' +
        '</div>' +
        '</li>'
      )
    })
  })
  $('#modalVerEstudiante').modal('toggle');
}