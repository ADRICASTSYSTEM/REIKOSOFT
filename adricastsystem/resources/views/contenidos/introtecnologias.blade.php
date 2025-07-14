
<main class="main contenedor">
    <div id="titulos" class="titulo">
        <h2>Tecnologias</h2>
    </div>
    
    <section class="sectionblock-1c">
       
        <div class="card-container">
            <button class="prev-button">&#8249;</button>
            <div class="cards">
                <!-- Frontend -->
                <div class="card2" onclick="mostrarInformacion('Frontend', 'Usamos tecnologías como HTML, CSS y JavaScript para crear interfaces interactivas que mejoran la experiencia del usuario. Frameworks como Angular, React y Vue.js nos permiten desarrollar aplicaciones web escalables, dinámicas y de alto rendimiento.')">
                    <img src="{{ route('recursos.show', ['img', 'front.png']) }}" alt="Imagen de ejemplo">
                    <div class="card-text2">
                        <h2>Frontend</h2>
                        <p>
                            HTML, CSS y JavaScript son esenciales para la construcción de la interfaz de usuario. Frameworks como Angular, React y Vue.js ofrecen poderosas herramientas para desarrollar aplicaciones web dinámicas y reactivas.
                        </p>
                    </div>
                </div>

                <!-- Backend -->
                <div class="card2" onclick="mostrarInformacion('Backend', 'El backend es crucial para gestionar la lógica del servidor, las bases de datos y la seguridad. Usamos tecnologías como Node.js, Python con Django o Flask, Ruby on Rails y Java con Spring para crear aplicaciones robustas y escalables.')">
                    <img src="{{ route('recursos.show', ['img', 'back.png']) }}" alt="Imagen de ejemplo">
                    <div class="card-text2">
                        <h2>Backend</h2>
                        <p>
                            Tecnologías como .net, Node.js, Python (Django, Flask), Ruby on Rails y Java (Spring) nos permiten gestionar la lógica del servidor, manejar la autenticación y la seguridad, y conectar con bases de datos para almacenar la información de la aplicación.
                            
                        </p>
                    </div>
                </div>

                <!-- Bases de Datos -->
                <div class="card2" onclick="mostrarInformacion('Bases de Datos', 'Las bases de datos relacionales (SQL) y no relacionales (NoSQL) son fundamentales para almacenar y organizar la información. SQL es ideal para datos estructurados y con relaciones, mientras que NoSQL es mejor para grandes volúmenes de datos no estructurados.')">
                    <img src="{{ route('recursos.show', ['img', 'basedatos.png']) }}" alt="Imagen de ejemplo">
                    <div class="card-text2">
                        <h2>Bases de Datos</h2>
                        <p>
                            Usamos bases de datos SQL (MySQL, PostgreSQL) cuando se requiere consistencia y relaciones entre datos. Las bases de datos NoSQL (como MongoDB) se utilizan cuando la flexibilidad y la escalabilidad son más importantes.
                          
                        </p>
                    </div>
                </div>

                <!-- Desarrollo de APIs -->
                <div class="card2" onclick="mostrarInformacion('Desarrollo de APIs', 'Las APIs son esenciales para la comunicación entre el frontend y backend. Usamos RESTful APIs, GraphQL y WebSockets para ofrecer diferentes opciones de transferencia de datos, optimizando la eficiencia y la velocidad de las aplicaciones.')">
                    <img src="{{ route('recursos.show', ['img', 'apis.png']) }}" alt="Imagen de ejemplo">
                    <div class="card-text2">
                        <h2>Desarrollo de APIs</h2>
                        <p>
                            Las APIs permiten que el frontend y el backend interactúen de manera eficiente. Usamos RESTful APIs para simplicidad, GraphQL para flexibilidad en las consultas y WebSockets para comunicación en tiempo real.
                          
                        </p>
                    </div>
                </div>

                <!-- RPA -->
                <div class="card2" onclick="mostrarInformacion('RPA', 'La Automatización Robótica de Procesos (RPA) permite automatizar tareas repetitivas y basadas en reglas en aplicaciones empresariales. Herramientas como UiPath y Automation Anywhere pueden integrarse con el software para optimizar procesos y reducir costos.')">
                    <img src="{{ route('recursos.show', ['img', 'rpatec.png']) }}" alt="Imagen de ejemplo">
                    <div class="card-text2">
                        <h2>RPA</h2>
                        <p>
                            RPA es clave para mejorar la eficiencia al automatizar tareas repetitivas y manuales en el entorno empresarial. Con herramientas como UiPath y Automation Anywhere, podemos reducir el error humano y acelerar los procesos de negocio.
                           
                        </p>
                    </div>
                </div>

            </div>
            <button class="next-button">&#8250;</button>
        </div>
    </section>

    <script>
        function mostrarInformacion(titulo, descripcion) {
            alert('¡Has hecho clic en la tarjeta de: ' + titulo + '!\n' + descripcion);
            // Aquí puedes cambiar el contenido de un modal o realizar cualquier otra acción.
        }
        let scrollAmount = 0; 
            let prevButton; // Declarar prevButton en un alcance más amplio
            let nextButton; // Declarar nextButton en un alcance más amplio

           
            funciontarjeta();
    </script>
</main>
