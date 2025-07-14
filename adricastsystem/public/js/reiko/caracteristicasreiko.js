function consultaProductoCodigo() {
    var busqueda = document.getElementById('busqueda').value.trim();
    var nombre = document.getElementById('nombre');
    var descripcion = document.getElementById('descripcion');
    var codigo = document.getElementById('codigo');
    var nombreMarca = document.getElementById('marca');
    nombre.value = '';
    descripcion.value = '';
    codigo.value = '';
    nombreMarca.value = '';

    // Verificar si el valor de búsqueda es vacío o nulo
    if (!busqueda) {
        console.error('El término de búsqueda está vacío');
        return;
    }

    $.ajax({
        url: '/productosbuscarcodigo',
        method: 'GET',
        data: { termino: busqueda },
        success: function(response) {
            // Verificar si se encontró el producto
            if (response.error) {
                console.error(response.error);
                return;
            }

            // Obtener los datos del producto desde la respuesta JSON
            nombre.value = response.nombre;
            descripcion.value = response.descripcion;
            codigo.value = response.codigo;
            nombreMarca.value = response.nombre_marca;
            var contenedorCaracteristicas = document.getElementById('contenedorcaracteristicas');
            var htmlcontenedorCaracteristicas = '<div class="acciones">';
            htmlcontenedorCaracteristicas += '<button class="btn btn-primary" onclick="agregarCaracteristica(' + response.id + ')">Agregar características</button>';
            htmlcontenedorCaracteristicas += '</div>';
            htmlcontenedorCaracteristicas += '<div class="caracteristicas" id="caracteristicas'+ response.id+'">';
            htmlcontenedorCaracteristicas += '</div>';
            contenedorCaracteristicas.innerHTML = htmlcontenedorCaracteristicas;
            consultaCaracteristica(response.id);
          
            
        },

        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}
function agregarCaracteristica(id) {        
     // Verificar si el valor de busqueda es vacío o nulo
     if (!id) {
        console.error('El id esta vacio');
    
        return;
    }

    $.ajax({
        url: '/caracteristicas/agregar/'+id,
        method: 'GET',
        success: function(response) {
            // Verificar si se encontró el producto
            if (response.error) {
                console.error(response.error);
                return;
            }

            consultaCaracteristica(id);
          
         },
        error: function(xhr, status, error) {
            console.error(error);
          
        }

    });
}
function eliminarCaracteristica(id) {
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
                url: '/caracteristicas/eliminar/' + id,
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
function actualizarCaracteristica(id) {
    // Verificar si el valor de búsqueda es vacío o nulo
    if (!id) {
        console.error('El id está vacío');
        return;
    }

    // Obtener el valor del campo de texto de la descripción
    var descripcion = document.getElementById('detalletext' + id).value.trim();
    if (!descripcion) {
        console.error('La descripción está vacía');
        return;
    }
    console.log(descripcion);
    // Obtener el token CSRF
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    $.ajax({
        url: '/caracteristicas/actualizar/' + id,
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
function consultaCaracteristica(id) {
   
    // Verificar si el valor de busqueda es vacío o nulo
    if (!id) {
        console.error('El id esta vacio');
    
        return;
    }

    $.ajax({
        url: '/caracteristicas/buscarid/'+id,
        method: 'GET',
      
        success: function(response) {
            // Verificar si se encontró el producto
            if (response.error) {
                console.error(response.error);
                return;
            }
            
            // Obtener el contenedor de características
            var contenedorCaracteristicas = document.getElementById('caracteristicas' + id);
            
            // Generar HTML para cada característica
            var htmlcontenedorCaracteristicas = '';
            response.forEach(function(caracteristica) {
                // Generar HTML para el formulario de actualización de imagen
               

                htmlcontenedorCaracteristicas += '<div class="caracteristica" id="caracteristica' + caracteristica.id + '">';
                
                    htmlcontenedorCaracteristicas += '<div class="detalle">';
                    htmlcontenedorCaracteristicas += '<textarea name="detalletext' + caracteristica.id + '" id="detalletext' + caracteristica.id + '" cols="2" rows="2">' + caracteristica.descripcion + '</textarea>';
                    htmlcontenedorCaracteristicas += '</div>';
                    htmlcontenedorCaracteristicas += ' <div class="imagencaracteristica">';
                    if (caracteristica.foto != null) {
                        htmlcontenedorCaracteristicas += '<img src="/storage/' + caracteristica.foto + '" alt="">';
                    } else {
                        htmlcontenedorCaracteristicas += '<img src="" alt="">';
                    }
                    htmlcontenedorCaracteristicas += '</div>';
                

                
                    htmlcontenedorCaracteristicas += ' <div class="imagencaracteristica">';
                    if (caracteristica.foto != null) {
                        htmlcontenedorCaracteristicas += '<img src="/storage/' + caracteristica.imagen + '" alt="">';
                    } else {
                        htmlcontenedorCaracteristicas += '<img src="" alt="">';
                    }
                    htmlcontenedorCaracteristicas += '</div>';
                    
                    htmlcontenedorCaracteristicas += '<div class="acciones">';
                    htmlcontenedorCaracteristicas += '<button class="btn btn-primary btnver" onclick="actualizarCaracteristica(' + caracteristica.id + ')">Actualizar</button>';
                    htmlcontenedorCaracteristicas += '<button class="btn btn-primary btneliminar" onclick="eliminarCaracteristica(' + caracteristica.id + ')">Eliminar</button>';
                    htmlcontenedorCaracteristicas += '</div>';

                    htmlcontenedorCaracteristicas += '<div class="contenedorsubcaracteristicas">';
                        htmlcontenedorCaracteristicas += '<div class="acciones">';
                        htmlcontenedorCaracteristicas += '<button class="btn btn-primary" onclick="agregarsubcaracteristica(' + caracteristica.id + ')">Agregar subcaracterística</button>';
                        htmlcontenedorCaracteristicas += '</div>';
                        htmlcontenedorCaracteristicas += '<div class="subcaracteristicas" id="subcaracteristicas' + caracteristica.id + '">';

                        htmlcontenedorCaracteristicas += '</div>';
                    htmlcontenedorCaracteristicas += '</div>';
                htmlcontenedorCaracteristicas += '</div>';  
                contenedorCaracteristicas.innerHTML = htmlcontenedorCaracteristicas;
                consultaSubcaracteristica(caracteristica.id);
              
            });
            
            
           
        },
        error: function(xhr, status, error) {
            console.error(error);
          
        }

    });

}




   