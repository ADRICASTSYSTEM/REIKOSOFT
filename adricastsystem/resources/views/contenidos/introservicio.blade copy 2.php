<main class="main">
        @include('contenidos.slider')
        <section class="sectionblock-1c">

        
        <div class="card-container">
            <button class="prev-button">&#8249;</button>
            
            <div class="cards">
                <div class="card2">
                    <img src="{{ route('recursos.show', ['img', 'api.png']) }}" alt="Imagen de ejemplo">
                    <div class="card-text2">
                    <h2>Desarrollo de API's</h2>
                    <p>
                        Ofrecemos servicios especializados en el desarrollo de APIs robustas y escalables. Diseñamos interfaces que facilitan la integración entre sistemas, garantizando seguridad, rendimiento y una entrega eficiente de datos para proyectos web, móviles o de escritorio.
      
                    <a class="enlace" href="https://wa.me/593994643169?text=Hola%2C%20me%20gustaría%20obtener%20más%20información%20sobre%20desarrollo%20de%20Apis." target="_blank" >Consultar</a>

                    </p>
                    </div>
                </div>

                <div class="card2">
                    <img src="{{ route('recursos.show', ['img', 'proyectosuniversitarios.png']) }}" alt="Imagen de ejemplo">
                    <div class="card-text2">
                    <h2>Proyectos Universitarios</h2>
                    <p style="text-align: justify;">
                        Ofrecemos desarrollo de proyectos universitarios en software a medida. Creamos aplicaciones web, móviles y de escritorio que cumplen con los requisitos académicos, garantizando funcionalidad, calidad y una entrega puntual para tus evaluaciones.     
                    <a class="enlace"  href="https://wa.me/593994643169?text=Hola%2C%20me%20gustaría%20obtener%20más%20información%20sobre%20sus%20servicios%20de%20Proyectos%20Universitarios." target="_blank" >Consultar</a>

                    </p>
                    </div>
                </div>

               <div class="card2">
                    <img src="{{ route('recursos.show', ['img', 'arduino.png']) }}" alt="Imagen de ejemplo">
                    <div class="card-text2">
                    <h2>Electronica Arduino</h2>
                    <p style="text-align: justify;">Diseñamos y programamos sketch personalizados para placas Arduino, adaptados a las necesidades de cada proyecto. Ofrecemos soluciones eficientes para automatización, control de dispositivos, monitoreo de sensores y proyectos IoT.
                    <a class="enlace"  href="https://wa.me/593994643169?text=Hola%2C%20me%20gustaría%20obtener%20más%20información%20sobre%20sus%20servicios%20electronica%20con%20arduino." target="_blank" >Consultar</a>
 
                    </p>
                    </div> 
                </div>
                <div class="card2">
                    <img src="{{ route('recursos.show', ['img', 'desarrolloweb2.png']) }}" alt="Imagen de ejemplo">
                    <div class="card-text2">
                    <h2>Desarrollo Web</h2>
                    <p style="text-align: justify;">
                        
                        Creamos aplicaciones web personalizadas, adaptadas a las necesidades de cada cliente. Ofrecemos soluciones seguras, rápidas y escalables para sitios, sistemas administrativos y plataformas interactivas. Nos enfocamos en brindar una experiencia de usuario de calidad.    
                    <a class="enlace"  href="https://wa.me/593994643169?text=Hola%2C%20me%20gustaría%20obtener%20más%20información%20sobre%20sus%20servicios%20desarrollo%20web." target="_blank" >Consultar</a>
 
                    </p>
                    </div> 
                </div>  
                <div class="card2">
                    <img src="{{ route('recursos.show', ['img', 'desarrolloescritorio.png']) }}" alt="Imagen de ejemplo">
                    <div class="card-text2">
                    <h2>Desarrollo de Escritorio</h2>
                    <p style="text-align: justify;">
                        
                        Diseñamos y desarrollamos aplicaciones de escritorio personalizadas, adaptadas a las necesidades de tu negocio o proyecto. Creamos soluciones rápidas, seguras y eficientes para gestión de procesos, sistemas administrativos y herramientas especializadas.

    
                    <a class="enlace"  href="https://wa.me/593994643169?text=Hola%2C%20me%20gustaría%20obtener%20más%20información%20sobre%20sus%20servicios%20desarrollo%20escritorio." target="_blank" >Consultar</a>
 
                    </p>
                    </div> 
                </div>  
                <div class="card2">
                    <img src="{{ route('recursos.show', ['img', 'RPA.png']) }}" alt="Imagen de ejemplo">
                    <div class="card-text2">
                    <h2>Automatización con RPA</h2>
                    <p style="text-align: justify;">
                        
                        Creamos bots personalizados para automatizar tareas repetitivas y optimizar procesos empresariales. Ahorra tiempo, reduce errores, mejora la eficiencia y libera a tu equipo para tareas más estratégicas y de mayor valor operativo.
    
                    <a class="enlace"  href="https://wa.me/593994643169?text=Hola%2C%20me%20gustaría%20obtener%20más%20información%20sobre%20sus%20servicios%20de%20RPA." target="_blank" >Consultar</a>
 
                    </p>
                    </div> 
                </div>  
              <!-- Repite el código HTML de la tarjeta para crear las otras 9 tarjetas -->
            </div>
            <button class="next-button">&#8250;</button>
          </div>
        </section>

       
        <script> 
           
            
            let scrollAmount = 0; 
            let prevButton; // Declarar prevButton en un alcance más amplio
            let nextButton; // Declarar nextButton en un alcance más amplio

           
            funciontarjeta();
        </script>
</main>