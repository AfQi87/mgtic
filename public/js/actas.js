$(document).ready(function () {

  $("#tablaActas").dataTable({
    "language": { "url": "//cdn.datatables.net/plug-ins/1.11.4/i18n/es_es.json" },
    processing: true,
    serversite: true,
  });
});
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

  var cell3 = row.insertCell(1);
  cell3.innerHTML = '<select class="form-control" aria-label="Default select example" id="responsable' + (cont_prog - 1) + '" name="responsable[]" required><option selected>Seleccione una opción</option>';
  $.get('/responsables', function (datos) {
    var id = "#responsable" + (cont_prog - 1);
    for (i = 0; i < datos.responsables.length; i++) {
      $("#responsable" + (cont_prog - 1)).append('<option value="' + datos.responsables[i].id + '">' + datos.responsables[i].nombre + ' - ' + datos.responsables[i].dependencia + '</option>');
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
