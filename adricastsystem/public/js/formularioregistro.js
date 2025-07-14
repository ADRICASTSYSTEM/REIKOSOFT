
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('formularioRegistro').addEventListener('submit', function(e) {
        if (!validacionesFormulario.validaformularioregistro()) {
            e.preventDefault();
        }
    });
  });