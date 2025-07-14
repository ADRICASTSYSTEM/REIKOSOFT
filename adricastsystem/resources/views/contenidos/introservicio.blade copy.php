<main class="main">
     
        <section class="sectionblock-1c">

        
        <div class="card-container">
            <button class="prev-button">&#8249;</button>
            <div class="cards">
                <div class="card">
                    <img src="{{ route('recursos.show', ['img', 'api.png']) }}" alt="Imagen de ejemplo">
                    <div class="card-text">
                    <h2>Desarrollo de API's</h2>Ofrecemos servicios especializados en el desarrollo de APIs robustas y escalables. Diseñamos interfaces que facilitan la integración entre sistemas, garantizando seguridad, rendimiento y una entrega eficiente de datos para proyectos web, móviles o de escritorio.
      
                    <p style="text-align: justify;"> 
                    <a href="https://wa.me/593979450223?text=Hola%2C%20me%20gustaría%20obtener%20más%20información%20sobre%20sus%20productos." target="_blank" style="color:White; font-style:normal; text-decoration:none; background-color:darkblue; padding:3px; border-radius:5px; ">Consultar</a>

                    </p>
                    </div>
                </div>
                <div class="card">
                    <img src="{{ route('recursos.show', ['img', 'domotica.png']) }}" alt="Imagen de ejemplo">
                    <div class="card-text">
                    <h2>Domotica</h2>
                    <p style="text-align: justify;">Ofrecemos servicios de domótica que permiten automatizar y controlar sistemas en hogares y edificios, mejorando la comodidad, la eficiencia energética y la seguridad a través de tecnologías inteligentes.
                    <a href="https://wa.me/593979450223?text=Hola%2C%20me%20gustaría%20obtener%20más%20información%20sobre%20sus%20servicios%20domotica." target="_blank" style="color:White; font-style:normal; text-decoration:none; background-color:darkblue; padding:3px; border-radius:5px; ">Consultar</a>

                    </p>
                    </div>
                </div>
                <div class="card">
                    <img src="{{ route('recursos.show', ['img', 'arduino.png']) }}" alt="Imagen de ejemplo">
                    <div class="card-text">
                    <h2>Electronica Arduino</h2>
                    <p style="text-align: justify;">Ofrecemos asesoramiento, diseño, prototipado y programación utilizando la plataforma Arduino, permitiendo a nuestros clientes implementar sistemas electrónicos a medida. 
                    <a href="https://wa.me/593979450223?text=Hola%2C%20me%20gustaría%20obtener%20más%20información%20sobre%20sus%20servicios%20electronica%20con%20arduino." target="_blank" style="color:White; font-style:normal; text-decoration:none; background-color:darkblue; padding:3px; border-radius:5px; ">Consultar</a>

                    </p>
                    </div> 
                </div>
                <div class="card">
                    <img src="{{ route('recursos.show', ['img', 'asesoria.png']) }}" alt="Imagen de ejemplo">
                    <div class="card-text">
                    <h2>Asesorias</h2>
                    <p style="text-align: justify;">Brindamos asistencia en la planificación, implementación y optimización de sistemas, software, seguridad informática y estrategias tecnológicas. 
                    <a href="https://wa.me/593979450223?text=Hola%2C%20me%20gustaría%20obtener%20más%20información%20sobre%20sus%20servicios%20de%20asesorias%20informaticas." target="_blank" style="color:White; font-style:normal; text-decoration:none; background-color:darkblue; padding:3px; border-radius:5px; ">Consultar</a>

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