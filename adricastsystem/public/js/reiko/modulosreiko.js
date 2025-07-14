
  function eliminarDato(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminarlo!'
    }).then((result) => {
        if (result.isConfirmed) {
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url:  'modulosdelete/' + id,
                type: "DELETE",
                data: {
                    "_token": token,
                },
                success: function(response) {
                    // Manejar la respuesta exitosa aquí
                    console.log(response);
                    Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
                    // Redireccionamos después de eliminar el contacto
                    window.location.href = '/modulos';
                },
                error: function(xhr, status, error) {
                    // Manejar errores aquí
                    console.error('Error en la solicitud AJAX:', xhr, status, error);
                    Swal.fire('Error', 'Se produjo un error en el servidor.', 'error');
                }
            });
        }
    });
}

function eliminarDatos(ids) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminarlos!'
    }).then((result) => {
        if (result.isConfirmed) {
            var token = $('meta[name="csrf-token"]').attr('content');
            // Recorremos los IDs y enviamos una solicitud AJAX para eliminar cada uno
            ids.forEach(id => {
                $.ajax({
                    url:  'modulosdelete/' + id,
                    type: "DELETE",
                    data: {
                        "_token": token,
                    },
                    success: function(response) {
                        // Manejar la respuesta exitosa aquí (puedes eliminar el console.log si no lo necesitas)
                        console.log(response);
                        // No redireccionamos aquí, ya que estamos eliminando varios contactos y no queremos redireccionar hasta que se completen todas las eliminaciones
                    },
                    error: function(xhr, status, error) {
                        // Manejar errores aquí
                        console.error('Error en la solicitud AJAX:', xhr, status, error);
                        Swal.fire('Error', 'Se produjo un error en el servidor.', 'error');
                    }
                });
            });
            // Una vez que se hayan enviado todas las solicitudes de eliminación, mostramos un mensaje y redireccionamos
            Swal.fire('Eliminados!', 'Los registros han sido eliminados.', 'success').then(() => {
                window.location.href = '/modulos';
            });
        }
    });
}
  function guardarDatos() {
    var token = $('meta[name="csrf-token"]').attr('content');

    // Obtener los datos del formulario modal
    var formData = new FormData($('#miFormulario')[0]);

    // Obtener el elemento input de la imagen
    const moduloImagen = document.getElementById('file-input');

    // Agregar la imagen al formData si está presente
    if (moduloImagen.files.length > 0) {
        const fileSizeMB = moduloImagen.files[0].size / (1024 * 1024);
        const maxSizeMB = 5;  // Ajusta este valor según tus necesidades

        if (fileSizeMB > maxSizeMB) {
            alert('La imagen es demasiado grande. Se permite un tamaño máximo de ' + maxSizeMB + ' MB.');
            moduloImagen.value = '';  // Limpiar el input
            return;  // Detener la ejecución si la imagen es demasiado grande
        }
    }

    // Enviar la solicitud AJAX
    $.ajax({
        url: StoreUrl,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': token
        },
        success: function(response) {
            // Manejar la respuesta exitosa aquí
            console.log(response);
            Swal.fire('Éxito', 'Datos de usuarios guardados correctamente', 'success');
            window.location.href = '/modulos';
            
        },
        error: function(xhr, status, error) {
            // Manejar errores aquí
            if (xhr.status === 422) {
                // El servidor respondió con un error de validación (422 Unprocessable Entity)
                var responseErrors = xhr.responseJSON.errors;
                var errorMessage = 'Los datos proporcionados no son válidos.';

                // Recorre los errores y construye el mensaje de error
                for (var key in responseErrors) {
                    if (responseErrors.hasOwnProperty(key)) {
                        errorMessage += '<br>' + responseErrors[key][0];
                    }
                }

                Swal.fire('Error', errorMessage, 'error');
            } else {
                // Otros errores de la solicitud AJAX
                console.error(error);
                Swal.fire('Error', 'Se produjo un error en el servidor.', 'error');
            }
        }
    });
}

