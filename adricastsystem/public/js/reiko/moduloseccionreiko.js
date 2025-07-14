let modulosSeleccionados = [];
let seccionesSeleccionadas = [];

console.log('JS de Asociación Módulo-Sección cargado correctamente');

// ===============================
// Pintar relaciones activas
// ===============================
function pintarRelaciones() {
    $('.modulo-row, .seccion-row').removeClass('selected');

    if (seccionesSeleccionadas.length === 1) {
        const seccionId = seccionesSeleccionadas[0];

        $.get(`${relacionesPorSeccionUrl}/${seccionId}`, function (relaciones) {
            relaciones.forEach(rel => {
                $(`.modulo-row[data-modulo-id="${rel.modulo_id}"]`).addClass('selected');
            });
        });
    }
}

// ===============================
// Guardar relaciones
// ===============================
function guardarRelacionesModuloSeccion() {
    if (modulosSeleccionados.length === 0 || seccionesSeleccionadas.length === 0) {
        Swal.fire('Aviso', 'Selecciona al menos un módulo y una sección.', 'warning');
        return;
    }

    $.ajax({
        url: guardarRelacionesUrl,
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            modulos: modulosSeleccionados,
            secciones: seccionesSeleccionadas
        },
        success: function () {
            Swal.fire('Éxito', 'Relaciones guardadas correctamente', 'success');
            pintarRelaciones();
        },
        error: function () {
            Swal.fire('Error', 'Ocurrió un error al guardar', 'error');
        }
    });
}

// ===============================
// Eventos checkbox
// ===============================
function bindCheckboxEvents() {
    $('.checkbox-modulo').off().on('change', function () {
        modulosSeleccionados = $('.checkbox-modulo:checked').map(function () {
            return this.value;
        }).get();
        pintarRelaciones();
    });

    $('.checkbox-seccion').off().on('change', function () {
        seccionesSeleccionadas = $('.checkbox-seccion:checked').map(function () {
            return this.value;
        }).get();
        pintarRelaciones();
    });
}

// ===============================
// Búsqueda de módulos
// ===============================
function buscarModulosAjax() {
    const texto = $('#buscar_modulo').val();

    $.ajax({
        url: buscarModulosUrl,
        type: 'GET',
        data: { texto: texto },
        success: function (modulos) {
            let html = '';
            modulos.forEach(modulo => {
                html += `
                    <tr class="modulo-row" data-modulo-id="${modulo.id}">
                        <td><input type="checkbox" class="checkbox-modulo" value="${modulo.id}"></td>
                        <td>${modulo.nombre}</td>
                    </tr>
                `;
            });
            $('#lista-modulos').html(html);
            bindCheckboxEvents();
            pintarRelaciones();
        },
        error: function () {
            $('#lista-modulos').html('<tr><td colspan="2">Error al cargar módulos</td></tr>');
        }
    });
}

// ===============================
// Búsqueda de secciones
// ===============================
function buscarSeccionesAjax() {
    const texto = $('#buscar_seccion').val();

    $.ajax({
        url: buscarSeccionesUrl,
        type: 'GET',
        data: { texto: texto },
        success: function (secciones) {
            let html = '';
            secciones.forEach(seccion => {
                html += `
                    <tr class="seccion-row" data-seccion-id="${seccion.id}">
                        <td><input type="checkbox" class="checkbox-seccion" value="${seccion.id}"></td>
                        <td>${seccion.nombre}</td>
                        <td>
                            <button 
                                class="btn btn-warning btn-sm" 
                                onclick="abrirModalRelaciones(${seccion.id})"
                                title="Gestionar relaciones">
                                Deshabilitar relación
                            </button>
                        </td>
                    </tr>
                `;
            });
            $('#lista-secciones').html(html);
            bindCheckboxEvents();
            pintarRelaciones();
        },
        error: function () {
            $('#lista-secciones').html('<tr><td colspan="3">Error al cargar secciones</td></tr>');
        }
    });
}

// ===============================
// Abrir modal para deshabilitar relación
// ===============================
function abrirModalRelaciones(seccionId) {
    document.getElementById('seccion_id').value = seccionId;

    const select = document.getElementById('relacion_select');
    select.innerHTML = '<option>Cargando...</option>';
    console.log("id seccion: "+seccionId);
    fetch(`/moduloseccion/secrelacionessecciones/${seccionId}`)
        .then(response => response.json())
        .then(data => {
            select.innerHTML = '';
            if (data.length === 0) {
                select.innerHTML = '<option disabled>No hay relaciones activas</option>';
                document.getElementById('btn-deshabilitar').disabled = true;
            } else {
                data.forEach(rel => {
                    const option = document.createElement('option');
                    option.value = rel.modulo_id;
                    option.textContent = rel.modulo_nombre;
                    select.appendChild(option);
                });
                document.getElementById('btn-deshabilitar').disabled = false;
            }

            document.getElementById('relacionesModal').style.display = 'block';
        })
        /*
        .catch(() => {
            alert('Error al cargar relaciones');
        });*/
         .catch(error => {
        alert('Error al cargar relaciones: ' + error);
    });
}

// ===============================
// Cerrar modal
// ===============================
function cerrarModalRelaciones() {
    document.getElementById('relacionesModal').style.display = 'none';
}

// ===============================
// Cambiar estado de la relación
// ===============================
function cambiarEstadoRelacion() {
    const seccionId = document.getElementById('seccion_id').value;
    const moduloId = document.getElementById('relacion_select').value;

    if (!moduloId) {
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
            seccion_id: seccionId,
            modulo_id: moduloId,
            estado: false
        })
    })
    .then(res => res.json())
    .then(resp => {
        if (resp.success) {
            alert('Relación deshabilitada');
            abrirModalRelaciones(seccionId);
        } else {
            alert('Error: ' + resp.error);
        }
    })
    .catch(() => {
        alert('Error en la petición');
    });
}

// ===============================
// Inicialización
// ===============================
$(document).ready(function () {
    bindCheckboxEvents();
    pintarRelaciones();

    $('#buscar_modulo').on('input', buscarModulosAjax);
    $('#buscar_seccion').on('input', buscarSeccionesAjax);
});
