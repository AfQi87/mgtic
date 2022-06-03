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
  var cont = 0;
  var institucion = []
  $('.institucion').each(function () {
    val_inst = $('#instituciones').find('option[value="' + $(this).val() + '"]').data('ejemplo');
    institucion.push(val_inst)
    if (val_inst == undefined) {
      toastr.error("Debe seleccionar una institucion", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
      cont++;
    }
  });



  if (cont < 1) {
    // var documento = $("#documento").val();
    // var tipo_doc = $("#tipo_doc").val();
    // var nombre = $("#nombre").val();
    // var correo = $("#correo").val();
    // var telefono = $("#telefono").val();
    // var celular = $("#celular").val();
    // var sexo = $("#sexo").val();
    // var estado_civil = $("#estado_civil").val();
    // var tipo_sangre = $("#tipo_sangre").val();
    // var fecha = $("#fecha").val();
    // var lug_nacimiento = $("#nacimiento").val();
    // var direccion = $("#direccion").val();
    // var barrio = $("#barrio").val();
    // var codigo = $("#codigo").val();
    // var semestre = $("#semestre").val();
    // var corte = $("#corte").val();
    // var beca = $("#beca").val();

    // var nivel = $(".nivel").val();
    // var profesion = $("#telefono").val();
    // //

    // var _token = $("meta[name='csrf-token']").attr("content");

    var nacimiento;
    var barrio;
    var inst = $('#nacimiento').val();
    nacimiento = $('#nacimientos').find('option[value="' + inst + '"]').data('ejemplo');
    if (nacimiento == undefined) {
      toastr.error("Debe seleccionar un lugar de nacimiento", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
      cont++;
    } else {
      var prog = $('#barrio').val();
      barrio = $('#barrios').find('option[value="' + prog + '"]').data('ejemplo');
      if (barrio == undefined) {
        toastr.error("Debe seleccionar un programa", 'Error',
          { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
        cont++;
      }
    }
    if (cont < 1) {
      let = formData = new FormData($('#formRegEstudiante')[0]);
      formData.append('institucion', institucion);
      formData.append('nacimiento', nacimiento);
      formData.append('barrio', barrio);
      $.ajax({
        method: "POST",
        url: "/estudiante/form",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          console.log(response)
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
