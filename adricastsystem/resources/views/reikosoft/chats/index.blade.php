@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')
<script>
    var StoreUrl = "{{ route('chats.store') }}";  
     const rutaSonido = "{{ route('recursos.show', ['sound', 'sound1.mp3']) }}";


</script>
<script src="{{ route('recursos.show', ['js/reiko', 'chatsreiko.js']) }}"></script>


<section class="containerreiko">
    <div class="contenedorchat">
        <div class="addchat">
            <button class="btnaddchat" onclick="addChat()"> <i class="fas fa-comments"></i> Chat</button>
        </div>

        <div class="searchchat">
            <input type="text" name="busqueda" id="busqueda" placeholder="Busqueda de Datos" onkeyup="consultaDatos()">
            <button class="busqueda" onclick="searchChat()"> <i class="fas fa-search"></i> </button>
        </div>

        <div class="headerchat" id="headerchat">
         
            <button id="btnVolverChats" class="btn-volver" onclick="mostrarUsersChat()" style="display: none;">
                <i class="fas fa-arrow-left"></i>
            </button>
            <span id="chat-username"></span>
        </div>

        <div class="userschat" id="userschat">

            @foreach($userMessages as $userMessage)

            <div class="userchat" id="userchat_{{ $userMessage['user']->id }}">
                <div class="chat-options">
                    <button class="btn-options" onclick="toggleDropdown(event)">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>

                    <ul class="dropdown-menu" id="user-menu-{{ $userMessage['user']->id }}" style="display:none;">
                        <li onclick="eliminarConversacion({{ $userMessage['user']->id }})">Eliminar conversación</li>
                    </ul>
                </div>

                <div class="userchatimg">
                    @if($userMessage['user']->foto)
                        <img src="{{ asset('img/perfiles/' . $userMessage['user']->foto) }}" alt="Foto de perfil">
                    @else
                        <img src="{{ route('recursos.show', ['img', 'logotype.png']) }}" alt="Foto de perfil">
                    @endif

                    {{-- Contador de mensajes no leídos --}}
                    @if(isset($userMessage['unread_count']) && $userMessage['unread_count'] > 0)
                        <span class="unread-badge">{{ $userMessage['unread_count'] }}</span>
                    @endif
                </div>

                <div class="userchatinfo">
                    <p class="username" id="username_{{ $userMessage['user']->id }}">{{ $userMessage['user']->name }}</p>
                    <p class="message-preview">{{ $userMessage['last_message'] }}</p>
                    <p class="timestamp">{{ $userMessage['timestamp'] }}</p>
                </div>
            </div>
            @endforeach

            <script>
                $(document).ready(function () {
                    $('.userchat').click(function () {
                        const userId = $(this).attr('id').split('_')[1];
                        const username = $('#username_' + userId).text();

                        // ✅ Guardamos el ID de la conversación activa
                        conversacionActiva = $(this).attr('id');

                        // ✅ Marcamos visualmente como activa
                        $('.userchat').removeClass('active');
                        $(this).addClass('active');

                        activarChat(userId, username);
                    });

                    actualizarContadores();
                    setInterval(actualizarContadores, 5000);
                });

            </script>

        </div>

        <div class="chatbox" id="chatbox"></div>

        <div class="chatwrite">
            <input type="text" name="mensaje" id="mensaje" placeholder="Escribe un mensaje">
            <button class="enviarchat" onclick="enviarMensaje()"> <i class="fas fa-paper-plane"></i></button>
        </div>
    </div>
</section>

@include('reikosoft.chats.create') 
@endsection
