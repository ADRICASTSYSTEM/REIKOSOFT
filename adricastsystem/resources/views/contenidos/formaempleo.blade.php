<div class="contenidogrid">
    <div id="contenido">
        <div id="titulocontenido">
            <p>Trabaja con Nosotros - Enfoque Freelance</p>
        </div>
        <div id="listadocontenido">
            <!-- Pestaña 1: Modalidades de Trabajo -->
            <div class="pestañas">
                <div class="contenedortxtpestaña">
                    <div class="p1" style="text-align:justify; color:black;">
                        <input type="checkbox" id="pregunta1" class="check preguntas">
                        <label class="lblchbx" for="pregunta1">Modalidades de Trabajo</label>
                    </div>
                    <div id="respuesta1" class="respuestas">
                        <p class="parrafo1" style="text-align: justify";>
                            Ofrecemos oportunidades freelance por proyecto. Tú eliges los proyectos en los que deseas participar, con horarios flexibles y pagos por entregable.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Pestaña 2: Nuestro Flujo Ágil -->
            <div class="pestañas">
                <div class="contenedortxtpestaña">
                    <div class="p1" style="text-align:justify; color:black;">
                        <input type="checkbox" id="pregunta2" class="check preguntas">
                        <label class="lblchbx" for="pregunta2">Nuestro Flujo Ágil</label>
                    </div>
                    <div id="respuesta2" class="respuestas">
                        <p class="parrafo1">
                            Trabajamos con metodologías ágiles como Scrum y Kanban. Organizamos los proyectos en sprints y usamos herramientas colaborativas como Trello, Jira y Slack.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Pestaña 3: Cómo Unirte a un Proyecto -->
            <div class="pestañas">
                <div class="contenedortxtpestaña">
                    <div class="p1" style="text-align:justify; color:black;">
                        <input type="checkbox" id="pregunta3" class="check preguntas">
                        <label class="lblchbx" for="pregunta3">Cómo Unirte a un Proyecto</label>
                    </div>
                    <div id="respuesta3" class="respuestas">
                        <p class="parrafo1">
                            Publicamos proyectos disponibles en nuestra comunidad y tú decides a cuáles postularte. Valoramos tu experiencia, especialización y disponibilidad.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Pestaña 4: Herramientas que Usamos -->
            <div class="pestañas">
                <div class="contenedortxtpestaña">
                    <div class="p1" style="text-align:justify; color:black;">
                        <input type="checkbox" id="pregunta4" class="check preguntas">
                        <label class="lblchbx" for="pregunta4">Herramientas que Usamos</label>
                    </div>
                    <div id="respuesta4" class="respuestas">
                        <p class="parrafo1">
                            GitHub, Slack, Notion, Figma y plataformas de gestión ágil forman parte de nuestro stack colaborativo. Todo para facilitar la comunicación y productividad remota.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Pestaña 5: Comunidad Freelance -->
            <div class="pestañas">
                <div class="contenedortxtpestaña">
                    <div class="p1" style="text-align:justify; color:black;">
                        <input type="checkbox" id="pregunta5" class="check preguntas">
                        <label class="lblchbx" for="pregunta5">Comunidad Freelance</label>
                    </div>
                    <div id="respuesta5" class="respuestas">
                        <p class="parrafo1">
                            Más que un equipo, somos una comunidad global de talentos independientes. Colaboramos, compartimos conocimiento y creamos soluciones con impacto real.
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

       <img src="{{ route('recursos.show', ['img', 'freelancer.png']) }}" alt="">


    </div>

</div>


