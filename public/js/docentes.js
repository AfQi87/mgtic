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
      { data: "ced_persona", className: "text-center" },
      { data: "fotoD", className: "fotoDocente" },
      { data: "nombre", className: "text-center" },
      { data: "correo", className: "text-center" },
      { data: "telefono", className: "text-center" },
      { data: "tipos", className: "text-center" },
      { data: "accion", orderable: false, className: "text-center" },
    ]
  });
});

//=============================================================================================Registrar Docente
//======================================================================Area Conociomiento
var cArea = 2;
var bArea = 2;

function agregarArea() {
  cArea++;
  bArea++;
  var table = document.getElementById("tablaArea");
  var row = table.insertRow(table.rows.length);

  var cell1 = row.insertCell(0);
  cell1.innerHTML = '<input type="text" name="area_conocimiento[]" id="area_conocimiento" class="form-control" required>';

  var cell4 = row.insertCell(1);
  var button = document.createElement("button");
  button.textContent = "--";
  button.type = "button";
  button.className = "btn btn-danger"
  cell4.appendChild(button);
  cell4.className = "text-center";

  button.addEventListener("click", () => {
    if (bArea <= 2) {
      toastr.error("Debe tener como mínimo un Area de conocimiento", 'Error', { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    } else {
      event.target.parentNode.parentNode.remove();
    }
  })
}


function agregarAreaAct() {
  cArea++;
  bArea++;
  var table = document.getElementById("tablaAreaAct");
  var row = table.insertRow(table.rows.length);

  var cell1 = row.insertCell(0);
  cell1.innerHTML = '<input type="hidden" class="form-control" id="area_conocimientoact" name="area_conocimientoact[]"><input type="text" name="area_conocimiento[]" id="area_conocimiento" class="form-control" required>';

  var cell4 = row.insertCell(1);
  var button = document.createElement("button");
  button.textContent = "--";
  button.type = "button";
  button.className = "btn btn-danger"
  cell4.appendChild(button);
  cell4.className = "text-center";

  button.addEventListener("click", () => {
    if (bArea <= 2) {
      toastr.error("Debe tener como mínimo un Area de conocimiento", 'Error', { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    } else {
      event.target.parentNode.parentNode.remove();
    }
  })
}

function eliminarArea(x) {
  if (bArea <= 2) {
    toastr.error("Debe tener como mínimo un Area de conocimiento", 'Error', { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
  } else {
    var table = document.getElementById("tablaArea");
    console.log(x)
    var row = table.deleteRow(x - 1);
    bArea--;
  }
}

var contProfesion = 2;
var banderaProfesion = 2;

function agregarProfesion() {
  contProfesion++;
  banderaProfesion++;
  var table = document.getElementById("tablaProfesion");
  var row = table.insertRow(table.rows.length);

  var cell1 = row.insertCell(0);
  cell1.innerHTML = '<textarea name="profesion[]" id="profesion" class="form-control" cols="30" rows="1" required></textarea>';

  var cell2 = row.insertCell(1);
  cell2.innerHTML = '<select class="form-select nivel" id="nivel' + (contProfesion - 1) + '" required name="nivel[]" style="max-width: 250px" ><option selected>Seleccione una opción</option>';
  $.get('/niveles', function (datos) {
    for (i = 0; i < datos.niveles.length; i++) {
      $("#nivel" + (contProfesion - 1)).append('<option value="' + datos.niveles[i].id_nivel + '">' + datos.niveles[i].desc_nivel + '</option>');
    }
  })

  var cell3 = row.insertCell(2);
  cell3.innerHTML = '<input list="instituciones" autocomplete="off" id="institucion' + (contProfesion - 1) + '" name="institucion[]" class="form-control institucion" required placeholder="Busca/Selecciona">' +
    '<datalist name="instituciones[]" id="instituciones" class="instEgresado" onclick="selectProgram()" required>';

  var cell4 = row.insertCell(3);
  var button = document.createElement("button");
  button.textContent = "--";
  button.type = "button";
  button.className = "btn btn-danger"
  cell4.appendChild(button);
  cell4.className = "text-center";

  button.addEventListener("click", () => {
    if (banderaProfesion <= 2) {
      toastr.error("Debe tener como minimo una Profesión", 'Error', { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    } else {
      event.target.parentNode.parentNode.remove();
      banderaProfesion--;
    }
  })
}

function eliminarProfesion(x) {
  if (banderaProfesion <= 2) {
    toastr.error("Debe tener como minimo una Profesión", 'Error', { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
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
  var nacimiento;
  var barrio;
  var cont = 0;
  var inst = $('#nacimiento').val();
  nacimiento = $('#nacimientos').find('option[value="' + inst + '"]').data('ejemplo');
  if (nacimiento == undefined) {
    toastr.error("Debe seleccionar un lugar de nacimiento", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    cont++;
  }
  var prog = $('#barrio').val();
  barrio = $('#barrios').find('option[value="' + prog + '"]').data('ejemplo');
  if (barrio == undefined) {
    toastr.error("Debe seleccionar un barrio", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    cont++;
  }
  $('.institucion').each(function () {
    val_inst = $('#instituciones').find('option[value="' + $(this).val() + '"]').data('ejemplo');
    formData.append('instituciones[]', val_inst);

    if (val_inst == undefined) {
      toastr.error("Debe seleccionar una institucion", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
      cont++;
    }
  });

  if (cont == 0) {
    formData.append('nacimiento', nacimiento);
    formData.append('barrio', barrio);
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
          toastr.success("El Docente se registro de forma correcta", 'Correcto', { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
        } else {
          Object.keys(response).forEach(key => toastr.error(response[key], 'Error', { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" }));
        }
      }
    });
  }
});

//============================================================================Editar Docente
// function agregarProfesionact() {
//   var table = document.getElementById("tablaProfesionAct");
//   var row = table.insertRow(table.rows.length);

//   var cell2 = row.insertCell(0);
//   cell2.innerHTML = '<input type="hidden" class="form-control" id="profesion_id" value="-1" name="profesion_id[]"><textarea name="profesionact[]" id="profesionact" class="form-control" cols="30" rows="2" required></textarea>';

//   var cell3 = row.insertCell(1);
//   var button = document.createElement("button");
//   button.textContent = "--";
//   button.type = "button";
//   button.className = "btn btn-danger"
//   cell3.appendChild(button);
//   cell3.className = "text-center";

//   button.addEventListener("click", () => {
//     var n = 0;
//     $("#tablaDoc tbody tr").each(function () {
//       n++;
//     });
//     if (n <= 1) {
//       toastr.error("Debe tener como minimo una Profesión", 'Error', { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
//     } else {
//       event.target.parentNode.parentNode.remove();
//     }
//   })
// }
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
      console.log(contProfesion)
      event.target.parentNode.parentNode.remove();
    }
  })
}
var contprofesion = 0;
function niveles(n, element) {
  return new Promise(function (resolve) {
    $.get('/niveles', function (data) {
      console.log(data);
      for (i = 0; i < data.niveles.length; i++) {
        if (element == data.niveles[i].id_nivel) {
          $("#formActDocente #nivel" + n).append('<option selected value="' + data.niveles[i].id_nivel + '">' + data.niveles[i].desc_nivel + '</option>');
        } else {
          $("#formActDocente #nivel" + n).append('<option value="' + data.niveles[i].id_nivel + '">' + data.niveles[i].desc_nivel + '</option>');
        }
      }
    })
    setTimeout(resolve, 1);
  });
}

function editarDocente(id) {
  contprofesion = 0;
  $.get('/docente/form/' + id, function (datos) {
    $('#formActDocente #tipo_doc').val(datos.docente.personas.tipo_doc);
    $('#formActDocente #documento').val(datos.docente.ced_persona);
    $('#formActDocente #nombre').val(datos.docente.personas.nom_persona);
    $('#formActDocente #correo').val(datos.docente.personas.email_persona);
    $('#formActDocente #fecha').val(datos.docente.personas.fecha_nac);
    $('#formActDocente #telefono').val(datos.docente.personas.tel_persona);
    $('#formActDocente #celular').val(datos.docente.personas.cel_persona);
    $('#formActDocente #direccion').val(datos.docente.personas.direccion);
    $('#formActDocente #tipo').val(datos.docente.personas.tipo_doc);

    $('#formActDocente #sexo').val(datos.docente.personas.sexo);
    $('#formActDocente #estado_civil').val(datos.docente.personas.estado_civil);
    $('#formActDocente #tipo_sangre').val(datos.docente.personas.tipo_sangre);
    $('#formActDocente #tipo_sangre').val(datos.docente.personas.tipo_sangre);
    $('#formActDocente #nacimiento').val(datos.docente.personas.municipios.nom_municipio);
    $('#formActDocente #barrio').val(datos.docente.personas.barrios.nom_barrio);
    $('#formActDocente #descripcion').val(datos.docente.descripcion);
    $('#formActDocente #cvlac').val(datos.docente.cvlac);

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
      console.log('await');
      
      await niveles(contprofesion, element.id_nivel);

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
              console.log('elemento estudio: ' + element.id_estudio)
              $.ajax({
                url: "/docente/delete/prof/" + element.id_estudio,
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

    var table = document.getElementById("tablaAreaAct");

    var n = 0;
    $("#tablaAreaA tbody tr").each(function () {
      n++;
    });
    for (i = n - 1; i >= 0; i--) {
      $("#tablaAreaA tbody tr:eq('" + i + "')").remove();
    };

    var y = 0;
    datos.areas.forEach(function (element) {
      y++;
      var row = table.insertRow(table.rows.length);
      var cell1 = row.insertCell(0);
      cell1.innerHTML = '<input type="hidden" class="form-control" value="' + element.area_con + '" id="area_conocimientoact" name="area_conocimientoact[]"><input type="text" name="area_conocimiento[]" id="area_conocimiento" value="'+element.nom_area_con+'" class="form-control" required>';

      var cell4 = row.insertCell(1);
      var button = document.createElement("button");
      button.textContent = "--";
      button.type = "button";
      button.className = "btn btn-danger elim"
      cell4.appendChild(button);
      cell4.className = "text-center";

      button.addEventListener("click", () => {
        if (y <= 1) {
          toastr.error("Debe tener como minimo un area de conocimiento", 'Error', { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
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
                url: "/docente/delete/area/" + element.id_estudio,
                method: "GET",
                success: function (response) {
                  console.log(response)
                  if (response == 0) {
                    s.remove();
                    y--;
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
    $('#modalActDocente').modal('toggle');
  })
}

$('#formActDocente').submit(function (e) {
  e.preventDefault();
  let = formData = new FormData($('#formActDocente')[0]);
  var nacimiento;
  var barrio;
  var cont = 0;
  var inst = $('#formActDocente #nacimiento').val();
  nacimiento = $('#nacimientos').find('option[value="' + inst + '"]').data('ejemplo');
  if (nacimiento == undefined) {
    toastr.error("Debe seleccionar un lugar de nacimiento", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    cont++;
  }
  var prog = $('#formActDocente #barrio').val();
  barrio = $('#barrios').find('option[value="' + prog + '"]').data('ejemplo');
  if (barrio == undefined) {
    toastr.error("Debe seleccionar un barrio", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    cont++;
  }
  $('.institucionact').each(function () {
    val_inst = $('#instituciones').find('option[value="' + $(this).val() + '"]').data('ejemplo');
    formData.append('instituciones[]', val_inst);

    if (val_inst == undefined) {
      toastr.error("Debe seleccionar una institucion", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
      cont++;
    }
  });

  if (cont == 0) {
    formData.append('nacimiento', nacimiento);
    formData.append('barrio', barrio);

    var idDA = $('#formActDocente #documento').val();

    $.ajax({
      method: "POST",
      url: "/docente/actualizar/" + idDA,
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response == 0) {
          $('#formActDocente')[0].reset();
          $('.btn-close').click();
          $('#tablaDocentes').DataTable().ajax.reload();
          toastr.success("El Docente se actualizo de forma correcta", 'Correcto', { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
        } else {
          Object.keys(response).forEach(key => toastr.error(response[key], 'Error', { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" }));
        }
      }
    });
  }
});


//=============================================================================================Eliminar Docente
var idDoce;
$(document).on('click', '.deleteDocente', function () {
  idDoce = $(this).attr('id');
  Swal.fire({
    title: 'Eliminar Docente',
    text: "¿Esta seguro que desea eliminar el docente definitivamente?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, eliminar!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "/docente/delete/" + idDoce,
        method: "GET",
        success: function (response) {
          if (response == 0) {
            $('#tablaDocentes').DataTable().ajax.reload();
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
