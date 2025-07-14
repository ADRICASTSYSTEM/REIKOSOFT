<div class="reikomodal" id="editmodal">
    <div class="contenidomodal">
        <div class="bannertitulo">
            Editar Sección
        </div>
        <div class="closemodal">
            <button onclick="cerrarModaledit()">
                <span class="fa fa-times"></span>
            </button>
        </div>
        <div class="cuerpomodal">
            <!-- Ruta se actualizará dinámicamente en JS -->
            <form action="{{ route('secciones.update', '__ID__') }}" id="formularioEditar" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')

                <input type="text" placeholder="Ingrese Nombre" name="nombre" id="edit_nombre" required>
                <input type="text" placeholder="Ingrese Descripción" name="descripcion" id="edit_descripcion" required>
                <input type="text" placeholder="Clase de ícono (ej. fas fa-users)" name="icono" id="edit_icono" required>

                <button type="submit" id="modificarbtn" class="btn" onclick="event.preventDefault(); actualizarDatos();">Modificar</button>
            </form>
        </div>
    </div>
</div>
