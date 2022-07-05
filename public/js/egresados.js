//=====================================================================Lista Egresados

// $(document).ready(function () {
//   $("#tablaEgresados").dataTable({
//     "language": { "url": "//cdn.datatables.net/plug-ins/1.11.4/i18n/es_es.json" },
//     headers: {
//       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     },
//     "serveSide": true,
//     ajax: {
//       url: "/api/egresados",
//     },
//     columns: [
//       { data: "ced_persona", className: "text-center" },
//       { data: "nombre", className: "text-center" },
//       { data: "ced_persona", className: "text-center correoCopiar" },
//       { data: "ced_persona", className: "text-center" },
//       { data: "ced_persona", className: "text-center" },
//       { data: "ced_persona", className: "text-center" },
//       { data: "btn", className: "text-center" },
//     ]
//   });
// });
$(document).ready(function () {
  $('#tablaEgresados').DataTable({
    "language": { "url": "//cdn.datatables.net/plug-ins/1.11.4/i18n/es_es.json" },
    processing: true,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    "serverSide": true,
    "ajax": "api/egresados",
    "columns": [
      { data: "ced_persona", className: "text-center" },
      { data: "nombre", className: "text-center" },
      { data: "correo", className: "text-center correoCopiar" },
      { data: "telefono", className: "text-center" },
      { data: "institucion", className: "text-center" },
      { data: "programa", className: "text-center" },
      { data: "estado", className: "text-center" },
      { data: "btn", className: "text-center" },
    ]
  });
});
//================================================================================================Registrar Egresado
$("#institucion").on('input', function () {
  var val = $('#formregEgresado #institucion').val();
  var ejemplo = $('#formregEgresado #instituciones').find('option[value="' + val + '"]').data('ejemplo');
  if (ejemplo != undefined) {
    console.log(ejemplo);
    $.get('/egresados/programas/' + ejemplo, function (datos,) {
      var div = document.querySelector("#formregEgresado .programa");
      while (div.firstChild) {
        div.removeChild(div.firstChild);
      }
      console.log(datos);
      $('#formregEgresado .programa').append('<label class="form-label" for="programa">Programa</label><input autocomplete="off" list="programas" name="programa"  id="programa" class="form-control" placeholder="Busca / Selecciona"><datalist name="programas" id="programas" class="progEgresado">')
      datos.programas.forEach(element => {
        console.log(element);
        $('#formregEgresado #programas').append('<option data-ejemplo="' + element.id_programa + '" value="' + element.nom_programa + '"></option>')
      });
    });
  }
});
$(document).on('click', '.cerrar', function () {
  $('#formregEgresado')[0].reset();
  var div = document.querySelector(".programa");
  while (div.firstChild) {
    div.removeChild(div.firstChild);
  }
});

