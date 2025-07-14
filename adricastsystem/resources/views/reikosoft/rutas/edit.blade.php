<div class="reikomodal" id="editmodal">
    <div class="contenidomodal">
        <div class="bannertitulo">
            Editar Ruta
        </div>
        <div class="closemodal">
            <button onclick="cerrarModaledit()">
                <span class="fa fa-times"></span>
            </button>
        </div>
        <div class="cuerpomodal">
            <form action="{{ route('rutas.update', '__ID__') }}" id="miFormulario" method="post" novalidate>
                @csrf
                @method('PUT')

                {{-- Seleccionar Módulo --}}
                <select name="modulo_id" id="edit_modulo_id" required>
                    <option value="">Seleccione un módulo</option>
                    @foreach($modulos as $modulo)
                        <option value="{{ $modulo->id }}">{{ $modulo->nombre }}</option>
                    @endforeach
                </select>

                {{-- Nombre de la Ruta --}}
                <input type="text" name="nombre" placeholder="Nombre de la Ruta" id="edit_nombre" required>

                {{-- URL --}}
                <input type="text" name="ruta" placeholder="URL de la Ruta" id="edit_url" required>

                {{-- Descripción --}}
                <input type="text" name="descripcion" placeholder="Descripción de la Ruta" id="edit_descripcion" required>

                {{-- Método HTTP --}}
                <select name="metodo" id="edit_metodo_http" required>
                    <option value="">Seleccione el método HTTP</option>
                    <option value="GET">GET</option>
                    <option value="POST">POST</option>
                    <option value="PUT">PUT</option>
                    <option value="DELETE">DELETE</option>
                    <option value="PATCH">PATCH</option>
                </select>

                {{-- Convención --}}
                <select name="convencion" id="edit_convencion">
                    <option value="">Seleccione una convención</option>
                    <option value="index">Index</option>
                    <option value="store">Store</option>
                    <option value="create">Create</option>
                    <option value="show">Show</option>
                    <option value="edit">Edit</option>
                    <option value="update">Update</option>
                    <option value="destroy">Destroy</option>
                </select>

                {{-- Estado --}}
                <div style="display: flex; height:30px; width:auto;">
                    <label for="edit_ruta_estado" style="width: 90%;">¿Activo?</label>
                    <input type="checkbox" style="height: 30px;" name="ruta_estado" id="edit_ruta_estado" value="1">
                </div>

                {{-- Botón --}}
                <button type="submit" id="modificarbtn" class="btn" onclick="event.preventDefault(); actualizarDatos();">Modificar</button>
            </form>
        </div>
    </div>
</div>
