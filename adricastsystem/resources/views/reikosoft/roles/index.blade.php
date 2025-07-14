@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'Asignar Módulos a Roles')
@section('reikosoft-active', 'active')

@section('contenidoreiko')
<section class="containerreiko">
<div class="contenedorformularios">
    <form action="{{ route('rolusuario.store') }}" method="POST" id="formAsignarModulos">
        @csrf

        <!-- Selección de Tipo de Usuario -->
        <div style="margin-bottom: 20px;">
            <label for="tipo_usuario">Seleccione Tipo de Usuario:</label>
            <select id="tipo_usuario" name="tipo_usuario_id" class="roles-select" onchange="cargarAsignados()">
                <option disabled selected>Seleccione...</option>
                @foreach($tiposUsuario as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->descripcion }}</option>
                @endforeach
            </select>
        </div>

        <!-- Selector de módulos con doble caja -->
        <div class="dual-select-container">
            
            <!-- Módulos disponibles -->
            <div class="select-box">
                <h4>Módulos Disponibles</h4>
                <select id="modulos_disponibles" multiple size="10" class="roles-select">
                    {{-- Se llenará dinámicamente --}}
                </select>
            </div>

            <!-- Botones de transferencia -->
            <div class="transfer-buttons">
                <button type="button" onclick="mover('modulos_disponibles', 'modulos_asignados')">→</button>
                <button type="button" onclick="mover('modulos_asignados', 'modulos_disponibles')">←</button>
            </div>

            <!-- Módulos asignados -->
            <div class="select-box">
                <h4>Módulos Asignados</h4>
                <select id="modulos_asignados" name="modulos_asignados[]" multiple size="10" class="roles-select">
                    {{-- Se llenará dinámicamente --}}
                </select>
            </div>
        </div>

        <!-- Botón guardar -->
        <div class="submit-btn-container" style="margin-top: 20px;">
            <button type="submit">Guardar Asignación</button>
        </div>
     
    </form>
 </div>
</section>

<!-- Variables JS pasadas desde backend -->
<script>
    const rolesPorTipoUsuario = @json($rolesPorTipoUsuario);
        
   const todosLosModulos = @json($todosLosModulos);
</script>

<!-- Carga script JS externo -->
<script src="{{ route('recursos.show', ['js/reiko', 'rolesreiko.js']) }}"></script>

@endsection
