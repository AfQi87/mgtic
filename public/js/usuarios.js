$(document).ready(function () {
  $("#datatable_user").dataTable({
    "language": { "url": "//cdn.datatables.net/plug-ins/1.11.4/i18n/es_es.json" },
    processing: true,
    serversite: true,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    ajax: {
      url: "/user",
    },
    success: function (response) {
      console.log("response");
    },
    columns: [
      { data: "id" },
      { data: "name" },
      { data: "email" },
      { data: "telefono" },
      { data: "cargo" },
      { data: "rol" },
      { data: "estado" },
      { data: "accion", orderable: false },
    ]
  });

  //=============================================================Registro ususario
  $('#foto').change(function () {
    let reader = new FileReader();
    reader.onload = (e) => {
      $('#imagenSeleccionada').attr('src', e.target.result);
    }
    reader.readAsDataURL(this.files[0]);
  });


});
function cambiar() {
  $('#foto_act').change(function () {
    let reader = new FileReader();
    reader.onload = (e) => {
      $('#foto_mostrar').attr('src', e.target.result);
    }
    reader.readAsDataURL(this.files[0]);
  });
}

//=============================================================================================Registrar usuario

$('#btnreguser').click(function () {
  $.get('/user/formuser', function (datos) {
    const $cargo = document.querySelector("#cargo_id");
    for (let i = ($cargo.options.length) + 1; i >= 0; i--) {
      $cargo.remove(i);
    }
    for (i = 0; i < datos.cargos.length; i++) {
      $("#cargo_id").append('<option value="' + datos.cargos[i].id + '">' + datos.cargos[i].cargo + '</option>');
    }
  })
})

$('#formreguser').submit(function (e) {
  e.preventDefault();
  let = formData = new FormData($('#formreguser')[0]);

  $.ajax({
    method: "POST",
    url: "/user/formuser",
    data: formData,
    contentType: false,
    processData: false,
    beforeSend: function() {
      toastr.warning("Validando datos por favor espere", 'Espere',
      { timeOut: 5000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    },
    success: function (response) {
      if (response == 0) {
        $('#formreguser')[0].reset();
        $('.btn-close').click();
        $('#datatable_user').DataTable().ajax.reload();
        toastr.success("El Usuario se registro de forma correcta", 'Correcto',
          { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
      } else {
        Object.keys(response).forEach(key => toastr.error(response[key], 'Error',
          { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" }));
      }
    },
    error: function () {
      toastr.error("Por favor vuelva a intentarlo mas tarde", 'Error',
        { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
    },
  });
});
//===============================================================Editar datos Usuario
function editarUsuario(id) {
  $.get('/user/formactualizar/' + id, function (datos,) {
    // $('#formActPro')[0].reset();
    $('#id_user').val(datos.usuario.id);
    $('#id_user_d').val(datos.usuario.id);
    $('#name_act').val(datos.usuario.name);
    $('#telefono_act').val(datos.usuario.telefono);
    if (datos.usuario.foto != '' && datos.usuario.foto != null) {
      var div = document.querySelector("#fotoact");
      while (div.firstChild) {
        div.removeChild(div.firstChild);
      }
      $('#fotoact').append('<center><img id="foto_mostrar" src="./images/' + datos.usuario.foto + '" alt="" width="280" height="335"></center><br><input type="file" class="form-control" id="foto_act" onclick="cambiar()" name="foto_act">');
    } else {
      var div = document.querySelector("#fotoact");
      while (div.firstChild) {
        div.removeChild(div.firstChild);
      }
      $('#fotoact').append('<center><img id="foto_mostrar" src="./avatar/avatar.png" alt="" width="280" height="335"></center><br><input type="file" class="form-control" id="foto_act" name="foto_act">');
    }
    const $cargo = document.querySelector("#cargo_id_act");
    for (let i = $cargo.options.length; i >= 0; i--) {
      $cargo.remove(i);
    }
    $("#cargo_id_act").append('<option selected value="' + datos.usuario.cargo_id + '">' + datos.cargos[(datos.usuario.cargo_id - 1)].cargo + '</option>');
    for (i = 0; i < datos.cargos.length; i++) {
      if (datos.usuario.cargo_id != datos.cargos[i].id) {
        $("#cargo_id_act").append('<option value="' + datos.cargos[i].id + '">' + datos.cargos[i].cargo + '</option>');
      }
    }

    const $rol = document.querySelector("#rol_id_act");
    for (let i = $rol.options.length; i >= 0; i--) {
      $rol.remove(i);
    }
    $("#rol_id_act").append('<option selected value="' + datos.usuario.rol_id + '">' + datos.roles[(datos.usuario.rol_id - 1)].rol + '</option>');
    for (i = 0; i < datos.roles.length; i++) {
      if (datos.usuario.rol_id != datos.roles[i].id) {
        $("#cargo_id_act").append('<option value="' + datos.roles[i].id + '">' + datos.roles[i].rol + '</option>');
      }
    }
    $('#ModalUsuarioAct').modal('toggle');
  })
}



$('#formActUsuario').submit(function (e) {
  e.preventDefault();
  let = formAct = new FormData($('#formActUsuario')[0]);
  var id = $('#id_user').val();
  $.ajax({
    url: "/user/formactualizar/" + id,
    method: "POST",
    data: formAct,
    contentType: false,
    processData: false,
    success: function (response) {
      if (response == 0) {
        $('#ModalUsuarioAct').modal('hide');
        $('#datatable_user').DataTable().ajax.reload();
        toastr.success("Usuario actualizado correctamente", 'Correcto',
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
})

//=============================================================================================Desactivar usuario

var idUser;
$(document).on('click', '.desUser', function () {
  idUser = $(this).attr('id');
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
      $.ajax({
        url: "/user/desactivar/" + idUser,
        method: "GET",
        success: function (response) {
          if (response == 0) {
            $('#datatable_user').DataTable().ajax.reload();
            toastr.success("Registro Desactivado Correctamente", 'Correcto',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
          } else {
            toastr.error("El egresado no se desactivo", 'Error',
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

//=============================================================================================Activar Usuario

$(document).on('click', '.actUser', function () {
  idUser = $(this).attr('id');
  Swal.fire({
    title: 'Activar Usuario',
    text: "¿Esta seguro que desea activar el usuario?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, activar!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "/user/activar/" + idUser,
        method: "GET",
        success: function (response) {
          if (response == 0) {
            $('#datatable_user').DataTable().ajax.reload();
            toastr.success("Registro Desactivado Correctamente", 'Correcto',
              { timeOut: 3000, "closeButton": true, "progressBar": true, "positionClass": "toast-bottom-right" })
          } else {
            toastr.error("El egresado no se desactivo", 'Error',
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
