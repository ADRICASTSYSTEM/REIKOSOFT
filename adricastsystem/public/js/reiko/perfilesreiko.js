function actualizarDatos() {
    var formData = new FormData($('#miFormulario')[0]);
    // Verificar si hay cambios en el formulario
    var cambios = false;
    formData.forEach(function(field) {
      if (field !== '') {
        cambios = true;
        return false; // Romper el bucle forEach
      }
    });
  
    if (!cambios) {
      Swal.fire('Atención', 'No se realizaron modificaciones', 'warning');
      return;
    }

    // Envía una solicitud AJAX al servidor
    $.ajax({
        url: '/perfilesupdate/',
        type: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        success: function(response) {
            // Maneja la respuesta del servidor (puede ser un mensaje de éxito o error)
            Swal.fire('Éxito', 'Datos de usuarios actualizados correctamente', 'success');
            window.location.href = '/perfiles';
        },
        error: function(xhr, status, error) {
            // Maneja el error de la solicitud AJAX
            Swal.fire('Error', 'Se produjo un error al actualizar el registro: ' + xhr.responseText, 'error');
            console.error(xhr.responseText);
            console.error(error);
        }
    });
}