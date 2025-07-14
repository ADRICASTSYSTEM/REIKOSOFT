function cerrarModal(){
    editmodal= document.getElementById('editmodal');
    editmodal.style.display = 'none'; 
    principal();
} 
function principal(){
    window.location.href = '/contactos';
}
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
                url:  'contactosdelete/' + id,
                type: "DELETE",
                data: {
                    "_token": token,
                },
                success: function(response) {
                    // Manejar la respuesta exitosa aquí
                    console.log(response);
                    Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
                    // Redireccionamos después de eliminar el contacto
                    window.location.href = '/contactos';
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
                    url:  'contactosdelete/' + id,
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
                window.location.href = '/contactos';
            });
        }
    });
}

function obtenerDatos(id) {
    editmodal= document.getElementById('editmodal');
    editmodal.style.display = 'block';
    var nombre = document.getElementById('nombre');
    var correo = document.getElementById('correo');
    var telefono = document.getElementById('telefono');
    var mensaje = document.getElementById('mensaje');
    var asunto = document.getElementById('asunto');
    
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url:  'contactos/show/' + id,
        type: "GET",
        data: {
            "_token": token,
        },
        success: function(response) {
            // Manejar la respuesta exitosa aquí
           
          
            nombre.value = response.nombre;
            correo.value = response.correo;
            telefono.value = response.telefono;
            mensaje.value = response.mensaje;
            asunto.value = response.asunto;
        },
        error: function(xhr, status, error) {
            // Manejar errores aquí
            console.error('Error en la solicitud AJAX:', xhr, status, error);
            Swal.fire('Error', 'Se produjo un error en el servidor.', 'error');
        }
    });

}
function consultaDatos() {
    var termino = document.getElementById('busqueda').value;
    var tipoSelect = document.getElementById('select');
    var tipo = tipoSelect.options[tipoSelect.selectedIndex].value;
    console.log(tipo);
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url:  '/contactosbuscar',
        type: "GET",
        data: {
            "_token": token,
            "termino": termino,
            "tipo": tipo
        },
        success: function(response) {
            // Limpiar el contenido actual de "contenidomensajeria"
            $('#contenidomensajeria').empty();

            // Iterar sobre los resultados de la búsqueda y agregarlos al contenedor
            $.each(response, function(index, mensaje) {
                // Determinar el estilo del mensaje (leído o no leído)
                var estiloMensaje = '';
                var estadoMensaje = '';

                if (mensaje.status == 'leido') {
                    estiloMensaje = 'border: 1px solid green;';
                    estadoMensaje = 'Mensaje Leído';
                } else if (mensaje.status == 'no_leido') {
                    estiloMensaje = 'border: 1px solid blue;';
                    estadoMensaje = 'Mensaje No Leído';
                }
                
                var mensajeHTML =  '<p style="color: ' + (mensaje.status == 'leido' ? 'green' : 'blue') + ';">' + estadoMensaje + '</p>';
                mensajeHTML +='<div class="mensaje" style="' + estiloMensaje + '">';
                mensajeHTML += '<div class="elemento">';
                mensajeHTML += '<span class="etiqueta">Nombre:</span>';
                mensajeHTML += '<span class="dato">' + mensaje.nombre + '</span>';
                mensajeHTML += '</div>';
                mensajeHTML += '<div class="elemento">';
                mensajeHTML += '<span class="etiqueta">Correo:</span>';
                mensajeHTML += '<span class="dato">' + mensaje.correo + '</span>';
                mensajeHTML += '</div>';
                mensajeHTML += '<div class="elemento">';
                mensajeHTML += '<span class="etiqueta">Asunto:</span>';
                mensajeHTML += '<span class="dato">' + mensaje.asunto + '</span>';
                mensajeHTML += '</div>';
                mensajeHTML += '<div class="elemento" style="display: flex;">';
                mensajeHTML += '<button type="submit" onclick="obtenerDatos(\'' + mensaje.id + '\')" class="btnver">Ver</button>';
                mensajeHTML += '<button type="submit" onclick="eliminarDatos(\'' + mensaje.id + '\')" class="btneliminar">Eliminar</button>';
                mensajeHTML += '</div>';
                mensajeHTML += '</div>';

                $('#contenidomensajeria').append(mensajeHTML);
            });
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud AJAX:', xhr, status, error);
            Swal.fire('Error', 'Se produjo un error en el servidor.', 'error');
        }
    });
}
function obtenerMensajesSeleccionados() {
    var mensajesSeleccionados = [];
    $("input[name='mensajes_seleccionados[]']:checked").each(function () {
        mensajesSeleccionados.push($(this).val());
    });
    return mensajesSeleccionados;
}

function actualizarVisibilidadBotonEliminar() {
    var mensajesSeleccionados = obtenerMensajesSeleccionados();
    if (mensajesSeleccionados.length > 0) {
        $('#btnEliminarSeleccionados').show();
    } else {
        $('#btnEliminarSeleccionados').hide();
    }
}

// Llamar a la función al cargar la página
$(document).ready(function() {
    actualizarVisibilidadBotonEliminar();
    
    // Llamar a la función cuando se cambia el estado de un checkbox
    $("input[name='mensajes_seleccionados[]']").change(function() {
        actualizarVisibilidadBotonEliminar();
    });
});
