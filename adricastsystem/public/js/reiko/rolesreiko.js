// Variables globales para mantener estado
let modulosAsignadosActuales = [];
let tipoUsuarioActual = null;

function cargarAsignados() {
    const tipoUsuarioId = document.getElementById('tipo_usuario').value;

    if (tipoUsuarioId !== tipoUsuarioActual) {
        tipoUsuarioActual = tipoUsuarioId;

        // Obtener módulos asignados para el tipo de usuario seleccionado
        modulosAsignadosActuales = (rolesPorTipoUsuario[tipoUsuarioId] || []).map(r => parseInt(r.id_modulos));
    }

    renderizarSelects();
}

function renderizarSelects() {
    const disponiblesSelect = document.getElementById('modulos_disponibles');
    const asignadosSelect = document.getElementById('modulos_asignados');

    disponiblesSelect.innerHTML = '';
    asignadosSelect.innerHTML = '';

    todosLosModulos.forEach(modulo => {
        const option = new Option(modulo.nombre, modulo.id);
        if (modulosAsignadosActuales.includes(modulo.id)) {
            option.selected = true;
            asignadosSelect.appendChild(option);
        } else {
            option.selected = false;
            disponiblesSelect.appendChild(option);
        }
    });
}

function mover(origenId, destinoId) {
    const origen = document.getElementById(origenId);
    const destino = document.getElementById(destinoId);

    [...origen.selectedOptions].forEach(option => {
        // Mover visualmente la opción
        origen.removeChild(option);
        destino.appendChild(option);

        const idModulo = parseInt(option.value);

        // Actualizar estado según donde se movió
        if (destinoId === 'modulos_asignados') {
            if (!modulosAsignadosActuales.includes(idModulo)) {
                modulosAsignadosActuales.push(idModulo);
            }
            option.selected = true;
        } else {
            // Si va a disponibles, quitar del arreglo asignados
            modulosAsignadosActuales = modulosAsignadosActuales.filter(id => id !== idModulo);
            option.selected = false;
        }
    });
}

// Asegurarse de que todas las opciones asignadas estén seleccionadas al enviar formulario
document.getElementById('formAsignarModulos').addEventListener('submit', function () {
    const asignadosSelect = document.getElementById('modulos_asignados');
    for (let i = 0; i < asignadosSelect.options.length; i++) {
        asignadosSelect.options[i].selected = true;
    }
});
