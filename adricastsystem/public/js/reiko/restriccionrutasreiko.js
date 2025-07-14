let usuariosSeleccionados = [];
let rutasSeleccionadas = [];

console.log('JS de Restricción de Rutas cargado correctamente');

// ===============================
// Función para pintar relaciones activas
// ===============================
function pintarRelaciones() {
    $('.usuario-row, .ruta-row').removeClass('selected');

    if (usuariosSeleccionados.length === 1) {
        const userId = usuariosSeleccionados[0];

        $.get(`${restrelacionesusuario}/${userId}`, function (relaciones) {
            relaciones.forEach(rel => {
                $(`.ruta-row[data-ruta-id="${rel.ruta_id}"]`).addClass('selected');
            });
        });
    }

    if (rutasSeleccionadas.length === 1) {
        const rutaId = rutasSeleccionadas[0];

        $.get(`${restrelacionesruta}/${rutaId}`, function (relaciones) {
            relaciones.forEach(rel => {
                $(`.usuario-row[data-user-id="${rel.user_id}"]`).addClass('selected');
            });
        });
    }
}

// ===============================
// Función para guardar relaciones
// ===============================
function guardarRestricciones() {
    if (usuariosSeleccionados.length === 0 || rutasSeleccionadas.length === 0) {
        Swal.fire('Aviso', 'Selecciona al menos un usuario y una ruta.', 'warning');
        return;
    }

    $.ajax({
        url: guardarRestriccionesUrl,
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            usuarios: usuariosSeleccionados,
            rutas: rutasSeleccionadas
        },
        success: function () {
            Swal.fire('Éxito', 'Restricciones actualizadas correctamente', 'success');
            pintarRelaciones();
        },
        error: function () {
            Swal.fire('Error', 'Error al guardar las restricciones', 'error');
        }
    });
}

// ===============================
// Asignar eventos a los checkboxes
// ===============================
function bindCheckboxEvents() {
    $('.checkbox-usuario').off().on('change', function () {
        usuariosSeleccionados = $('.checkbox-usuario:checked').map(function () {
            return this.value;
        }).get();
        pintarRelaciones();
    });

    $('.checkbox-ruta').off().on('change', function () {
        rutasSeleccionadas = $('.checkbox-ruta:checked').map(function () {
            return this.value;
        }).get();
        pintarRelaciones();
    });
}

// ===============================
// Búsqueda dinámica de usuarios
// ===============================
function buscarUsuariosAjax() {
    const texto = $('#buscar_usuario').val();

    $.ajax({
        url: buscarRestriccionesUrl,
        type: 'GET',
        data: { texto: texto },
        success: function (usuarios) {
            let html = '';
            usuarios.forEach(usuario => {
                html += `
                    <tr class="usuario-row" data-user-id="${usuario.id}">
                        <td><input type="checkbox" class="checkbox-usuario" value="${usuario.id}"></td>
                        <td>${usuario.nombres} ${usuario.apellidos}</td>
                    </tr>
                `;
            });

            $('#lista-usuarios').html(html);
            bindCheckboxEvents();
            pintarRelaciones();
        },
        error: function () {
            $('#lista-usuarios').html('<tr><td colspan="2">Error al cargar usuarios</td></tr>');
        }
    });
}

// ===============================
// Búsqueda dinámica de rutas
// ===============================
function buscarRutasAjax() {
    const texto = $('#buscar_ruta').val();
    const moduloId = $('#modulo_id').val();

    $.ajax({
        url: buscarRutasUrl,
        type: 'GET',
        data: {
            texto: texto,
            modulo_id: moduloId
        },
        success: function (rutas) {
            let html = '';
            rutas.forEach(ruta => {
                html += `
                    <tr class="ruta-row" data-ruta-id="${ruta.id}">
                        <td><input type="checkbox" class="checkbox-ruta" value="${ruta.id}"></td>
                        <td>${ruta.nombre}</td>
                        <td><small>${ruta.url}</small></td>
                    </tr>
                `;
            });

            $('#lista-rutas').html(html);
            bindCheckboxEvents();
            pintarRelaciones();
        },
        error: function () {
            $('#lista-rutas').html('<tr><td colspan="3">Error al cargar rutas</td></tr>');
        }
    });
}

// ===============================
// Inicialización
// ===============================
$(document).ready(function () {
    bindCheckboxEvents();
    pintarRelaciones();

    $('#buscar_usuario').on('input', buscarUsuariosAjax);
    $('#buscar_ruta').on('input', buscarRutasAjax);
    $('#modulo_id').on('change', buscarRutasAjax);
});
// ===============================
// Cargar restricciones
// ===============================
function cargarRelacionesUsuario(userId) {
    // Limpia el select y deshabilita el botón
    $('#select-relaciones').empty();
    $('#btn-deshabilitar').prop('disabled', true);

    $.get(`restriccionrutas/retrelacionesusuario/${userId}`, function(relaciones) {
        if(relaciones.length === 0) {
            $('#select-relaciones').append('<option value="">No hay relaciones activas</option>');
        } else {
            relaciones.forEach(function(rel) {
                // Por ejemplo, mostrar nombre de la ruta y poner el id en value
                $('#select-relaciones').append(
                    `<option value="${rel.ruta_id}">${rel.ruta_nombre}</option>`
                );
            });

            // Habilitar botón cuando hay opciones
            $('#btn-deshabilitar').prop('disabled', false);
        }
    });
}

// ===============================
// FUNCIONES PARA EL MODAL
// ===============================
function abrirModalRelaciones(usuarioId) {
    document.getElementById('usuario_id').value = usuarioId;

    const select = document.getElementById('relacion_select');
    select.innerHTML = '<option>Cargando...</option>';

    fetch(`/restriccionrutas/retrelacionesusuario/${usuarioId}`)  // Llama la ruta que devuelve las relaciones activas
        .then(response => response.json())
        .then(data => {
            select.innerHTML = '';
            if (data.length === 0) {
                select.innerHTML = '<option disabled>No hay relaciones activas</option>';
            } else {
                data.forEach(rel => {
                    // Asumiendo que la respuesta tiene ruta_id y ruta_nombre (ajusta según tu JSON)
                    const option = document.createElement('option');
                    option.value = rel.ruta_id;
                    option.textContent = rel.ruta_nombre;
                    select.appendChild(option);
                  
                });
            }
            // Finalmente mostrar el modal
            document.getElementById('relacionesModal').style.display = 'block';
        })
        .catch(() => {
            alert('Error al cargar relaciones');
        });
}

function cerrarModalRelaciones() {
    document.getElementById('relacionesModal').style.display = 'none';
}

function cambiarEstadoRelacion() {
    const usuarioId = document.getElementById('usuario_id').value;
    const rutaId = document.getElementById('relacion_select').value;

    if (!rutaId) {
        alert('Selecciona una relación');
        return;
    }

    fetch(cambiarEstadoUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({
            user_id: usuarioId,
            ruta_id: rutaId,
            estado: false
        })
    })
    .then(res => res.json())
    .then(resp => {
        if (resp.success) {
            alert('Relación deshabilitada');

            // Refrescar la lista de relaciones sin cerrar el modal
            abrirModalRelaciones(usuarioId);

            // Si quieres cerrar el modal en cambio:
            // cerrarModalRelaciones();
            // También refrescar tablas o listas seleccionadas si tienes lógica para eso
        } else {
            alert('Error: ' + resp.error);
        }
    })
    .catch(() => {
        alert('Error en la petición. Talvez no estes permitido realizar esta accion');
    });
}
