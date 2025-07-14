<div class="reikomodal" id="editmodal">
    <div class="contenidomodal">
        <div class="bannertitulo">
            Mensajes de Contacto
        </div>
        <div class="closemodal">
           <button onclick="cerrarModal()">
                <span class="fa fa-times"></span>
           </button>
        </div>
        <div class="cuerpomodal">
                <div class="mensaje" style="display: block;">
                    <div class="elemento">
                        <label for="nombre"> Nombre </label>
                        <input type="text" name="nombre" id="nombre" readonly>   
                    </div>
                    <div class="elemento">
                        <label for="telefono"> Telefono </label>
                        <input type="text" name="telefono" id="telefono" readonly>
                    </div>
                    <div class="elemento">
            
                        <label for="asunto"></label>
                        <input type="text" name="asunto" id="asunto" readonly>
                    </div>
                    <div class="elemento">
                        <label for="correo"> Correo </label>
                        <input type="text" name="correo" id="correo" readonly>
                    </div>
                    <div class="elemento">
                        <label for="mensaje"> Mensaje </label>
                        <textarea name="mensaje"  id="mensaje" cols="30" rows="10"></textarea>
                    </div>
                  


                </div>

        </div>

    </div>
</div>