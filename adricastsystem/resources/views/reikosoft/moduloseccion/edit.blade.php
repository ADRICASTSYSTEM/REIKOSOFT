<div class="reikomodal" id="relacionesModal" style="display:none;">
    <div class="contenidomodal" style="max-width:500px;">
        <div class="bannertitulo">
            Relaciones Módulo - Sección
        </div>
        <div class="closemodal">
           <button onclick="cerrarModalRelaciones()">
                <span class="fa fa-times"></span>
           </button>
        </div>
        <div class="cuerpomodal">
            <form id="relacionesForm" onsubmit="event.preventDefault(); cambiarEstadoRelacion();">
                @csrf

                <input type="hidden" id="modulo_id" name="modulo_id" value="">
                
                <label for="relacion_select">Selecciona la sección a desasociar:</label>
                <select id="relacion_select" name="seccion_id" style="width: 100%; padding: 8px; margin-bottom: 15px;">
                    <!-- Aquí se llenan dinámicamente las secciones relacionadas -->
                </select>

                <button type="submit" class="btn btn-danger">Desasociar Sección</button>
            </form>
        </div>
    </div>
</div>

