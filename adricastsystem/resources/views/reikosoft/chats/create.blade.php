<div class="reikomodal" id="editmodal">
   
    <div class="contenidomodal">
        <div class="bannertitulo">
            CHATS  <i class="fas fa-comments"></i> 
        </div>
        <div class="closemodal">
           <button onclick="cerrarModal()">
                <span class="fa fa-times"></span>
           </button>
        </div>
        <div class="cuerpomodal">

            <form action="{{ route('chats.store') }}" id="miFormulario" method="post" enctype="multipart/form-data" novalidate>
                @csrf
  
                <input type="text" name="username" id="username" placeholder="Escribir el Nombre del Usuario">
                <textarea name="mensaje" id="mensaje" cols="30" rows="10" placeholder="Escribir el Mensaje"></textarea>
                <button type="submit" class="btn" id="guardarbtn" onclick="event.preventDefault(); guardarDatos();">Enviar</button>
              
            </form>
          
        </div>

    </div>
</div>