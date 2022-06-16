//=====================================================================Lista Materias

$(document).ready(function () {
  $("#tablaTrabGrado").dataTable({
    "language": { "url": "//cdn.datatables.net/plug-ins/1.11.4/i18n/es_es.json" },
    processing: true,
    serversite: true,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    ajax: {
      url: "/trabajos",
    },
    success: function (response) {
      console.log("response");
    },
    columns: [
      { data: "nom_tg", className: "text-center" },
      { data: "fecha_ins", className: "text-center" },
      { data: "estudiante", className: "text-center" },
      { data: "asesor", className: "text-center" },
      { data: "jurado1", className: "text-center" },
      { data: "jurado2", className: "text-center" },
      { data: "jurado3", className: "text-center" },
      { data: "accion", orderable: false, className: "text-center" },
    ]
  });
});


//======================================================================================Agregar Materia
$('#formRegTrabGrado').submit(function (e) {
  e.preventDefault();
  let = formData = new FormData($('#formRegTrabGrado')[0]);

  var cont = 0;
  var estudiante;
  var est = $('#formRegTrabGrado #estudiante').val();
  estudiante = $('#formRegTrabGrado #estudiantes').find('option[value="' + est + '"]').data('ejemplo');
  if (estudiante == undefined) {
    toastr.error("Debe seleccionar un estudiante", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    cont++;
  }

  var asesor;
  var ase = $('#formRegTrabGrado #asesor').val();
  asesor = $('#formRegTrabGrado #asesores').find('option[value="' + ase + '"]').data('ejemplo');
  if (asesor == undefined) {
    toastr.error("Debe seleccionar una asesor", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    cont++;
  }

  var jurado_1;
  var jur1 = $('#formRegTrabGrado #jurado_1').val();
  jurado_1 = $('#formRegTrabGrado #jurados_1').find('option[value="' + jur1 + '"]').data('ejemplo');
  if (jurado_1 == undefined) {
    toastr.error("Debe seleccionar un jurado_1", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    cont++;
  }

  var jurado_2;
  var jur2 = $('#formRegTrabGrado #jurado_2').val();
  jurado_2 = $('#formRegTrabGrado #jurados_2').find('option[value="' + jur1 + '"]').data('ejemplo');
  if (jurado_2 == undefined) {
    toastr.error("Debe seleccionar un jurado_2", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    cont++;
  }

  var jurado_3;
  var jur1 = $('#formRegTrabGrado #jurado_3').val();
  jurado_3 = $('#formRegTrabGrado #jurados_3').find('option[value="' + jur1 + '"]').data('ejemplo');
  if (jurado_3 == undefined) {
    toastr.error("Debe seleccionar un jurado_3", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    cont++;
  }

  if (cont == 0) {
    formData.append('estudiante', estudiante);
    formData.append('asesor', asesor);
    formData.append('jurado_1', jurado_1);
    formData.append('jurado_2', jurado_2);
    formData.append('jurado_3', jurado_3);
    $.ajax({
      method: "POST",
      url: "/trabajos/form",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response == 0) {
          $('.btn-close').click();
          $('#formRegTrabGrado')[0].reset();
          $('#tablaTrabGrado').DataTable().ajax.reload();
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
function editarTrabGrado(id) {
  $.get('/trabajos/form/' + id , function (datos,) {
    console.log(datos.trabajos)

    $('#formActTrabGrado #id_tg').val(datos.trabajos.id_tg);

    $('#formActTrabGrado #nombre').val(datos.trabajos.nom_tg);
    $('#formActTrabGrado #numero_acuerdo').val(datos.trabajos.num_acuerdo_jr);
    // $('#formActTrabGrado #acuerdo').val(datos.trabajos.acuerdo_js);
    $('#formActTrabGrado #fecha_inscripcion').val(datos.trabajos.fecha_ins);
    $('#formActTrabGrado #numero_acuerdo_inicio').val(datos.trabajos.num_acuerdo_apb);
    // $('#formActTrabGrado #acuerdo_inicio').val(datos.trabajos.acuerdo_apb);
    $('#formActTrabGrado #fecha_aprobacion').val(datos.trabajos.fecha_apb);
    $('#formActTrabGrado #fecha_entrega').val(datos.trabajos.fecha_ent);
    $('#formActTrabGrado #puntuacion').val(datos.trabajos.puntuacion);
    $('#formActTrabGrado #calificacion').val(datos.trabajos.calificacion);
    $('#formActTrabGrado #estado').val(datos.trabajos.estado);
    $('#formActTrabGrado #estudiante').val(datos.trabajos.estudiantes.personas.nom_persona);
    $('#formActTrabGrado #asesor').val(datos.trabajos.asesores.personas.nom_persona);
    $('#formActTrabGrado #jurado_1').val(datos.trabajos.jurados1.personas.nom_persona);
    $('#formActTrabGrado #jurado_2').val(datos.trabajos.jurados2.personas.nom_persona);
    $('#formActTrabGrado #jurado_3').val(datos.trabajos.jurados3.personas.nom_persona);

    $('#modalActTrabGrados').modal('toggle');
  })
}

$('#formActTrabGrado').submit(function (e) {
  e.preventDefault();
  let = formData = new FormData($('#formActTrabGrado')[0]);

  var cont = 0;
  var estudiante;
  var est = $('#formActTrabGrado #estudiante').val();
  estudiante = $('#formActTrabGrado #estudiantes').find('option[value="' + est + '"]').data('ejemplo');
  if (estudiante == undefined) {
    toastr.error("Debe seleccionar un estudiante", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    cont++;
  }

  var asesor;
  var ase = $('#formActTrabGrado #asesor').val();
  asesor = $('#formActTrabGrado #asesores').find('option[value="' + ase + '"]').data('ejemplo');
  if (asesor == undefined) {
    toastr.error("Debe seleccionar una asesor", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    cont++;
  }

  var jurado_1;
  var jur1 = $('#formActTrabGrado #jurado_1').val();
  jurado_1 = $('#formActTrabGrado #jurados_1').find('option[value="' + jur1 + '"]').data('ejemplo');
  if (jurado_1 == undefined) {
    toastr.error("Debe seleccionar un jurado_1", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    cont++;
  }

  var jurado_2;
  var jur2 = $('#formActTrabGrado #jurado_2').val();
  jurado_2 = $('#formActTrabGrado #jurados_2').find('option[value="' + jur1 + '"]').data('ejemplo');
  if (jurado_2 == undefined) {
    toastr.error("Debe seleccionar un jurado_2", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    cont++;
  }

  var jurado_3;
  var jur1 = $('#formActTrabGrado #jurado_3').val();
  jurado_3 = $('#formActTrabGrado #jurados_3').find('option[value="' + jur1 + '"]').data('ejemplo');
  if (jurado_3 == undefined) {
    toastr.error("Debe seleccionar un jurado_3", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    cont++;
  }

  if (cont == 0) {
    formData.append('estudiante', estudiante);
    formData.append('asesor', asesor);
    formData.append('jurado_1', jurado_1);
    formData.append('jurado_2', jurado_2);
    formData.append('jurado_3', jurado_3);

    var id_trabG = $('#formActTrabGrado #id_tg').val();
    $.ajax({
      method: "POST",
      url: "/trabajos/actualizar/" + id_trabG,
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response == 0) {
          $('.btn-close').click();
          $('#formActTrabGrado')[0].reset();
          $('#tablaTrabGrado').DataTable().ajax.reload();
          toastr.success("Se actualizo de forma correcta", 'Correcto',
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
