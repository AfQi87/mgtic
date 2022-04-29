$(document).ready(function () {
  console.log('correo');
});

$('#enviar').submit(function (e) {
  e.preventDefault();
  let = formData = new FormData($('#enviar')[0]);

  $.ajax({
    method: "POST",
    url: "/",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      if (response == 0) {
        $('#enviar')[0].reset();
        toastr.success("Pronto nos pondremos en contacto", 'Correcto',
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
});