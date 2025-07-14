let usuarioActivo = null;
let ultimoMensajeId = null;
let intervaloMensajes = null;
let sonido; // Variable global para el audio
let conversacionActiva = null;






function activarChat(userId, username) {
    usuarioActivo = userId;
    ultimoMensajeId = null;

    $('#headerchat').data('userid', userId);
    $('#chat-username').text(username);

    // ✅ Mostrar botón de volver solo en pantallas pequeñas
    if (window.innerWidth <= 768) {
        $('.contenedorchat').addClass('chat-activo');
        $('#btnVolverChats').show();
    }

    // Cargar mensajes al instante
    cargarMensajes(userId);

    // Limpiar cualquier intervalo anterior
    if (intervaloMensajes) clearInterval(intervaloMensajes);

    // Activar actualización automática cada 3 segundos
    intervaloMensajes = setInterval(() => {
        if (usuarioActivo) {
            cargarMensajes(usuarioActivo);
        }
    }, 3000);
}
function mostrarUsersChat() {
    $('.contenedorchat').removeClass('chat-activo');
    $('#btnVolverChats').hide();
}

function cerrarModal(){
    editmodal= document.getElementById('editmodal');
    editmodal.style.display = 'none';
} 
function principal(){
    window.location.href = '/chat';
}
function addChat() {
    editmodal= document.getElementById('editmodal');
    username = document.getElementById('username');
    username.value = '';
    mensaje = document.getElementById('mensaje');
    mensaje.value = '';
    editmodal.style.display = 'block';
}
function guardarDatos() {
    var token = $('meta[name="csrf-token"]').attr('content');

    // Obtener los datos del formulario modal
    var formData = new FormData($('#miFormulario')[0]);

    console.log(formData);

    // Enviar la solicitud AJAX
    $.ajax({
        url: StoreUrl,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': token
        },
        success: function(response) {
            // Manejar la respuesta exitosa aquí
            console.log(response);
            if (response.success) {
                // Si la respuesta indica éxito, mostrar un mensaje exitoso
                Swal.fire('Éxito', response.message, 'success');
            } else {
                // Si la respuesta indica un error, mostrar un mensaje de error
                Swal.fire('Error', response.message, 'error');
            }
            // Redireccionar a la página de chats
            window.location.href = '/chats';
        },
        error: function(xhr, status, error) {
            // Manejar errores aquí
            if (xhr.status === 422) {
                // El servidor respondió con un error de validación (422 Unprocessable Entity)
                var responseErrors = xhr.responseJSON.errors;
                var errorMessage = 'Los datos proporcionados no son válidos.';

                // Recorre los errores y construye el mensaje de error
                for (var key in responseErrors) {
                    if (responseErrors.hasOwnProperty(key)) {
                        errorMessage += '<br>' + responseErrors[key][0];
                    }
                }

                Swal.fire('Error', errorMessage, 'error');
            } else {
                // Otros errores de la solicitud AJAX
                console.error(error);
                Swal.fire('Error', 'Se produjo un error en el servidor.', 'error');
                console.error('Error en la solicitud AJAX:', xhr, status, error);
            }
        }
    });
}
function cargarMensajes(userId) {
    $.ajax({
        url: '/chats/show/' + userId,
        type: 'GET',
        success: function(response) {
            actualizarInterfaz(response, userId);
        },
        error: function(xhr, status, error) {
            console.error("Error al cargar mensajes:", error);
        }
    });
}
document.addEventListener('DOMContentLoaded', function () {
    const inputMensaje = document.getElementById('mensaje');

    inputMensaje.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault(); // Para evitar saltos de línea

            // Lógica al presionar Enter
            enviarMensaje();                     // 1. Enviar el mensaje
                   // 2. Refrescar vista de chats
                   // 3. Cambiar estado a 'leído'
        }
    });
});

function actualizarInterfaz(mensajes, userId) {
    var chatbox = $('#chatbox');
    chatbox.empty();
    marcarMensajesComoLeidos(userId)
    mensajes.forEach(function(mensaje) {
        var messageClass = (mensaje.tipo === 'enviado') ? 'sent' : 'received';
        
        var status = '';
        if (mensaje.tipo === 'enviado') {
            if (mensaje.status && mensaje.status.toLowerCase() === 'leido') {
                status = '<i class="fa fa-eye" title="Leído" style="color: green; margin-left: 5px;"></i>';
            } else {
                status = '<i class="fa fa-eye-slash" title="No leído" style="color: gray; margin-left: 5px;"></i>';
            }
        }

        var timestamp = mensaje.sent_at;

        // Opciones de menú según tipo de mensaje
        var opcionesHTML = '';
        if (mensaje.tipo === 'enviado') {
            opcionesHTML = `
                <div class="dropdown chat-message-options">
                    <button class="dropdown-toggle" onclick="toggleDropdown(event)">⋮</button>
                    <div class="dropdown-menu">
                        <button class="dropdown-item" onclick="eliminarMensaje(${mensaje.id}, ${userId})">Eliminar para todos</button>
                        <button class="dropdown-item" onclick="ocultarEnviado(${mensaje.id})">Eliminar solo para mí</button>
                    </div>
                </div>
            `;
        } else {
            opcionesHTML = `
                <div class="dropdown chat-message-options">
                    <button class="dropdown-toggle" onclick="toggleDropdown(event)">⋮</button>
                    <div class="dropdown-menu">
                        <button class="dropdown-item" onclick="ocultarRecibido(${mensaje.id})">Eliminar solo para mí</button>
                    </div>
                </div>
            `;
        }

        var messageHTML = `
            <div class="message ${messageClass}" data-mensaje-id="${mensaje.id}">
                <p>${mensaje.message} ${status}</p>
                <span class="timestamp" style="margin-left: 15px;">${timestamp}</span>
                ${opcionesHTML}
            </div>
        `;

        chatbox.append(messageHTML);
    });

    chatbox.scrollTop(chatbox[0].scrollHeight);
}


