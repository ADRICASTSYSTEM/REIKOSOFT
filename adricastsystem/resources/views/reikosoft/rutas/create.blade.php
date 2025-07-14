@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'Crear Ruta')
@section('reikosoft-active', 'active')

@section('contenidoreiko')
    <script>
        var StoreRutaUrl = "{{ route('rutas.store') }}";
    </script>
    <script src="{{ route('recursos.show', ['js/reiko', 'rutasreiko.js']) }}"></script>
 
    <section class="containerreiko">
        <div class="contenedorformularios">
            <form action="{{ route('rutas.store') }}" id="formRuta" method="post" novalidate>
                @csrf

                {{-- Seleccionar Módulo --}}
                <select name="modulo_id" id="modulo_id" required>
                    <option value="">Seleccione un módulo</option>
                    @foreach($modulos as $modulo)
                        <option value="{{ $modulo->id }}" {{ old('modulo_id') == $modulo->id ? 'selected' : '' }}>
                            {{ $modulo->nombre }}
                        </option>
                    @endforeach
                </select>

                {{-- Nombre de la Ruta --}}
                <input type="text" name="nombre" placeholder="Nombre de la Ruta" id="nombre" value="{{ old('nombre') }}" required>

                {{-- URL --}}
                <input type="text" name="ruta" placeholder="URL de la Ruta" id="url" value="{{ old('url') }}" required>

                {{-- Descripción --}}
                <input type="text" name="descripcion" placeholder="Descripción de la Ruta" id="descripcion" value="{{ old('descripcion') }}" required>

                {{-- Método HTTP --}}
                <select name="metodo" id="metodo_http" required>
                    <option value="">Seleccione el método HTTP</option>
                    <option value="GET" {{ old('metodo_http') == 'GET' ? 'selected' : '' }}>GET</option>
                    <option value="POST" {{ old('metodo_http') == 'POST' ? 'selected' : '' }}>POST</option>
                    <option value="PUT" {{ old('metodo_http') == 'PUT' ? 'selected' : '' }}>PUT</option>
                    <option value="DELETE" {{ old('metodo_http') == 'DELETE' ? 'selected' : '' }}>DELETE</option>
                    <option value="PATCH" {{ old('metodo_http') == 'PATCH' ? 'selected' : '' }}>PATCH</option>
                </select>

                {{-- Convención --}}
                <select name="convencion" id="convencion">
                    <option value="">Seleccione una convención</option>
                    <option value="index" {{ old('convencion') == 'index' ? 'selected' : '' }}>Index (listar)</option>
                    <option value="store" {{ old('convencion') == 'store' ? 'selected' : '' }}>Store (guardar)</option>
                    <option value="create" {{ old('convencion') == 'create' ? 'selected' : '' }}>Create (formulario)</option>
                    <option value="show" {{ old('convencion') == 'show' ? 'selected' : '' }}>Show (ver)</option>
                    <option value="edit" {{ old('convencion') == 'edit' ? 'selected' : '' }}>Edit (editar)</option>
                    <option value="update" {{ old('convencion') == 'update' ? 'selected' : '' }}>Update (actualizar)</option>
                    <option value="destroy" {{ old('convencion') == 'destroy' ? 'selected' : '' }}>Destroy (eliminar)</option>
                </select>

                {{-- Estado --}}
                <div style="display: flex; height:30px; width:auto;">
                    <label for="ruta_estado" style="width: 90%;">¿Activo?</label>
                    <input type="checkbox" style="height: 30px;" name="ruta_estado" id="ruta_estado" value="1" {{ old('ruta_estado') ? 'checked' : '' }}>
                </div>

                {{-- Botones --}}
                <div style="display:flex;">
                    <button style="margin-right: 10px;" class="btn" type="submit" onclick="event.preventDefault(); guardarDatos();">Guardar</button>
                    <button style="margin-right: 10px;" class="btn" onclick="event.preventDefault(); principal();">Cancelar</button>
                </div>
            </form>

           
        </div>
    </section>
@endsection
