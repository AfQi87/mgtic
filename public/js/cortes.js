//=====================================================================Lista Cortes

$(document).ready(function () {
  $("#tablaCortes").dataTable({
    "language": { "url": "//cdn.datatables.net/plug-ins/1.11.4/i18n/es_es.json" },
    processing: true,
    serversite: true,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    ajax: {
      url: "/cortes",
    },
    success: function (response) {
      console.log("response");
    },
    columns: [
      { data: "nombre", className: "text-center" },
      { data: "numEstudiantes", className: "text-center" },
      { data: "fecha_ini", className: "text-center correoCopiar" },
      { data: "fecha_fin", className: "text-center" },
      { data: "estado", className: "text-center" },
      { data: "accion", orderable: false, className: "text-center" },
    ]
  });
});

//=============================================================================================Registrar Corte
$('#formregCorte').submit(function (e) {
  e.preventDefault();
  let = formData = new FormData($('#formregCorte')[0]);

  $.ajax({
    method: "POST",
    url: "/corte/form",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      if (response == 0) {
        $('#formregCorte')[0].reset();
        $('.btn-close').click();
        $('#tablaCortes').DataTable().ajax.reload();
        toastr.success("Se registro la corte de forma correcta", 'Correcto',
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

//=============================================================================================Actualizar Corte
function editarCorte(id) {
  $.get('/corte/form/' + id, function (datos,) {
    console.log(datos)
    $('#id_corte').val(datos.corte.id);
    $('#id_corte_dis').val(datos.corte.id);
    $('#nombre_act').val(datos.corte.nombre);
    $('#fecha_inicio_act').val(datos.corte.fecha_ini);
    $('#fecha_finalizacion_act').val(datos.corte.fecha_fin);

    $('#ModalCorteAct').modal('toggle');
  })
}

$('#formActCorte').submit(function (e) {
  e.preventDefault();
  let = formAct = new FormData($('#formActCorte')[0]);
  var id = $('#id_corte').val();
  $.ajax({
    url: "/corte/actualizar/" + id,
    method: "POST",
    data: formAct,
    contentType: false,
    processData: false,
    success: function (response) {
      if (response == 0) {
        $('#ModalCorteAct').modal('hide');
        $('#tablaCortes').DataTable().ajax.reload();
        toastr.success("Corte actualizada correctamente", 'Correcto',
          { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
      } else {
        Object.keys(response).forEach(key => toastr.error(response[key], 'Error',
          { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" }));
      }
    }
  });
})

//=============================================================================================Desactivar Corte

var idCorte;
$(document).on('click', '.desCorte', function () {
  idCorte = $(this).attr('id');
  Swal.fire({
    title: 'Desactivar Corte',
    text: "¿Esta seguro que desea desactivar la corte?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, desactivar!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "/corte/desactivar/" + idCorte,
        method: "GET",
        success: function (response) {
          if (response == 0) {
            $('#tablaCortes').DataTable().ajax.reload();
            toastr.success("Registro Desactivado Correctamente", 'Correcto',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
          } else {
            toastr.error("El egresado no se desactivo", 'Error',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
          }
        }
      });
    }
  })
});

//=============================================================================================Activar Egresado

$(document).on('click', '.actCorte', function () {
  idCorte = $(this).attr('id');
  Swal.fire({
    title: 'Activar Egresado',
    text: "¿Esta seguro que desea activar la corte?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, activar!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "/corte/activar/" + idCorte,
        method: "GET",
        success: function (response) {
          if (response == 0) {
            $('#tablaCortes').DataTable().ajax.reload();
            toastr.success("Registro Activado Correctamente", 'Correcto',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
          } else {
            toastr.error("El egresado no se activo", 'Error',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
          }
        }
      });
    }
  })
});
