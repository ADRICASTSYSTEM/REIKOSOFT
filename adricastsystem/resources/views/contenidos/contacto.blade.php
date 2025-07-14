<main class="contact-form">
    <div class="form-container">
        
        <div class="form-title">
            <h1>Contactanos</h1>
        </div>
        <div class="form-section">
            <h2><i class="fa fa-envelope" aria-hidden="true"></i></h2>
            <form action="{{route('contactanos.store')}}" id="miFormulario" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" value="{{ isset($datos['nombre']) ? $datos['nombre'] : '' }}" required>
                <input type="tel" id="telefono" name="telefono" placeholder="Teléfono" value="{{ isset($datos['telefono']) ? $datos['telefono'] : '' }}" required>
                <input type="text" id="asunto" name="asunto" placeholder="Asunto" value="{{ isset($datos['asunto']) ? $datos['asunto'] : '' }}" required>
                <input type="email" id="correo" name="correo" placeholder="Correo electrónico" value="{{ isset($datos['correo']) ? $datos['correo'] : '' }}" required>
                <textarea id="mensaje" placeholder="Mensaje" name="mensaje" rows="4" required>{{ isset($datos['mensaje']) ? $datos['mensaje'] : '' }}</textarea>
                <button type="submit">Enviar</button>
            </form>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
</main>
