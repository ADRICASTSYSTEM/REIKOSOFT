<div class="contenidogrid main">
    <div id="contenido">
        <div id="titulocontenido">
            <p>Información General</p>
        </div>
        <div id="listadocontenido">
            <!-- Pestaña 1: Negocios -->
            <div class="pestañas">
                <div class="contenedortxtpestaña">
                    <div class="p1" style="text-align:justify; color:black;">
                        <input type="checkbox" id="pregunta1" class="check preguntas">
                        <label class="lblchbx" for="pregunta1">Negocios</label>
                    </div>
                    <div id="respuesta1" class="respuestas">
                        <p class="parrafo1">
                            En nuestro portal, ofrecemos soluciones tecnológicas innovadoras para empresas y negocios de todos los tamaños. Nos especializamos en el desarrollo de aplicaciones móviles, software a medida, diseño web, análisis de datos y mucho más.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Pestaña 2: Tecnologías Aplicadas -->
            <div class="pestañas">
                <div class="contenedortxtpestaña">
                    <div class="p1" style="text-align:justify; color:black;">
                        <input type="checkbox" id="pregunta2" class="check preguntas">
                        <label class="lblchbx" for="pregunta2">Tecnologías Aplicadas</label>
                    </div>
                    <div id="respuesta2" class="respuestas">
                        <p class="parrafo1">
                            Utilizamos las últimas tecnologías y metodologías de desarrollo para ofrecer soluciones de vanguardia que impulsen el crecimiento y la eficiencia de su negocio. Nuestro equipo de expertos está capacitado en una variedad de tecnologías, incluyendo HTML, CSS, JavaScript, Python, Java, entre otros.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Pestaña 3: Compromiso con los Clientes -->
            <div class="pestañas">
                <div class="contenedortxtpestaña">
                    <div class="p1" style="text-align:justify; color:black;">
                        <input type="checkbox" id="pregunta3" class="check preguntas">
                        <label class="lblchbx" for="pregunta3">Compromiso con los Clientes</label>
                    </div>
                    <div id="respuesta3" class="respuestas">
                        <p class="parrafo1">
                            Estamos comprometidos a proporcionar a nuestros clientes soluciones tecnológicas de alta calidad que se adapten a sus necesidades específicas. Nos esforzamos por establecer relaciones sólidas y duraderas con nuestros clientes, basadas en la confianza, la transparencia y la satisfacción del cliente.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Pestaña 4: Beneficios de Trabajar con Nosotros -->
            <div class="pestañas">
                <div class="contenedortxtpestaña">
                    <div class="p1" style="text-align:justify; color:black;">
                        <input type="checkbox" id="pregunta4" class="check preguntas">
                        <label class="lblchbx" for="pregunta4">Beneficios de Trabajar con Nosotros</label>
                    </div>
                    <div id="respuesta4" class="respuestas">
                        <p class="parrafo1">
                            Al elegir trabajar con nosotros, los clientes pueden beneficiarse de nuestra experiencia y conocimientos en el campo de la tecnología. Ofrecemos soluciones personalizadas, atención al cliente excepcional y resultados sobresalientes que ayudarán a impulsar el éxito de su negocio.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Pestaña 5: Valores Fundamentales -->
            <div class="pestañas">
                <div class="contenedortxtpestaña">
                    <div class="p1" style="text-align:justify; color:black;">
                        <input type="checkbox" id="pregunta5" class="check preguntas">
                        <label class="lblchbx" for="pregunta5">Valores Fundamentales</label>
                    </div>
                    <div id="respuesta5" class="respuestas">
                        <p class="parrafo1">
                            En nuestra empresa, nos guiamos por una serie de valores fundamentales que reflejan nuestra ética empresarial y nuestra cultura organizacional. Estos valores incluyen la integridad, la innovación, la colaboración, la responsabilidad y el compromiso con la excelencia.
                        </p>
                    </div>
                </div>
            </div>
            <script>
                aparecerpestañas();
            </script>
        </div>
    </div>
    <div id="imagencontenido">
        <img src="{{ route('recursos.show', ['img', 'portadaweb.png']) }}" alt="">
    </div>
</div>