function modificarDatos(id){
  editmodal= document.getElementById('editmodal');
  editmodal.style.display = 'block';
  dataidbtn= document.getElementById('modificarbtn').setAttribute('data-id', id);
  var miFormulario = document.getElementById('miFormulario');
  miFormulario.action = miFormulario.action.replace('__ID__', id);
  obtenerDatos(id);
}

function obtenerDatos(id) {
  var miformulario = document.getElementById('miFormulario');
  var nombre = document.getElementById('nombre');
  var descripcion = document.getElementById('descripcion');
  var ruta= document.getElementById('ruta');
  var imagenPreview = document.getElementById('imagen-preview');
  
  var token = $('meta[name="csrf-token"]').attr('content');
  
  $.ajax({
      url: '/modulos/modulosshow/' + id,
      method: 'GET',
      headers: {
          'X-CSRF-TOKEN': token
      },
      success: function(response) {
          // Mostrar una alerta de éxito

          console.log(response);
          nombre.value = response.nombre;
          descripcion.value = response.descripcion;
          ruta.value = response.ruta;
          imagenPreview.src = '/img/modulos/' + response.icono;
          imagenPreview.style.width = '100px';  // Establece el ancho de la imagen
          imagenPreview.style.height = '100px'; 
          imagenPreview.style.display = 'block';

          
      },
      error: function(xhr, status, error) {
          // Mostrar una alerta de error si ocurre algún problema en la solicitud AJAX
          Swal.fire('Error', 'Se produjo un error al consultar el registro', 'error');
      }
  });
}
 function actualizarDatos(){
  var dataId = modificarbtn.getAttribute('data-id');
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

  $.ajax({
    url: '/modulos/modulosupdate/' + dataId,
    type: 'POST',
    processData: false,
    contentType: false,
    data: formData,
    success: function(response) {
        // Mostrar una alerta de éxito
        Swal.fire('Éxito', 'Datos de usuarios actualizados correctamente', 'success');
        window.location.href = '/modulos';
    },
    error: function(xhr, status, error) {
        // Mostrar una alerta de error si ocurre algún problema en la solicitud AJAX
        Swal.fire('Error', 'Se produjo un error al actualizar el registro', 'error');
    } 
});


}


function cerrarModal(){
  editmodal= document.getElementById('editmodal');
  editmodal.style.display = 'none';
} 
function principal(){
  window.location.href = '/modulos';
}
function obtenerModulosSeleccionados() {
  var modulosSeleccionados = [];
  $("input[name='modulos_seleccionados[]']:checked").each(function () {
      modulosSeleccionados.push($(this).val());
  });
  return modulosSeleccionados;
}


function actualizarVisibilidadBotonEliminar() {
  var modulosSeleccionados = obtenerModulosSeleccionados();
  if (modulosSeleccionados.length > 0) {
      $('#btnEliminarSeleccionados').show();
  } else {
      $('#btnEliminarSeleccionados').hide();
  }
}

// Llamar a la función al cargar la página
$(document).ready(function() {
  actualizarVisibilidadBotonEliminar();
  
  // Llamar a la función cuando se cambia el estado de un checkbox
  $("input[name='modulos_seleccionados[]']").change(function() {
      actualizarVisibilidadBotonEliminar();
  });
});
function toggleDropdown(event) {
    event.stopPropagation();
    const dropdownContent = event.currentTarget.nextElementSibling;
    document.querySelectorAll('.dropdown-content').forEach(dc => {
        if (dc !== dropdownContent) dc.style.display = 'none';
    });
    dropdownContent.style.display = (dropdownContent.style.display === 'flex') ? 'none' : 'flex';
}

document.addEventListener('click', function() {
    document.querySelectorAll('.dropdown-content').forEach(dc => {
        dc.style.display = 'none';
    });
});



