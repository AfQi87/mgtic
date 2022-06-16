//=====================================================================Lista Materias

$(document).ready(function () {
  $("#tablaMaterias").dataTable({
    "language": { "url": "//cdn.datatables.net/plug-ins/1.11.4/i18n/es_es.json" },
    processing: true,
    serversite: true,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    ajax: {
      url: "/materias",
    },
    success: function (response) {
      console.log("response");
    },
    columns: [
      { data: "nom_materia", className: "text-center" },
      { data: "num_creditos", className: "text-center" },
      { data: "semestre", className: "text-center" },
      { data: "area", className: "text-center" },
      { data: "accion", orderable: false, className: "text-center" },
    ]
  });
});

//======================================================================================Agregar Materia
$('#formRegMateria').submit(function (e) {
  e.preventDefault();
  let = formData = new FormData($('#formRegMateria')[0]);

  var area;
  var inst = $('#formRegMateria #area').val();
  area = $('#formRegMateria #areas').find('option[value="' + inst + '"]').data('ejemplo');
  if (area == undefined) {
    toastr.error("Debe seleccionar un area", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    cont++;
  } else {
    formData.append('area', area);
    $.ajax({
      method: "POST",
      url: "/materia/form",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response == 0) {
          $('.btn-close').click();
          $('#formRegMateria')[0].reset();
          $('#tablaMaterias').DataTable().ajax.reload();
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
function editarMateria(id) {
  $.get('/materia/form/' + id, function (datos,) {
    console.log(datos)
    $('#formActMateria #id_materia').val(datos.materia.id_materia);
    $('#formActMateria #nombre').val(datos.materia.nom_materia);
    $('#formActMateria #semestre').val(datos.materia.num_creditos);
    $('#formActMateria #creditos').val(datos.materia.semestre);
    $('#formActMateria #area').val(datos.materia.areas.nom_area_form);

    $('#modalMateriaAct').modal('toggle');
  })
}

$('#formActMateria').submit(function (e) {
  e.preventDefault();
  let = formAct = new FormData($('#formActMateria')[0]);
  var id = $('#formActMateria #id_materia').val();

  var area;
  var inst = $('#formActMateria #area').val();
  area = $('#formActMateria #areas').find('option[value="' + inst + '"]').data('ejemplo');
  if (area == undefined) {
    toastr.error("Debe seleccionar un area", 'Error',
      { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    cont++;
  } else {
    formAct.append('area', area);
    $.ajax({
      url: "/materia/actualizar/" + id,
      method: "POST",
      data: formAct,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response == 0) {
          $('#modalMateriaAct').modal('hide');
          $('#tablaMaterias').DataTable().ajax.reload();
          toastr.success("Materia actualizada correctamente", 'Correcto',
            { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
        } else {
          Object.keys(response).forEach(key => toastr.error(response[key], 'Error',
            { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" }));
        }
      }
    });
  }
})

//=============================================================================================Desactivar Corte
var idMateria;
$(document).on('click', '.desMateria', function () {
  idMateria = $(this).attr('id');
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
        url: "/materia/destroy/" + idMateria,
        method: "GET",
        success: function (response) {
          if (response == 0) {
            $('#tablaMaterias').DataTable().ajax.reload();
            toastr.success("Registro Eliminado Correctamente", 'Correcto',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
          } else {
            toastr.error("La materia no se elimino", 'Error',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
          }
        }
      });
    }
  })
});
