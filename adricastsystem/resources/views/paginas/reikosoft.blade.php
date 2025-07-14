
    @auth
        {{-- El usuario está autenticado, muestra el dashboard --}}
        @include('reikosoft.presentacion')
    @endauth
    @guest
        {{-- El usuario no está autenticado, muestra el formulario de login --}}
        @include('reikosoft.auth.login')
    @endguest

    @include('contenidos.pie')
