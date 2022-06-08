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
});

//=======================================================================Agregar Estudiante
$('#formRegEstudiante').submit(function (e) {
  e.preventDefault();
  let = formData = new FormData($('#formRegEstudiante')[0]);
  var cont = 0;
  $('.institucion').each(function () {
    val_inst = $('#instituciones').find('option[value="' + $(this).val() + '"]').data('ejemplo');
    formData.append('instituciones[]', val_inst);

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
      formData.append('nacimiento', nacimiento);
      formData.append('barrio', barrio);
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
  cell1.innerHTML = '<input type="hidden" class="form-control" id="profesion" name="profesion[]"><textarea name="profesionact[]" id="profesionact" class="form-control" cols="30" rows="1" required></textarea>';

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
      contprofesion--;
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
    $('#formActEstudiante #barrio').val(datos.estudiante.personas.barrios.nom_barrio);

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
      cell1.innerHTML = '<input type="hidden" class="form-control" id="profesion" value="' + element.id_estudio + '" name="profesion[]"><textarea name="profesionact[]" id="profesionact" class="form-control" cols="30" rows="1" required>' + element.nom_estudio + '</textarea>';
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
            confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
            if (result.isConfirmed) {
              console.log('elemento estudio: '+element.id_estudio)
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
  $('.institucionact').each(function () {
    val_inst = $('#instituciones').find('option[value="' + $(this).val() + '"]').data('ejemplo');
    formData.append('instituciones[]', val_inst);

    if (val_inst == undefined) {
      toastr.error("Debe seleccionar una institucion", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
      cont++;
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
    } else {
      var prog = $('#formActEstudiante #barrio').val();
      barrio = $('#formActEstudiante #barrios').find('option[value="' + prog + '"]').data('ejemplo');
      if (barrio == undefined) {
        toastr.error("Debe seleccionar un programa", 'Error',
          { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
        cont++;
      }
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

//=============================================================================================Eliminar Estudiante
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