function marcarMensajesComoLeidos(userId) {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    fetch(`/chats/marcar-leidos/${userId}`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (!data.success) {
            console.error("Error al marcar como leídos:", data.message);
        }
    })
    .catch(error => {
        console.error("Fallo en la petición de marcar como leídos:", error);
    });
}

// Función para controlar el desplegable de opciones
function toggleDropdown(event) {
    event.stopPropagation();
    const button = event.currentTarget;
    const menu = button.nextElementSibling;
    const allMenus = document.querySelectorAll('.dropdown-menu');

    allMenus.forEach(m => {
        if (m !== menu) {
            m.style.display = 'none';
        }
    });

    if (menu.style.display === 'block') {
        menu.style.display = 'none';
        return;
    }

    menu.style.display = 'block';

    // Esperar un frame para calcular bien dimensiones
       setTimeout(() => {
        const rect = menu.getBoundingClientRect();
        if (rect.bottom > window.innerHeight) {
            menu.style.top = 'auto';
            menu.style.bottom = '25px'; // se despliega hacia arriba
        } else {
            menu.style.bottom = 'auto';
            menu.style.top = '25px';
        }
    }, 0);
}

document.addEventListener('click', () => {
    document.querySelectorAll('.dropdown-menu').forEach(menu => {
        menu.style.display = 'none';
    });
});

// Función para mostrar u ocultar el menú desplegable de opciones por usuario
function toggleUserMenu(userId) {
    const menu = document.getElementById(`user-menu-${userId}`);
    if (!menu) return;

    const isVisible = menu.style.display === 'block';

    // Cerrar todos los menús
    document.querySelectorAll('.dropdown-menu').forEach(m => m.style.display = 'none');

    // Abrir o cerrar el menú actual
    menu.style.display = isVisible ? 'none' : 'block';
}

// Ocultar menú si haces clic fuera
document.addEventListener('click', function(e) {
    if (!e.target.closest('.chat-options')) {
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.style.display = 'none';
        });
    }
});


// Manejar clic para activar chat solo si no clickeas en opciones
document.querySelectorAll('.userchat').forEach(userchat => {
    userchat.addEventListener('click', function(e) {
        if (!e.target.closest('.chat-options')) {
            const userId = this.id.split('_')[1];
            const username = document.getElementById(`username_${userId}`).textContent;
            activarChat(userId, username);
        }
    });
});
function eliminarMensaje(mensajeId, userId) {
    if (confirm('¿Estás seguro que deseas eliminar este mensaje?')) {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/chats/delete-message/${mensajeId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                Swal.fire('Éxito', data.message, 'success');
                cargarMensajes(userId); // Recargar los mensajes después de eliminar
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        })
        .catch(() => Swal.fire('Error', 'No se pudo eliminar el mensaje', 'error'));
    }
}
function ocultarEnviado(mensajeId, userId) {
    if (confirm('¿Deseas ocultar este mensaje solo para ti?')) {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/chats/ocultar-enviado/${mensajeId}`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                Swal.fire('Ocultado', data.message, 'success');
                cargarMensajes(userId);
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        })
        .catch(() => Swal.fire('Error', 'No se pudo ocultar el mensaje', 'error'));
    }
}
function ocultarRecibido(mensajeId, userId) {
    if (confirm('¿Deseas ocultar este mensaje recibido solo para ti?')) {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/chats/ocultar-recibido/${mensajeId}`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                Swal.fire('Ocultado', data.message, 'success');
                cargarMensajes(userId);
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        })
        .catch(() => Swal.fire('Error', 'No se pudo ocultar el mensaje', 'error'));
    }
}

