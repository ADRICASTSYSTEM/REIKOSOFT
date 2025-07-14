function cargarRutasPorModulo(moduloId) {
    if (!moduloId) return;

    fetch(`/rutas/modulo/${moduloId}`)
        .then(response => response.json())
        .then(data => {
            const contenedor = document.getElementById('contenedorRutas');
            contenedor.innerHTML = ''; // Limpiar

            data.forEach(ruta => {
                const metodoClass = 'metodo-' + ruta.metodo.toLowerCase();

                // Crear el contenedor principal
                const div = document.createElement('div');
                div.classList.add('ruta-item');

                // Crear la parte de información
                const rutaInfo = document.createElement('div');
                rutaInfo.classList.add('ruta-info');
                rutaInfo.innerHTML = `
                    <span class="${metodoClass}">${ruta.metodo}</span> &nbsp; | &nbsp;
                    <strong>${ruta.url}</strong><br>
                    <small>${ruta.descripcion ?? ''}</small>
                `;

                // Crear botón de opciones
                const dropdown = document.createElement('div');
                dropdown.classList.add('dropdown');

                const botonOpciones = document.createElement('button');
                botonOpciones.textContent = 'Opciones ▼';

                const dropdownContent = document.createElement('div');
                dropdownContent.classList.add('dropdown-content');

                // Botón Modificar
                const btnModificar = document.createElement('a');
                btnModificar.href = '#';
                btnModificar.classList.add('btn-accion', 'editar');
                btnModificar.textContent = 'Modificar';
                btnModificar.addEventListener('click', (e) => {
                    e.preventDefault();
                    modificarDatos(ruta.id);
                });

                // Botón Eliminar
                const btnEliminar = document.createElement('a');
                btnEliminar.href = '#';
                btnEliminar.textContent = 'Eliminar';
                btnEliminar.addEventListener('click', (e) => {
                    e.preventDefault();
                    eliminarRuta(ruta.id);
                });

                // Ensamblar
                dropdownContent.appendChild(btnModificar);
                dropdownContent.appendChild(btnEliminar);
                dropdown.appendChild(botonOpciones);
                dropdown.appendChild(dropdownContent);

                div.appendChild(rutaInfo);
                div.appendChild(dropdown);

                contenedor.appendChild(div);
            });
        })
        .catch(error => {
            console.error('Error cargando rutas:', error);
        });
}
function actualizarDatos() {
    var token = $('meta[name="csrf-token"]').attr('content');
    var id = $('#modificarbtn').attr('data-id'); // obtener el id del botón modificar
    var formData = new FormData($('#miFormulario')[0]);

    $.ajax({
        url: '/rutas/update/' + id,
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': token
        },
        success: function(response) {
            Swal.fire('Éxito', 'Datos de la ruta actualizados correctamente', 'success');
            // Opcional: refrescar la lista de rutas o redirigir
            window.location.href = '/rutas';
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'Se produjo un error al actualizar la ruta', 'error');
        }
    });
}


function cerrarModaledit(){
    editmodal= document.getElementById('editmodal');
    editmodal.style.display = 'none';
} 
function modificarDatos(id){
    editmodal= document.getElementById('editmodal');
    editmodal.style.display = 'block';
    dataidbtn= document.getElementById('modificarbtn').setAttribute('data-id', id);
    var miFormulario = document.getElementById('miFormulario');
    miFormulario.action = miFormulario.action.replace('__ID__', id);
    obtenerDatos(id)
  }
function obtenerDatos(id) {
    var token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '/rutas/show/' + id,
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': token
        },
        success: function(response) {
            console.log(response);

            document.getElementById('edit_modulo_id').value = response.modulo_id;
            document.getElementById('edit_nombre').value = response.nombre;
            document.getElementById('edit_url').value = response.url;
            document.getElementById('edit_descripcion').value = response.descripcion;
            document.getElementById('edit_metodo_http').value = response.metodo;
            document.getElementById('edit_convencion').value = response.convencion ?? '';

            document.getElementById('edit_ruta_estado').checked = response.estado == 1;

            // Actualizar la acción del formulario para enviar al id correcto
            var form = document.getElementById('miFormulario');
            form.action = form.action.replace('__ID__', id);
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'No se pudo cargar la ruta para edición', 'error');
        }
    });
}

function eliminarRuta(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar'
    }).then((result) => {
        if (result.isConfirmed) {
            var token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: 'rutasdelete/' + id,
                type: 'DELETE',
                data: {
                    "_token": token
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Eliminado!', response.message, 'success').then(() => {
                            // Recargar las rutas del módulo actual
                            $('#modulo_id').trigger('change');
                        });
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error AJAX:', error);
                    Swal.fire('Error', 'No se pudo eliminar la ruta.', 'error');
                }
            });
        }
    });
}

    function guardarDatos() {
    var token = $('meta[name="csrf-token"]').attr('content');

    // Obtener los datos del formulario de rutas
    var formData = new FormData($('#formRuta')[0]);

    console.log(StoreRutaUrl); // definida en el blade

    $.ajax({
        url: StoreRutaUrl,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': token
        },
        success: function(response) {
            Swal.fire('Éxito', 'Ruta guardada correctamente', 'success');
            window.location.href = '/rutas';
        },
        error: function(xhr, status, error) {
            if (xhr.status === 422) {
                var responseErrors = xhr.responseJSON.errors;
                var errorMessage = 'Los datos proporcionados no son válidos.';

                for (var key in responseErrors) {
                    if (responseErrors.hasOwnProperty(key)) {
                        errorMessage += '<br>' + responseErrors[key][0];
                    }
                }

                Swal.fire('Error', errorMessage, 'error');
            } else {
                console.error(error);
                Swal.fire('Error', 'Se produjo un error en el servidor.', 'error');
            }
        }
    });
}
