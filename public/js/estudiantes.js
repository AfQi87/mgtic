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
      { data: "id", className: "text-center" },
      { data: "fotoD", className: "fotoDocente" },
      { data: "nombre", className: "text-center" },
      { data: "codigo", className: "text-center" },
      { data: "correo", className: "text-center" },
      { data: "corte", className: "text-center" },
      { data: "accion", orderable: false, className: "text-center" },
    ]
  });
});

//=======================================================================Agregar Estudiante
$('#formRegEstudiante').submit(function (e) {
  e.preventDefault();
  let = formData = new FormData($('#formRegEstudiante')[0]);

  $.ajax({
    method: "POST",
    url: "/estudiante/form",
    data: formData,
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
});

//=============================================================================================Eliminar Egresado
var idEst;
$(document).on('click', '.deleteEstudiante', function () {
  idEst = $(this).attr('id');
  Swal.fire({
    title: 'Eliminar Estudiante',
    text: "¿Esta seguro que desea eliminar el estudiante definitivamente?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, eliminar!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "/estudiante/delete/" + idEst,
        method: "GET",
        success: function (response) {
          if (response == 0) {
            $('#tablaEstudiantes').DataTable().ajax.reload();
            toastr.success("Registro Eliminado Correctamente", 'Correcto',
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
