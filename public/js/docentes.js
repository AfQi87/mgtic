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
  $('#formActDocente #foto').change(function () {
    let reader = new FileReader();
    reader.onload = (e) => {
      $('#formActDocente #imagenSeleccionada').attr('src', e.target.result);
    }
    reader.readAsDataURL(this.files[0]);
  });
});

//=============================================================================================Registrar Docente
//======================================================================Area Conociomiento
var cArea = 2;
var bArea = 2;

function agregarArea() {
  cArea++;
  bArea++;
  console.log(bArea)
  var table = document.getElementById("tablaArea");
  var row = table.insertRow(table.rows.length);

  var cell1 = row.insertCell(0);
  cell1.innerHTML = '<input list="area_conocimientos" autocomplete="off" id="area_conocimiento' + (contProfesion - 1) + '" name="area_conocimiento[]" class="form-control area_conocimiento" required placeholder="Busca/Selecciona">';

  var cell4 = row.insertCell(1);
  var button = document.createElement("button");
  button.textContent = "--";
  button.type = "button";
  button.className = "btn btn-danger"
  cell4.appendChild(button);
  cell4.className = "text-center";

  button.addEventListener("click", () => {
    console.log(bArea)
    if (bArea <= 2) {
      toastr.error("Debe tener como mínimo un Area de conocimiento", 'Error', { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    } else {
      event.target.parentNode.parentNode.remove();
      bArea--;
    }
  })
}


function agregarAreaAct() {
  cArea++;
  bArea++;
  var table = document.getElementById("tablaAreaAct");
  var row = table.insertRow(table.rows.length);

  var cell1 = row.insertCell(0);
  cell1.innerHTML = '<input type="hidden" class="form-control" id="area_conocimientoact" name="area_conocimientoact[]"><input list="area_conocimientos" autocomplete="off" id="area_conocimiento' + contProfesion + '" name="area_conocimiento[]" class="form-control area_conocimiento" required placeholder="Busca/Selecciona">';

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
      bArea--;
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
  cell1.innerHTML = '<input list="profesiones" autocomplete="off" id="profesion' + (contProfesion - 1) + '" name="profesion[]" class="form-control profesion" required placeholder="Busca/Selecciona">';

  var cell2 = row.insertCell(1);
  cell2.innerHTML = '<select class="form-select nivel" id="nivel' + (contProfesion - 1) + '" required name="nivel[]" style="max-width: 250px" ><option selected>Seleccione una opción</option>';
  $.get('/niveles', function (datos) {
    for (i = 0; i < datos.niveles.length; i++) {
      $("#nivel" + (contProfesion - 1)).append('<option value="' + datos.niveles[i].id_nivel + '">' + datos.niveles[i].desc_nivel + '</option>');
    }
  })

  var cell3 = row.insertCell(2);
  cell3.innerHTML = '<input list="instituciones" autocomplete="off" id="institucion' + (contProfesion - 1) + '" name="institucion[]" class="form-control institucion" required placeholder="Busca/Selecciona">';

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

function instituciones(n) {
  return new Promise(function (resolve) {
    if (n == undefined) {
      toastr.error("Debe seleccionar una institucion", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
      cont++;
    }
    setTimeout(resolve, 100);
  });
}
function profesiones(n) {
  return new Promise(function (resolve) {
    if (n == undefined) {
      toastr.error("Debe seleccionar una profesion", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
      cont++;
    }
    setTimeout(resolve, 100);
  });
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
  $('#formregDocente .institucion').each(async function () {
    val_inst = $('#instituciones').find('option[value="' + $(this).val() + '"]').data('ejemplo');
    formData.append('instituciones[]', val_inst);
    await instituciones(val_inst);
  });
  $('#formregDocente .profesion').each(async function () {
    val_prof = $('#profesiones').find('option[value="' + $(this).val() + '"]').data('ejemplo');
    formData.append('profesiones[]', val_prof);
    await profesiones(val_prof);
  });
  $('#formregDocente .area_conocimiento').each(async function () {
    val_prof = $('#area_conocimientos').find('option[value="' + $(this).val() + '"]').data('ejemplo');
    formData.append('area_conocimientos[]', val_prof);
    if (val_inst == undefined) {
      toastr.error("Debe seleccionar un area de conocimiento", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
      cont++;
    }
  });

  if (cont <= 1) {
    formData.append('nacimiento', nacimiento);
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
  cell1.innerHTML = '<input type="hidden" class="form-control" id="profesion" name="profesion[]"><input list="instituciones" autocomplete="off" id="profesionact' + contProfesion + '" name="profesionact[]" class="form-control profesionact" required placeholder="Busca/Selecciona">';

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
    $('#formActDocente #imagenSeleccionada').attr('src', 'images/docentes/' + datos.docente.personas.foto);
    $('#formActDocente #sexo').val(datos.docente.personas.sexo);
    $('#formActDocente #estado_civil').val(datos.docente.personas.estado_civil);
    $('#formActDocente #tipo_sangre').val(datos.docente.personas.tipo_sangre);
    $('#formActDocente #tipo_sangre').val(datos.docente.personas.tipo_sangre);
    $('#formActDocente #nacimiento').val(datos.docente.personas.municipios.nom_municipio);
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
      cell1.innerHTML = '<input type="hidden" class="form-control" id="profesion" value="' + element.id_estudio + '" name="profesion[]"><input list="profesiones" autocomplete="off" id="profesionact' + contprofesion + '" name="profesionact[]" class="form-control profesionact" required value="' + element.nom_estudio + '">';
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
            confirmButtonText: 'Si, eliminar!',
            cancelButtonText: "Cancelar",
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
      console.log(element)
      y++;
      var row = table.insertRow(table.rows.length);
      var cell1 = row.insertCell(0);
      cell1.innerHTML = '<input type="hidden" class="form-control" value="' + element.area_con + '" id="area_conocimientoact" name="area_conocimientoact[]"><input list="area_conocimientos" autocomplete="off" id="area_conocimiento' + contprofesion + '" name="area_conocimiento[]" class="form-control area_conocimiento" required value="' + element.nom_area_con + '">';

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
            confirmButtonText: 'Si, eliminar!',
            cancelButtonText: "Cancelar",
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: "/docente/delete/area/" + element.area_con,
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
  $('#formActDocente .institucionact').each(function () {
    val_inst = $('#instituciones').find('option[value="' + $(this).val() + '"]').data('ejemplo');
    formData.append('instituciones[]', val_inst);

    if (val_inst == undefined) {
      toastr.error("Debe seleccionar una institucion", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    }
  });
  $('#formActDocente .profesionact').each(function () {
    val_inst = $('#profesiones').find('option[value="' + $(this).val() + '"]').data('ejemplo');
    formData.append('profesiones[]', val_inst);

    if (val_inst == undefined) {
      toastr.error("Debe seleccionar una profesion", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    }
  });
  $('#formActDocente .area_conocimiento').each( function () {
    val_prof = $('#area_conocimientos').find('option[value="' + $(this).val() + '"]').data('ejemplo');
    formData.append('area_conocimientos[]', val_prof);
    if (val_inst == undefined) {
      toastr.error("Debe seleccionar un area de conocimiento", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
      cont++;
    }
  });
  if (cont == 0) {
    formData.append('nacimiento', nacimiento);

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


//=============================================================================================desactivar Docente
var idDoce;
$(document).on('click', '.desDocente', function () {
  idDoce = $(this).attr('id');
  Swal.fire({
    title: 'Desactivar Docente',
    text: "¿Esta seguro que desea desactivar el docente definitivamente?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, desactivar!',
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "/docente/des/" + idDoce,
        method: "GET",
        success: function (response) {
          if (response == 0) {
            $('#tablaDocentes').DataTable().ajax.reload();
            toastr.success("Registro desactivado Correctamente", 'Correcto',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
          } else {
            toastr.error("El docente no se desactivo", 'Error',
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

//=============================================================================================activar Docente
var idDoce;
$(document).on('click', '.actDocente', function () {
  idDoce = $(this).attr('id');
  Swal.fire({
    title: 'Activar Docente',
    text: "¿Esta seguro que desea activar el docente definitivamente?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, activar!',
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "/docente/act/" + idDoce,
        method: "GET",
        success: function (response) {
          if (response == 0) {
            $('#tablaDocentes').DataTable().ajax.reload();
            toastr.success("Registro activado Correctamente", 'Correcto',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
          } else {
            toastr.error("El docente no se activo", 'Error',
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


function verDocente(id) {
  $.get('/docente/form/' + id, function (datos) {
    if (datos.docente.personas.foto == null || datos.docente.personas.foto == '') {
      $('#fotoverdoc').attr('src', 'avatar/avatar.png');
    } else {
      $('#fotoverdoc').attr('src', 'images/docentes/' + datos.docente.personas.foto);
    }
    var div = document.querySelector("#datDocente");
    while (div.firstChild) {
      div.removeChild(div.firstChild);
    }
    $("#datDocente").append(
      '<h3 class="card-title">' + datos.docente.personas.nom_persona + '</h3>' +
      '<div class="row">' +
      '<div class="card-body col-sm-6  mt-2">' +
      '<p class="card-text">' + datos.docente.personas.tipodocs.nom_tipo + ' ' + datos.docente.personas.ced_persona + '</p>' +
      '<p class="card-text">Correo: ' + datos.docente.personas.email_persona + '</p>' +
      '<p class="card-text">Tel: ' + datos.docente.personas.tel_persona + '</p>' +
      '<p class="card-text">Cel: ' + datos.docente.personas.cel_persona + '</p>' +
      '<p class="card-text">Fecha nacimiento: ' + datos.docente.personas.fecha_nac + '</p>' +
      '<p class="card-text">Lugar nacimiento: ' + datos.docente.personas.municipios.nom_municipio + '</p>' +
      '<p class="card-text">Dirección: ' + datos.docente.personas.direccion + '</p>' +
      '<p class="card-text">Sexo: ' + datos.docente.personas.sexos.descripcion + '</p>' +
      '</div>' +
      '<div class="card-body col-sm-6  mt-2">' +
      '<p class="card-text">Estado Civil: ' + datos.docente.personas.estadocivil.descripcion + '</p>' +
      '<p class="card-text">Tipo sangre: ' + datos.docente.personas.tiposangre.descripcion + '</p>' +
      '<p class="card-text">Tipo docente: ' + datos.docente.tipos.tipo + '</p>' +
      '<p class="card-text" style="overflow-y: scroll; max-height: 80px">Descripcion: ' + datos.docente.descripcion + ' </p>' +
      '<p class="card-text" style="overflow-y: scroll; max-height: 80px">CVLAC: ' + datos.docente.cvlac + ' </p>' +
      '</div></div>'
    );
    var div = document.querySelector("#profVer");
    while (div.firstChild) {
      div.removeChild(div.firstChild);
    }
    datos.profesiones.forEach(function (element) {
      $("#profVer").append(
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
    var div = document.querySelector("#areaVer");
    while (div.firstChild) {
      div.removeChild(div.firstChild);
    }
    datos.areas.forEach(function (element) {
      $("#areaVer").append(
        '<li>' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        '<p>' + element.nom_area_con + '</p>' +
        '</div>' +
        '</div>' +
        '</li>'
      )
    })
  })
  $('#modalVerDocente').modal('toggle');
}