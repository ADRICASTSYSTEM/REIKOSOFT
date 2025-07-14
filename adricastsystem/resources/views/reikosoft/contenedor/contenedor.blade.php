<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>REIKOSOFT</title>

  <!-- FontAwesome -->
  <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet" />
  <link rel="icon" href="{{ route('recursos.show', ['img', 'min.png']) }}" />

  <!-- Bootstrap CSS -->
  <link
    rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
  />

  <!-- Estilos propios -->
  <link href="{{ asset('css/estilo_contenedores.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/estilo_reiko.css') }}" rel="stylesheet" />

  <!-- SweetAlert -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.css"
  />

  <!-- JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script
    src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
  ></script>
  <script src="{{ route('recursos.show', ['js', 'funciones.js']) }}"></script>
  <script src="{{ route('recursos.show', ['js/reiko/', 'funcionesreiko.js']) }}"></script>
  <script src="{{ route('recursos.show', ['js', 'script.js']) }}" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.js"></script>
  <script src="{{ route('recursos.show', ['fontawesome/js', 'all.js']) }}"></script>
</head>

<body>
  <section class="reikocontenedor">

    <div id="infosystem" class="d-flex align-items-center gap-2 p-2">
      @if(isset($user))
        @if (isset($user->foto))
          <img
            src="{{ route('recursos.show', ['img/perfiles', $user->foto]) }}"
            alt="Foto perfil"
            width="40"
            height="40"
            class="rounded-circle"
          />
        @else
          <img
            src="{{ route('recursos.show', ['img', 'logotype.png']) }}"
            alt="Logo"
            width="40"
            height="40"
            class="rounded-circle"
          />
        @endif

        @if (isset($user->typeUser->descripcion))
          <p class="mb-0">{{ $user->typeUser->descripcion }} -</p>
        @endif

        <p class="mb-0">{{ $user->name }}</p>
      @else
        <p>No hay información de usuario disponible.</p>
      @endif
    </div>

    <div id="contenedormodulos" class="d-flex align-items-center">
      <button class="prevbuttonmenu" id="prevButton">&#8249;</button>

      <div id="modulos" class="d-flex gap-3 px-3" style="overflow-x:hidden;">
        {{-- Aquí se cargarán dinámicamente los módulos --}}
        @foreach ($modulos as $modulo)
          @if (Route::has($modulo->ruta . '.index'))
            <a href="{{ route($modulo->ruta . '.index') }}" title="{{ $modulo->nombre }}">
              <img
                src="{{ asset('img/modulos/' . $modulo->icono) }}"
                alt="{{ $modulo->nombre }}"
                width="40"
                height="40"
              />
            </a>
          @else
            <a href="#" title="{{ $modulo->nombre }}">
              <img
                src="{{ asset('img/modulos/' . $modulo->icono) }}"
                alt="{{ $modulo->nombre }}"
                width="40"
                height="40"
              />
            </a>
          @endif
        @endforeach
      </div>

      <button class="nextbuttonmenu" id="nextButton">&#8250;</button>

      <script>
        funciontarjeta2();
      </script>
    </div>

    <div id="contenido-principal" class="d-flex">
      <nav class="menu-lateral">
        <ul>
          <li>
            <a href="{{ route('posts.index') }}">
              <i class="fas fa-house"></i>
              <span class="texto">Inicio</span>
            </a>
          </li>

          <li>
            <a href="#" class="seccion-link" data-id="all">
              <i class="fas fa-layer-group"></i>
              <span class="texto">Todos los Módulos</span>
            </a>
          </li>

          @foreach ($secciones as $seccion)
            <li>
              <a href="#" class="seccion-link" data-id="{{ $seccion->id }}">
                <i class="{{ $seccion->icono }}"></i>
                <span class="texto">{{ $seccion->nombre }}</span>
              </a>
            </li>
          @endforeach

          <li>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="fas fa-right-from-bracket"></i>
              <span class="texto">Salir</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
      </nav>

      <main id="contenedorprincipal" style="flex-grow:1; padding: 20px;">
        @yield('contenidoreiko')
        @stack('scripts')
      </main>
    </div>

    <footer id="piepagina" class="text-center py-2">
      REIKO TECNOLOGY 2025
    </footer>

  </section>
</body>
