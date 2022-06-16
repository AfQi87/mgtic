$(document).ready(function () {

  $("#tablaActas").dataTable({
    "language": { "url": "//cdn.datatables.net/plug-ins/1.11.4/i18n/es_es.json" },
    processing: true,
    serversite: true,
  });
});

$('#acta').submit(function (e) {
  e.preventDefault();
  if ($('.asistente').is(':checked')) {
    this.submit();
  } else {
    toastr.error("Debe tener como minimo una asistente", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
  }
});
$('#actaComite').submit(function (e) {
  e.preventDefault();
  if ($('.asistente').is(':checked')) {
    this.submit();
  } else {
    toastr.error("Debe tener como minimo una asistente", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
  }
});


$(".confirmar").submit(function (e) {
  e.preventDefault();
  Swal.fire({
    title: 'Esta seguro?',
    text: "Desea eliminar el acta?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, Eliminar'
  }).then((result) => {
    if (result.isConfirmed) {
      this.submit();
    }
  })
})


function validar(){
  Swal.fire({
    title: 'Desactivar usuario',
    text: "¿Esta seguro que desea desactivar el usuario?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, desactivar!'
  }).then((result) => {
    if (result.isConfirmed) {
      alert("sii");
    }
  })
}

cont = 2;
var bandera_conclusion = 2;
function agregar_conclusion() {
  cont++;
  bandera_conclusion++;
  console.log("Agregar Conclusion")
  var table = document.getElementById("tabla_conclusiones");
  var row = table.insertRow(table.rows.length);

  var cell2 = row.insertCell(0);
  cell2.innerHTML = '<textarea name="conclusion[]" id="conclusion" class="form-control" cols="30" rows="4" required></textarea>';

  var cell3 = row.insertCell(1);
  var button = document.createElement("button");
  button.textContent = "--";
  button.type = "button";
  button.className = "btn btn-danger"
  cell3.appendChild(button);
  cell3.className = "text-center";

  button.addEventListener("click", () => {
    if (bandera_conclusion <= 2) {
      toastr.error("Debe tener como minimo una conclusión", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    } else {
      event.target.parentNode.parentNode.remove();
      bandera_conclusion--;
    }
  })
}

function eliminar_conclusion(x) {
  if (bandera_conclusion <= 2) {
    toastr.error("Debe tener como minimo una conclusión", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
  } else {
    var table = document.getElementById("tabla_conclusiones");
    console.log(x)
    var row = table.deleteRow(x - 1);
    cont--;
    bandera_conclusion--;

  }
}

var cont_prog = 2;
var bandera_prog = 2;
function agregar_programacion() {
  cont_prog++;
  bandera_prog++;
  console.log("Agregar Programacion")
  var table = document.getElementById("tabla_programacion");
  var row = table.insertRow(table.rows.length);

  var cell2 = row.insertCell(0);
  cell2.innerHTML = '<textarea name="tematica[]" id="tematica" class="form-control" cols="30" rows="4" required></textarea>';

  var cell4 = row.insertCell(1);
  var button = document.createElement("button");
  button.textContent = "--";
  button.type = "button";
  button.className = "btn btn-danger"
  cell4.appendChild(button);
  cell4.className = "text-center";

  button.addEventListener("click", () => {
    if (bandera_prog <= 2) {
      toastr.error("Debe tener como minimo una tematica", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    } else {
      event.target.parentNode.parentNode.remove();
      bandera_prog--;
    }
    console.log(bandera_prog)
  })
}

function eliminar_programacion(x) {
  if (bandera_prog <= 2) {
    toastr.error("Debe tener como minimo una tematica", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
  } else {
    console.log("Eliminar programacion")
    var table = document.getElementById("tabla_programacion");
    console.log(x)
    var row = table.deleteRow(x - 1);
    cont_prog--;
    bandera_prog--;

  }
  console.log(bandera_prog)
}

var cont_tarea = 2;
var bandera_tarea = 2;
function agregar_tarea() {
  cont_tarea++;
  bandera_tarea++;
  var table = document.getElementById("tabla_tarea");
  var row = table.insertRow(table.rows.length);

  var cell2 = row.insertCell(0);
  cell2.innerHTML = '<textarea name="tarea[]" id="tarea" class="form-control" cols="90" rows="3" required></textarea>';

  var cell3 = row.insertCell(1);
  cell3.innerHTML = '<select class="form-control" aria-label="Default select example" id="responsable' + (cont_tarea - 1) + '" name="responsable[]" required><option selected>Seleccione una opción</option>';
  $.get('/responsables', function (datos) {
    var id = "#responsable" + (cont_tarea - 1);
    for (i = 0; i < datos.responsables.length; i++) {
      $("#responsable" + (cont_tarea - 1)).append('<option value="' + datos.responsables[i].persona + '">' + datos.responsables[i].nom_persona + "-" + datos.responsables[i].desc_cargo + '</option>');
    }
  })
  var cell4 = row.insertCell(2);
  var button = document.createElement("button");
  button.textContent = "--";
  button.type = "button";
  button.className = "btn btn-danger"
  cell4.appendChild(button);
  cell4.className = "text-center";

  button.addEventListener("click", () => {
    if (bandera_tarea <= 2) {
      toastr.error("Debe tener como minimo una tarea", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    } else {
      event.target.parentNode.parentNode.remove();
      bandera_tarea--;
    }
  })
}

function eliminar_tarea(x) {
  if (bandera_tarea <= 2) {
    toastr.error("Debe tener como minimo una tarea", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
  } else {
    var table = document.getElementById("tabla_tarea");
    console.log(x)
    var row = table.deleteRow(x - 1);
    cont_tarea--;
    bandera_tarea--;
  }
}
//======================================================================================================TareaComite
var cont_tarea = 2;
var bandera_tarea = 2;
function agregar_tareaC() {
  cont_tarea++;
  bandera_tarea++;
  var table = document.getElementById("tabla_tarea");
  var row = table.insertRow(table.rows.length);

  var cell2 = row.insertCell(0);
  cell2.innerHTML = '<textarea name="tarea[]" id="tarea" class="form-control" cols="90" rows="3" required></textarea>';

  var cell3 = row.insertCell(1);
  cell3.innerHTML = '<select class="form-control" aria-label="Default select example" id="responsable' + (cont_tarea - 1) + '" name="responsable[]" required><option selected>Seleccione una opción</option>';
  $.get('/responsablesComite', function (datos) {
    var id = "#responsable" + (cont_tarea - 1);
    for (i = 0; i < datos.responsables.length; i++) {
      $("#responsable" + (cont_tarea - 1)).append('<option value="' + datos.responsables[i].persona + '">' + datos.responsables[i].nom_persona + "-" + datos.responsables[i].desc_cargo + '</option>');
    }
  })
  var cell4 = row.insertCell(2);
  var button = document.createElement("button");
  button.textContent = "--";
  button.type = "button";
  button.className = "btn btn-danger"
  cell4.appendChild(button);
  cell4.className = "text-center";

  button.addEventListener("click", () => {
    if (bandera_tarea <= 2) {
      toastr.error("Debe tener como minimo una tarea", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    } else {
      event.target.parentNode.parentNode.remove();
      bandera_tarea--;
    }
  })
}

function eliminar_tareaC(x) {
  if (bandera_tarea <= 2) {
    toastr.error("Debe tener como minimo una tarea", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
  } else {
    var table = document.getElementById("tabla_tarea");
    console.log(x)
    var row = table.deleteRow(x - 1);
    cont_tarea--;
    bandera_tarea--;
  }
}
