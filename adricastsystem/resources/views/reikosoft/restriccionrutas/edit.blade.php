<div class="reikomodal" id="relacionesModal" style="display:none;">
    <div class="contenidomodal" style="max-width:500px;">
        <div class="bannertitulo">
            Relaciones Usuario - Ruta
        </div>
        <div class="closemodal">
           <button onclick="cerrarModalRelaciones()">
                <span class="fa fa-times"></span>
           </button>
        </div>
        <div class="cuerpomodal">
            <form id="relacionesForm" onsubmit="event.preventDefault(); cambiarEstadoRelacion();">
                @csrf

                <input type="hidden" id="usuario_id" name="usuario_id" value="">
                
                <label for="relacion_select">Selecciona la relación:</label>
                <select id="relacion_select" name="ruta_id" style="width: 100%; padding: 8px; margin-bottom: 15px;">
                    <!-- Aquí se llenan dinámicamente las rutas relacionadas -->
                </select>

                <button type="submit" class="btn btn-danger">Deshabilitar Relación</button>
            </form>
        </div>
    </div>
</div>