// Función para eliminar conversación (debes implementar AJAX o llamada según tu backend)
function eliminarConversacion(userId) {
    if (confirm('¿Estás seguro que quieres eliminar toda la conversación?')) {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/chats/delete-conversation/${userId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
        })
        .then(res => {
            if (res.ok) {
                const chatDiv = document.getElementById(`userchat_${userId}`);
                if(chatDiv) chatDiv.remove();
                alert('Conversación eliminada');
            } else {
                alert('Error al eliminar la conversación');
            }
        })
        .catch(() => alert('Error en la conexión'));
    }
}
function ocultarConversacion(userId) {
    if (confirm('¿Estás seguro que quieres eliminar toda la conversación?')) {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/chats/ocultar-conversation/${userId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
        })
        .then(res => {
            if (res.ok) {
                const chatDiv = document.getElementById(`userchat_${userId}`);
                if(chatDiv) chatDiv.remove();
                alert('Conversación eliminada');
            } else {
                alert('Error al eliminar la conversación');
            }
        })
        .catch(() => alert('Error en la conexión'));
    }
}


function manejarErroresAjax(xhr, status, error) {
    if (xhr.status === 422) {
        var responseErrors = xhr.responseJSON.errors;
        var errorMessage = 'Los datos proporcionados no son válidos.';

        for (var key in responseErrors) {
            if (responseErrors.hasOwnProperty(key)) {
                errorMessage += '<br>' + responseErrors[key][0];
            }
        }

        Swal.fire('Error', errorMessage, 'error');
    } else {
        console.error('Error en la solicitud AJAX:', xhr, status, error);
        Swal.fire('Error', 'Se produjo un error en el servidor.', 'error');
    }
}
async function obtenerTotalMensajesNoLeidos(usuarioId) {
  $.ajax({
        url: '/chats/countnotread/' + userId,
        type: 'GET',
        success: function(response) {
           /*obtener el contador */
        },
        error: function(xhr, status, error) {
            console.error("Error al cargar mensajes:", error);
        }
    });
}

const ultimoConteo = {};
function prepararAudio() {
  if (!sonido) {
    sonido = new Audio(rutaSonido);
    sonido.play()
      .then(() => {
        sonido.pause();
        sonido.currentTime = 0;
      })
      .catch(() => {});
  }
}

async function actualizarContadores() {
  try {
    const res = await fetch('/chats/contadorconversation/aqui');
    if (!res.ok) throw new Error('Error en la respuesta HTTP');
    const response = await res.json();

    $('.userchat').each(function() {
      try {
        const userId = $(this).attr('id').split('_')[1];
        const count = response[userId] || 0;
        const prevCount = ultimoConteo[userId] || 0;
        let badge = $(this).find('.unread-badge');

        if (count > 0) {
          if (count > prevCount) {
            if (sonido) {
              sonido.play().catch(e => console.log('Error al reproducir sonido:', e));
            }
          }

          if (badge.length === 0) {
            $(this).find('.userchatimg').append('<span class="unread-badge">' + count + '</span>');
          } else {
            badge.text(count);
          }
        } else {
          badge.remove();
        }

        ultimoConteo[userId] = count;
      } catch (error) {
        console.error('Error procesando usuario en actualizarContadores:', error);
      }
    });
  } catch (err) {
    console.error('Error al obtener contadores', err);
  }
}

// Control de polling suave usando requestAnimationFrame y visibilidad de pestaña
function pollingSuave() {
  if (document.visibilityState === 'visible') {
    actualizarContadores();
  }
  setTimeout(() => requestAnimationFrame(pollingSuave), 5000);
}

$(document).ready(function() {
  $(document).one('click', () => {
    prepararAudio();
  });

  pollingSuave();
});

function enviarMensaje() {
    var token = $('meta[name="csrf-token"]').attr('content');
    var mensaje = $('#mensaje').val();
    var nombreUsuario = $('#headerchat').text();

    if (!mensaje.trim()) {
        Swal.fire('Error', 'No puedes enviar un mensaje vacío.', 'error');
        return;
    }

    if (nombreUsuario) {
        var data = {
            username: nombreUsuario,
            mensaje: mensaje
        };

        $.ajax({
            url: StoreUrl,
            type: "POST",
            data: data,
            headers: {
                'X-CSRF-TOKEN': token
            },
            success: function(response) {
                console.log("Respuesta del servidor:", response);

                // Asegurarse de que response.success sea booleano
                if (response.success === true) {
                    var userId = $('#headerchat').data('userid');
                    cargarMensajes(userId);
                    $('#mensaje').val('');
                } else {
                    const msg = response.message || 'Ocurrió un error al enviar el mensaje.';
                    Swal.fire('Error', msg, 'error');
                }
            },
            error: function(xhr, status, error) {
                if (xhr.status === 422) {
                    var responseErrors = xhr.responseJSON.errors;
                    var errorMessage = 'Los datos proporcionados no son válidos.';

                    for (var key in responseErrors) {
                        if (responseErrors.hasOwnProperty(key)) {
                            errorMessage += '<br>' + responseErrors[key][0];
                        }
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        html: errorMessage
                    });
                } else {
                    console.error('Error en la solicitud AJAX:', xhr, status, error);
                    Swal.fire('Error', 'Se produjo un error en el servidor.', 'error');
                }
            }
        });
    } else {
        Swal.fire('Error', 'Por favor, selecciona un usuario de destino.', 'error');
    }
}

