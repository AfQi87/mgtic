//=====================================================================Lista Materias

$(document).ready(function () {
  $("#tablaAsignaciones").dataTable({
    "language": { "url": "//cdn.datatables.net/plug-ins/1.11.4/i18n/es_es.json" },
    processing: true,
    serversite: true,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    ajax: {
      url: "/asignacion",
    },
    success: function (response) {
      console.log("response");
    },
    columns: [
      { data: "docente", className: "text-center" },
      { data: "materia", className: "text-center" },
      { data: "corte", className: "text-center" },
      { data: "fecha_inicio", className: "text-center" },
      { data: "fecha_fin", className: "text-center" },
      { data: "num_resolucion", className: "text-center" },
      { data: "accion", orderable: false, className: "text-center" },
    ]
  });
});


//======================================================================================Agregar Materia
$('#formRegasignacion').submit(function (e) {
  e.preventDefault();
  let = formData = new FormData($('#formRegasignacion')[0]);

  var cont = 0;
  var docente;
  var inst = $('#formRegasignacion #docente').val();
  docente = $('#formRegasignacion #docentes').find('option[value="' + inst + '"]').data('ejemplo');
  if (docente == undefined) {
    toastr.error("Debe seleccionar un docente", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    cont++;
  }

  var materia;
  var mat = $('#formRegasignacion #materia').val();
  materia = $('#formRegasignacion #materias').find('option[value="' + mat + '"]').data('ejemplo');
  if (materia == undefined) {
    toastr.error("Debe seleccionar una materia", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    cont++;
  }

  var corte;
  var cort = $('#formRegasignacion #corte').val();
  corte = $('#formRegasignacion #cortes').find('option[value="' + cort + '"]').data('ejemplo');
  if (corte == undefined) {
    toastr.error("Debe seleccionar una corte", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    cont++;
  }

  if (cont == 0) {
    formData.append('docente', docente);
    formData.append('materia', materia);
    formData.append('corte', corte);
    $.ajax({
      method: "POST",
      url: "/asignacion/form",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response == 0) {
          $('.btn-close').click();
          $('#formRegasignacion')[0].reset();
          $('#tablaAsignaciones').DataTable().ajax.reload();
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
  }
});

//=============================================================================================Actualizar Corte
function editarAsignacion(id, mat) {
  $.get('/asignacion/form/' + id + '/' + mat, function (datos,) {
    console.log(datos.asignacion[0].nom_persona)

    $('#formActAsignacion #id_ced').val(datos.asignacion[0].ced_persona);
    $('#formActAsignacion #id_mat').val(datos.asignacion[0].id_materia);

    $('#formActAsignacion #docente').val(datos.asignacion[0].nom_persona);
    $('#formActAsignacion #materia').val(datos.asignacion[0].nom_materia);
    $('#formActAsignacion #corte').val(datos.asignacion[0].desc_cohorte);
    $('#formActAsignacion #fecha_inicio').val(datos.asignacion[0].fecha_inicio);
    $('#formActAsignacion #fecha_fin').val(datos.asignacion[0].fecha_fin);
    $('#formActAsignacion #numero_resolucion').val(datos.asignacion[0].num_resolucion);
    $('#formActAsignacion #fecha_resolucion').val(datos.asignacion[0].fecha_resolucion);

    $('#modalAsignacionAct').modal('toggle');
  })
}

$('#formActAsignacion').submit(function (e) {
  e.preventDefault();
  let = formData = new FormData($('#formActAsignacion')[0]);

  var cont = 0;
  var docente;
  var inst = $('#formActAsignacion #docente').val();
  docente = $('#formActAsignacion #docentes').find('option[value="' + inst + '"]').data('ejemplo');
  if (docente == undefined) {
    toastr.error("Debe seleccionar un docente", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    cont++;
  }

  var materia;
  var mat = $('#formActAsignacion #materia').val();
  materia = $('#formActAsignacion #materias').find('option[value="' + mat + '"]').data('ejemplo');
  if (materia == undefined) {
    toastr.error("Debe seleccionar una materia", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    cont++;
  }

  var corte;
  var cort = $('#formActAsignacion #corte').val();
  corte = $('#formActAsignacion #cortes').find('option[value="' + cort + '"]').data('ejemplo');
  if (corte == undefined) {
    toastr.error("Debe seleccionar una corte", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    cont++;
  }

  if (cont == 0) {
    formData.append('docente', docente);
    formData.append('materia', materia);
    formData.append('corte', corte);
    var ced = $('#formActAsignacion #id_ced').val();
    var mate = $('#formActAsignacion #id_mat').val();
    $.ajax({
      method: "POST",
      url: "/asignacion/actualizar/" + ced + "/" + mate,
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response == 0) {
          $('.btn-close').click();
          $('#formActAsignacion')[0].reset();
          $('#tablaAsignaciones').DataTable().ajax.reload();
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
  }
})

//=============================================================================================Desactivar Corte
var idMateria;
$(document).on('click', '.desAsignacion', function () {
  idDocente = $(this).attr('id');
  idMateria = $(this).attr('mat');

  Swal.fire({
    title: 'Eliminar Materia',
    text: "¿Esta seguro que desea eliminar la materia?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, eliminar!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "/asignacion/destroy/" + idDocente + "/" + idMateria,
        method: "GET",
        success: function (response) {
          if (response == 0) {
            $('#tablaAsignaciones').DataTable().ajax.reload();
            toastr.success("Registro Eliminado Correctamente", 'Correcto',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
          } else {
            toastr.error("La Asignacion no se elimino", 'Error',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
          }
        }
      });
    }
  })
});

