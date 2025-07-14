const ModulosApp = (() => {
  // URL base para la API
  const urlBase = '/modporseccion';

  // Cache de elementos DOM
  const $modulosDiv = $('#modulos');
  const $seccionLinks = $('.seccion-link');

  // Renderiza los módulos en el contenedor
  function renderModulos(modulos) {
    $modulosDiv.empty();

    if (!modulos || modulos.length === 0) {
      $modulosDiv.append('<p>No hay módulos para esta sección.</p>');
      return;
    }

    modulos.forEach(modulo => {
      let urlModulo = '#';
      if (modulo.ruta && modulo.ruta.trim() !== '') {
        urlModulo = '/' + modulo.ruta;
      }

      const $a = $('<a></a>')
        .attr('href', urlModulo)
        .attr('title', modulo.nombre);

      const $img = $('<img>')
        .attr('src', '/img/modulos/' + modulo.icono)
        .attr('alt', modulo.nombre)
        .attr('width', 40)
        .attr('height', 40);

      $a.append($img);
      $modulosDiv.append($a);
    });
  }

  // Solicita módulos a la API según la sección o todos
  function fetchModulos(seccionId) {
    let url = urlBase;

    if (seccionId && seccionId !== 'all') {
      url += '/seccion/' + seccionId;
    }

    return $.ajax({
      url: url,
      method: 'GET'
    });
  }

  // Maneja el click en las secciones
  function onSeccionClick(e) {
    e.preventDefault();

    const seccionId = $(this).data('id');
    fetchModulos(seccionId)
      .done(renderModulos)
      .fail(() => alert('Error al cargar los módulos'));
  }

  // Inicializa el módulo
  function init() {
    $seccionLinks.on('click', onSeccionClick);

    // Cargar módulos "Todos" al inicio
    fetchModulos('all').done(renderModulos);
  }

  // Exponer métodos públicos si es necesario (aquí no hay)
  return {
    init
  };
})();

$(document).ready(() => {
  ModulosApp.init();
});