$('#formregEgresado').submit(function (e) {
  e.preventDefault();
  let = formData = new FormData($('#formregEgresado')[0]);

  var inst = $('#institucion').val();
  var val_inst = $('#instituciones').find('option[value="' + inst + '"]').data('ejemplo');
  if (val_inst == undefined) {
    toastr.error("Debe seleccionar una institucion", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
  } else {
    var prog = $('#programa').val();
    var val_prog = $('#programas').find('option[value="' + prog + '"]').data('ejemplo');
    formData.append('programa_id', val_prog);

    if (val_prog == undefined) {
      toastr.error("Debe seleccionar un programa", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    }
  }
  $.ajax({
    method: "POST",
    url: "/egresados/form",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      if (response == 0) {
        $('.btn-close').click();
        $('#formregEgresado')[0].reset();
        $('#tablaEgresados').DataTable().ajax.reload();
        toastr.success("Se registro de forma correcta", 'Correcto',
          { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
      } else {
        Object.keys(response).forEach(key => toastr.error(response[key], 'Error',
          { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" }));
      }
    },
    error: function () {
      toastr.error("Por favor vuelva a intentarlo mas tarde", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    }
  });
});

//=============================================================================Actualizar Egresado
function editarEgresado(id) {

  $.get('/egresados/form/' + id, function (datos) {
    console.log(datos);
    $('#formEgresadoAct #tipo_doc').val(datos.egresado.personas.tipo_doc);
    $('#formEgresadoAct #documento').val(datos.egresado.ced_persona);
    $('#formEgresadoAct #nombre').val(datos.egresado.personas.nom_persona);
    $('#formEgresadoAct #correo').val(datos.egresado.personas.email_persona);
    $('#formEgresadoAct #telefono').val(datos.egresado.personas.tel_persona);
    $('#formEgresadoAct #celular').val(datos.egresado.personas.cel_persona);

    $('#formActEstudiante #estudio').val(datos.egresado.personas.id_estudio);

    $('#institucionAct').val(datos.institucion);
    var div = document.querySelector(".programaAct");
    while (div.firstChild) {
      div.removeChild(div.firstChild);
    }
    $('.programaAct').append('<label class="form-label" for="institucion">Programa</label><input list="programasAct" autocomplete="off" id="programaAct" name="programa" class="form-control"><datalist name="programas" id="programasAct" class="instEgresado">')
    $('#programaAct').val(datos.programa);
    datos.programas.forEach(element => {
      $('#programasAct').append('<option data-ejemplo="' + element.id_programa + '" value="' + element.nom_programa + '"></option>')
    });
    $('#ModalEgresadoAct').modal('toggle');
  });
}
$("#institucionAct").on('input', function () {
  var val = $('#institucionAct').val();
  var ejemplo = $('#institucionesAct').find('option[value="' + val + '"]').data('ejemplo');
  if (ejemplo != undefined) {
    console.log(ejemplo);
    $.get('/egresados/programas/' + ejemplo, function (datos,) {
      var div = document.querySelector(".programaAct");
      while (div.firstChild) {
        div.removeChild(div.firstChild);
      }
      console.log(datos);
      $('.programaAct').append('<label class="form-label" for="programaAct">Programa</label><input list="programasAct" autocomplete="off" id="programaAct" name="programaAct" class="form-control"><datalist name="programas" id="programasAct" class="instEgresado">')
      datos.programas.forEach(element => {
        console.log(element);
        $('#programasAct').append('<option data-ejemplo="' + element.id_programa + '" value="' + element.nom_programa + '"></option>')
      });
    });
  }
});

$('#formEgresadoAct').submit(function (e) {
  e.preventDefault();

  var id = $('#formEgresadoAct #documento').val();
  let = formData = new FormData($('#formEgresadoAct')[0]);
  var inst = $('#institucionAct').val();
  var val_inst = $('#institucionesAct').find('option[value="' + inst + '"]').data('ejemplo');
  if (val_inst == undefined) {
    toastr.error("Debe seleccionar una institucion", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
  } else {
    var prog = $('#programaAct').val();
    var val_prog = $('#programasAct').find('option[value="' + prog + '"]').data('ejemplo');
    if (val_prog == undefined) {
      toastr.error("Debe seleccionar un programa", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    }
  }

  formData.append('programa_id', val_prog);
  $.ajax({
    url: "/egresado/actualizar/" + id,
    method: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      if (response == 0) {
        $('#ModalEgresadoAct').modal('hide');
        $('#tablaEgresados').DataTable().ajax.reload();
        toastr.success("Se actualizo correctamente", 'Correcto',
          { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
      } else {
        Object.keys(response).forEach(key => toastr.error(response[key], 'Error',
          { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" }));
      }
    },
    error: function () {
      toastr.error("Por favor vuelva a intentarlo mas tarde", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    }
  });
});

//=============================================================Copiar correos Egresados
function copiarCorreo() {
  var aux = document.createElement("input");
  var tabla = $("#tablaEgresados tbody tr");
  var total = '';
  var correo = 0;
  $("#tablaEgresados tbody tr").each(function () {
    total += tabla.find("td:eq(2)")[correo].innerHTML + ';';
    correo++
  });
  aux.setAttribute("value", total);
  document.body.appendChild(aux);
  aux.select();
  document.execCommand("copy");
  document.body.removeChild(aux);
  Swal.fire(
    'Correcto',
    'los correos se copiaron correctamente',
    'success'
  )
}

var idEgresado;
//=============================================================================================Desactivar Egresado

$(document).on('click', '.desEgresado', function () {
  idEgresado = $(this).attr('id');
  Swal.fire({
    title: 'Desactivar Egresado',
    text: "¿Esta seguro que desea desactivar el egresado?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, desactivar!',
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "/egresado/des/" + idEgresado,
        method: "GET",
        success: function (response) {
          if (response == 0) {
            $('#tablaEgresados').DataTable().ajax.reload();
            toastr.success("Registro desactivado Correctamente", 'Correcto',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
          } else {
            toastr.error("El egresado no se desactivo", 'Error',
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


//=============================================================================================Activar Egresado

$(document).on('click', '.actEgresado', function () {
  idEgresado = $(this).attr('id');
  Swal.fire({
    title: 'Activar Egresado',
    text: "¿Esta seguro que desea activar el egresado?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, activar!',
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "/egresado/act/" + idEgresado,
        method: "GET",
        success: function (response) {
          if (response == 0) {
            $('#tablaEgresados').DataTable().ajax.reload();
            toastr.success("Registro activado Correctamente", 'Correcto',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
          } else {
            toastr.error("El egresado no se actvo", 'Error',
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