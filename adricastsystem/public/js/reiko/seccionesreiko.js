function cerrarModaledit(){
    editmodal= document.getElementById('editmodal');
    editmodal.style.display = 'none';
} 

function cerrarModalcreate(){
    createmodal= document.getElementById('createmodal');
    createmodal.style.display = 'none';
} 
function principal(){
    window.location.href = '/secciones';
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
                url:  'seccionesdelete/' + id,
                type: "DELETE",
                data: {
                    "_token": token,
                },
                success: function(response) {
                    // Manejar la respuesta exitosa aquí
                    console.log(response);
                    Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
                    // Redireccionamos después de eliminar el contacto
                    window.location.href = '/secciones';
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
                    url:  'seccionesdelete/' + id,
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
                window.location.href = '/secciones';
            });
        }
    });
}
function guardarDatos() {
    var token = $('meta[name="csrf-token"]').attr('content');

    // Obtener los datos del formulario modal
    var formData = new FormData($('#miFormulario')[0]);

    console.log(StoreUrl);

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
            window.location.href = '/secciones';
            
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
                console.error('Error en la solicitud AJAX:', xhr, status, error);

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
    obtenerDatos(id)
  }
  function agregarDatos(){
    createmodal= document.getElementById('createmodal');
    createmodal.style.display = 'block';
  
  }
 function obtenerDatos(id) {
    var nombre = document.getElementById('nombre');
    var descripcion = document.getElementById('descripcion');
    var icono = document.getElementById('icono'); // ← nuevo campo

    var token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '/secciones/show/' + id,
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': token
        },
        success: function(response) {
            console.log(response);
            nombre.value = response.nombre;
            descripcion.value = response.descripcion;
            icono.value = response.icono; // ← aquí asignas el valor del ícono
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'Se produjo un error al consultar el registro', 'error');
        }
    });
}

function actualizarDatos() {
    var token = $('meta[name="csrf-token"]').attr('content');
    var id = document.getElementById('modificarbtn').getAttribute('data-id');
    var formData = new FormData($('#miFormulario')[0]);

    $.ajax({
        url: '/secciones/update/' + id,
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': token
        },
        success: function(response) {
            Swal.fire('Éxito', 'Datos de secciones actualizados correctamente', 'success');
            window.location.href = '/secciones';
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'Se produjo un error al actualizar el registro', 'error');
        }
    });
}

  

  function consultaDatos() {
    var inputBusqueda = document.getElementById('busqueda');
    var contenedorModulos = document.getElementById('contenedorelemento');

    inputBusqueda.addEventListener('keyup', function () {
        var termino = inputBusqueda.value.trim();

        $.ajax({
            url: SearchUrl,
            method: 'GET',
            data: { termino: termino },
            success: function (response) {
                contenedorModulos.innerHTML = ''; // Limpiar el tbody antes de llenarlo

                response.forEach(function (seccion) {
                    var tr = document.createElement('tr');

             
                    var tdNombre = document.createElement('td');
                    tdNombre.textContent = seccion.nombre;

                    var tdCheck = document.createElement('td');
                    var checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.name = 'secciones_seleccionados[]';
                    checkbox.value = seccion.id;
                    checkbox.onchange = function () {
                        actualizarVisibilidadBotonEliminar();
                    };
                    tdCheck.appendChild(checkbox);

                    var tdAcciones = document.createElement('td');

                    var btnEliminar = document.createElement('button');
                    btnEliminar.className = 'btn-accion eliminar';
                    btnEliminar.onclick = function () {
                        eliminarDato(seccion.id);
                    };
                    var iconEliminar = document.createElement('i');
                    iconEliminar.className = 'fas fa-trash';
                    btnEliminar.appendChild(iconEliminar);

                    var btnEditar = document.createElement('button');
                    btnEditar.className = 'btn-accion editar';
                    btnEditar.onclick = function () {
                        modificarDatos(seccion.id);
                    };
                    var iconEditar = document.createElement('i');
                    iconEditar.className = 'fa fa-edit';
                    btnEditar.appendChild(iconEditar);

                    tdAcciones.appendChild(btnEliminar);
                    tdAcciones.appendChild(btnEditar);

                 
                    tr.appendChild(tdNombre);
                    tr.appendChild(tdCheck);
                    tr.appendChild(tdAcciones);

                    contenedorModulos.appendChild(tr);
                });
            }
        });
    });
}

function obtenerSeccionesSeleccionadas() {
    var seccionesSeleccionadas = [];
    $("input[name='secciones_seleccionadas[]']:checked").each(function () {
        seccionesSeleccionadas.push($(this).val());
    });
    return seccionesSeleccionadas;
  }
  
  
  function actualizarVisibilidadBotonEliminar() {
    var seccionesSeleccionadas = obtenerSeccionesSeleccionadas();
    if (seccionesSeleccionadas.length > 0) {
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
  