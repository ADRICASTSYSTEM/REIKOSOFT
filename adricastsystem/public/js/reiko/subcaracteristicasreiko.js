function agregarsubcaracteristica(id) {        
    // Verificar si el valor de busqueda es vacío o nulo
    if (!id) {
       console.error('El id esta vacio');
   
       return;
   }

   $.ajax({
       url: '/subcaracteristicas/agregar/'+id,
       method: 'GET',
       success: function(response) {
           // Verificar si se encontró el producto
           if (response.error) {
               console.error(response.error);
               return;
           }

           consultaSubcaracteristica(id);
         
        },
       error: function(xhr, status, error) {
           console.error(error);
         
       }

   });
}
function eliminarSubcaracteristica(id) {
    // Verificar si el valor de busqueda es vacío o nulo
    if (!id) {
        console.error('El id está vacío');
        return;
    }

    // Mostrar un mensaje de confirmación antes de eliminar el registro
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción eliminará el registro. ¿Deseas continuar?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo'
    }).then((result) => {
        if (result.isConfirmed) {
            // Si el usuario confirma la eliminación, enviar la solicitud de eliminación al servidor
            $.ajax({
                url: '/subcaracteristicas/eliminar/' + id,
                method: 'GET',
                success: function(response) {
                    // Verificar si se encontró el producto
                    if (response.error) {
                        console.error(response.error);
                        return;
                    }
                    
                    // La eliminación se completó exitosamente, ahora consultamos las características actualizadas
                    consultaProductoCodigo();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });
}
function actualizarSubcaracteristica(id) {
    // Verificar si el valor de búsqueda es vacío o nulo
    if (!id) {
        console.error('El id está vacío');
        return;
    }

    // Obtener el valor del campo de texto de la descripción
    var descripcion = document.getElementById('subdetalletext' + id).value.trim();
    if (!descripcion) {
        console.error('La descripción está vacía');
        return;
    }
    console.log(descripcion);
    // Obtener el token CSRF
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    $.ajax({
        url: '/subcaracteristicas/actualizar/' + id,
        method: 'POST',
        data: {
            _token: csrfToken,
            descripcion: descripcion
        },
        success: function(response) {
            // Verificar si se encontró el producto
            if (response.error) {
                console.error(response.error);
                return;
            }
            
            // Actualizar la descripción en la interfaz de usuario
            consultaProductoCodigo();
    
            // Mostrar un mensaje de éxito al usuario si lo deseas
            
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });

}
function consultaSubcaracteristica(id){
    // Verificar si el valor de busqueda es vacío o nulo
    if (!id) {
        console.error('El id esta vacio');
    
        return;
    }

    $.ajax({
        url: '/subcaracteristicas/buscarid/'+id,
        method: 'GET',
        success: function(response) {
            // Verificar si se encontró el producto
            if (response.error) {
                console.error(response.error);
                return;
            }

            // Obtener el contenedor de las características
            var contenedorCaracteristicas = document.getElementById('subcaracteristicas'+id);
            var htmlcontenedorCaracteristicas = '';
            // Recorrer cada característica y agregarla al contenedor
            response.forEach(function(subcaracteristica) {
                htmlcontenedorCaracteristicas += '<div class="subcaracteristica">';
                htmlcontenedorCaracteristicas += '<div class="detalle">';
                htmlcontenedorCaracteristicas += '<textarea name="subdetalletext' + subcaracteristica.id + '" id="subdetalletext' + subcaracteristica.id + '" cols="2" rows="2">' + subcaracteristica.descripcion + '</textarea>';
                htmlcontenedorCaracteristicas += '</div>';

                htmlcontenedorCaracteristicas += '<div class="acciones">';
                htmlcontenedorCaracteristicas += '<button class="btn btn-primary btnver" onclick="actualizarSubcaracteristica('+ subcaracteristica.id +')">Actualizar</button>';
                htmlcontenedorCaracteristicas += '<button class="btn btn-danger btneliminar" onclick="eliminarSubcaracteristica('+ subcaracteristica.id +')">Eliminar</button>';
                htmlcontenedorCaracteristicas += '</div>';
                htmlcontenedorCaracteristicas += '</div>';
            });
            contenedorCaracteristicas.innerHTML = htmlcontenedorCaracteristicas;
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
         
}


   