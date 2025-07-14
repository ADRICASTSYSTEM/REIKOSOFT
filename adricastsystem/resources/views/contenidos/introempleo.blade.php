<section class="contenedor">
    <div class="titulo">
        <h2>A que puestos puedes aplicar</h2>
    </div>
    <div class="sectionblock-1c">

      
    <div class="card-container" style="padding: 10px;">
        <button class="prev-button" >&#8249;</button>
        <div class="cards">
            <div class="card2">
                <img src="{{ route('recursos.show', ['img', 'disenoweb.png']) }}" alt="Imagen de ejemplo">
                <!--  -->
                <div class="card-text2">
                <h2>Diseñador Web</h2>
                <p>
                Es el profesional que diseña la apariencia y funcionalidad de un sitio web.
                Combina creatividad, usabilidad y tecnología para crear experiencias atractivas y fáciles de usar.
                ¡Es quien convierte ideas en páginas que inspiran!
                </p>
                </div>
                <!-- --> 
            </div>
            <div class="card2">
                <img src="{{ route('recursos.show', ['img', 'desarrolladorweb.png']) }}" alt="Imagen de ejemplo">
                <div class="card-text2">
                    <h2>Desarrollador Web</h2>
                    <p>
                    Crea y mantiene sitios web y aplicaciones.
                    Usa lenguajes como HTML, CSS y JavaScript para que todo funcione bien y se vea profesional.
                    Trabaja en equipo con diseñadores para ofrecer experiencias digitales de calidad.
                    </p>
                </div>
            </div>
            <div class="card2">
                <img src="{{ route('recursos.show', ['img', 'desarrollomovil.png']) }}" alt="Imagen de ejemplo">
                <div class="card-text2">
                <h2>Desarrollador Movil</h2>
                <p>
                Diseña y desarrolla aplicaciones para dispositivos móviles como teléfonos y tablets.
                Se enfoca en crear experiencias rápidas, intuitivas y útiles para el usuario.
                ¡Convierte ideas en apps que llevas contigo a todas partes!  
                </p>
                </div> 
            </div>
            <div class="card2">
                <img src="{{ route('recursos.show', ['img', 'asesoria.png']) }}" alt="Imagen de ejemplo">
                <div class="card-text2">
                <h2><h2>Desarrollo App de Escritorio</h2></h2>
                <p>
                Crea programas que se instalan y usan en computadoras.
                Se enfoca en rendimiento, seguridad y una buena experiencia para el usuario.
                ¡Desarrolla soluciones que hacen más fácil tu trabajo diario!
                </p>
                </div>
            </div>     
            <div class="card2">
                <img src="{{ route('recursos.show', ['img', 'basededatos.png']) }}" alt="Imagen de ejemplo">
                <div class="card-text2">
                <h2><h2>Arquitecto de Datos</h2></h2>
                <p>
                Diseña la estructura y organización de los datos en un sistema.
                Se asegura de que la información sea accesible, segura y eficiente.
                ¡Es quien construye el “cerebro” detrás de las aplicaciones!
                </p>
                </div>
            </div>   
            <div class="card2">
                <img src="{{ route('recursos.show', ['img', 'analisisdedatos.png']) }}" alt="Imagen de ejemplo">
                <div class="card-text2">
                <h2><h2>Analista de Datos</h2></h2>
                <p>
                Analiza grandes volúmenes de información para encontrar patrones y responder preguntas clave.
                Ayuda a las empresas a tomar mejores decisiones basadas en datos reales.
                ¡Convierte números en ideas útiles para el negocio!
                 </p>
                </div>
            </div>          
      <!-- Repite el código HTML de la tarjeta para crear las otras 9 tarjetas -->
        </div>
        <button class="next-button">&#8250;</button>
    </div>
</div>

</section>



<script> 
           
            
           let scrollAmount = 0; 
           let prevButton; // Declarar prevButton en un alcance más amplio
           let nextButton; // Declarar nextButton en un alcance más amplio

          
           funciontarjeta();
       </script>