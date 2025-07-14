function togglePassword() {
  const input = document.getElementById("contrasena");
  const icon = document.querySelector(".toggle-password");
  
  if (input.type === "password") {
    input.type = "text";
    icon.textContent = "🙈"; // Cambia el ícono cuando está visible
  } else {
    input.type = "password";
    icon.textContent = "👁️"; // Cambia el ícono cuando está oculto
  }
}

function quitarImg() {
  var preview = document.getElementById('imagen-preview');
  var quitarImagenBtn = document.getElementById('quitarImagen');
  var moduloImagen = document.getElementById('file-input');

  preview.src = '';
  preview.style.display = 'none';
  quitarImagenBtn.style.display = 'none';
  moduloImagen.value = ''; // Restablecer el input de tipo file
}

function funciontarjeta() {
  const cards = document.querySelector(".cards");
  const prevButton = document.querySelector(".prev-button");
  const nextButton = document.querySelector(".next-button");
  
  const cardWidth = 320; // Ancho de cada tarjeta
  const cardMargin = 20; // Margen derecho de cada tarjeta
  
  prevButton.addEventListener("click", () => {
      cards.scrollTo({
          top: 0,
          left: (scrollAmount -= cardWidth + cardMargin),
          behavior: "smooth"
      });
      console.log("hizo click en el boton prev");
      checkScrollButtons(prevButton, nextButton,cards); // Pasar prevButton y nextButton a checkScrollButtons
  });
  
  nextButton.addEventListener("click", () => {
      cards.scrollTo({
          top: 0,
          left: (scrollAmount += cardWidth + cardMargin),
          behavior: "smooth"
      });
      console.log("hizo click en el boton next");
      checkScrollButtons(prevButton, nextButton,cards); // Pasar prevButton y nextButton a checkScrollButtons
  });
}

function funciontarjeta2(){


   
        var modulosContainer = document.getElementById("modulos");
        var prevButton = document.getElementById("prevButton");
        var nextButton = document.getElementById("nextButton");

        var scrollAmount = 40; // Puedes ajustar la cantidad de desplazamiento

        prevButton.addEventListener("click", function () {
            modulosContainer.scrollLeft -= scrollAmount;
        });

        nextButton.addEventListener("click", function () {
            modulosContainer.scrollLeft += scrollAmount;
        });

  }
  function toggleMenuMobile() {
    var menuMobile = document.querySelector('.menu-mobile');
    if (menuMobile.style.display === 'none' || menuMobile.style.display === '') {
        menuMobile.style.display = 'flex';
    } else {
        menuMobile.style.display = 'none';
    }
}
function hideMenuOnLargeScreen() {
    var menuMobile = document.querySelector('.menu-mobile');
    var screenWidth = window.innerWidth;
    if (screenWidth > 768) { // Cambia 768 por el ancho deseado para considerar como "pantalla grande"
        menuMobile.style.display = 'none';
    }
}

  function cargarImagen() {
    var input = document.getElementById('file-input');
    var preview = document.getElementById('imagen-preview');
    var quitarImagenBtn = document.getElementById('quitarImagen');
    preview.style.height = '150px'; // Establece el alto de la imagen
    preview.style.width = '150px';  // Establece el ancho de la imagen
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            quitarImagenBtn.style.display = 'block'; // Mostrar el botón Quitar Imagen
       
        };

        reader.readAsDataURL(input.files[0]);
    }
}


    
function checkScrollButtons(prevButton, nextButton,cards) {
    // Desactiva el botón de "anterior" si llegamos al inicio de las tarjetas
    if (scrollAmount === 0) {
      prevButton.disabled = true;
      console.log("estamos probando los botones1");
    } else {
      prevButton.disabled = false;
    }
  
    // Desactiva el botón de "siguiente" si llegamos al final de las tarjetas
    if (scrollAmount + cards.clientWidth >= cards.scrollWidth) {
      nextButton.disabled = true;
    } else {
      nextButton.disabled = false;
    }
    console.log("estamos probando los botones");
  }
  function showCard(n) {
      // Oculta todas las tarjetas
      for (let i = 0; i < cards.length; i++) {
        cards[i].style.display = "none";
      }
    
      // Muestra la tarjeta especificada
      cards[n].style.display = "flex";
      currentCard = n;
    
      // Habilita o deshabilita los botones prev y next según la posición de la tarjeta actual
      if (currentCard === 0) {
        prevButton.disabled = true;
      } else {
        prevButton.disabled = false;
      }
    
      if (currentCard === cards.length - 1) {
        nextButton.disabled = true;
      } else {
        nextButton.disabled = false;
      }
    } 

function funcionslider(){
    var slides = document.getElementsByClassName("slider-image");
    for (var i = 0; i < slides.length; i++) {
      slides[i].classList.remove("active");
    }
    slideIndex++;
    if (slideIndex > slides.length) { slideIndex = 1 }
    slides[slideIndex - 1].classList.add("active");
    setTimeout(funcionslider, 3000); // Cambia la imagen cada 3 segundos
}
function aparecerpestañas(){
  var pestañas = document.querySelector(".tab-content-container");
 
  var pregunta1= document.getElementById("pregunta1");
  var respuesta1= document.getElementById("respuesta1");
 
  var pregunta2= document.getElementById("pregunta2");
  var respuesta2= document.getElementById("respuesta2");
 
  var pregunta3= document.getElementById("pregunta3");
  var respuesta3= document.getElementById("respuesta3");

  var pregunta4= document.getElementById("pregunta4");
  var respuesta4= document.getElementById("respuesta4");
  
  var pregunta5= document.getElementById("pregunta5");
  var respuesta5= document.getElementById("respuesta5");
 
 

  pregunta1.addEventListener("change",validacheck1,false);
  pregunta2.addEventListener("change",validacheck2,false);
  pregunta3.addEventListener("change",validacheck3,false);
  pregunta4.addEventListener("change",validacheck4,false);
  pregunta5.addEventListener("change",validacheck5,false);

 




  function validacheck1(){
      var checked=pregunta1.checked;
      if(checked){
        
          respuesta1.style.display="block";
          respuesta1.style.animation="crecer 2s";
          
          respuesta2.style.display="none";
          respuesta3.style.display="none";
          respuesta4.style.display="none";
          respuesta5.style.display="none";
          pregunta2.checked=false;
          pregunta3.checked=false;
          pregunta4.checked=false;
          pregunta5.checked=false;
      }else{
          respuesta1.style.display="none";

      }
  }
  function validacheck2(){
    var checked=pregunta2.checked;
    if(checked){
      
        respuesta2.style.display="block";
        respuesta2.style.animation="crecer 2s";
        respuesta1.style.display="none";
        respuesta3.style.display="none";
        respuesta4.style.display="none";
        respuesta5.style.display="none";
        pregunta1.checked=false;
        pregunta3.checked=false;
        pregunta4.checked=false;
        pregunta5.checked=false;
    }else{
        respuesta2.style.display="none";
    }
}

function validacheck3(){
    var checked=pregunta3.checked;
    if(checked){
      
        respuesta3.style.display="block";
        respuesta3.style.animation="crecer 2s";
        respuesta1.style.display="none";
        respuesta2.style.display="none";
       
        respuesta4.style.display="none";
        respuesta5.style.display="none";
        pregunta1.checked=false;
        pregunta2.checked=false;
        pregunta4.checked=false;
        pregunta5.checked=false;
    }else{
        respuesta3.style.display="none";
    }
}
function validacheck4(){
    var checked=pregunta4.checked;
    if(checked){
      
        respuesta4.style.display="block";
        respuesta4.style.animation="crecer 2s";
        respuesta1.style.display="none";
        respuesta2.style.display="none";
        respuesta3.style.display="none";
       
        respuesta5.style.display="none";
        pregunta1.checked=false;
        pregunta3.checked=false;
        pregunta2.checked=false;
        pregunta5.checked=false;
    }else{
        respuesta4.style.display="none";
    }
}
function validacheck5(){
    var checked=pregunta5.checked;
    if(checked){
      
        respuesta5.style.display="block";
        respuesta5.style.animation="crecer 2s";
        respuesta1.style.display="none";
        respuesta2.style.display="none";
        respuesta3.style.display="none";
        respuesta4.style.display="none";
        pregunta1.checked=false;
        pregunta3.checked=false;
        pregunta4.checked=false;
        pregunta2.checked=false;
       
    }else{
        respuesta5.style.display="none";
    }
}



}
function aparecerpestañas(){
  var pestañas = document.querySelector(".pestañas");
 
  var pregunta1= document.getElementById("pregunta1");
  var respuesta1= document.getElementById("respuesta1");
 
  var pregunta2= document.getElementById("pregunta2");
  var respuesta2= document.getElementById("respuesta2");
 
  var pregunta3= document.getElementById("pregunta3");
  var respuesta3= document.getElementById("respuesta3");

  var pregunta4= document.getElementById("pregunta4");
  var respuesta4= document.getElementById("respuesta4");
  
  var pregunta5= document.getElementById("pregunta5");
  var respuesta5= document.getElementById("respuesta5");
 
 

  pregunta1.addEventListener("change",validacheck1,false);
  pregunta2.addEventListener("change",validacheck2,false);
  pregunta3.addEventListener("change",validacheck3,false);
  pregunta4.addEventListener("change",validacheck4,false);
  pregunta5.addEventListener("change",validacheck5,false);

 




  function validacheck1(){
      var checked=pregunta1.checked;
      if(checked){
        
          respuesta1.style.display="block";
          respuesta1.style.animation="crecer 2s";
          
          respuesta2.style.display="none";
          respuesta3.style.display="none";
          respuesta4.style.display="none";
          respuesta5.style.display="none";
          pregunta2.checked=false;
          pregunta3.checked=false;
          pregunta4.checked=false;
          pregunta5.checked=false;
      }else{
          respuesta1.style.display="none";

      }
  }
  function validacheck2(){
    var checked=pregunta2.checked;
    if(checked){
      
        respuesta2.style.display="block";
        respuesta2.style.animation="crecer 2s";
        respuesta1.style.display="none";
        respuesta3.style.display="none";
        respuesta4.style.display="none";
        respuesta5.style.display="none";
        pregunta1.checked=false;
        pregunta3.checked=false;
        pregunta4.checked=false;
        pregunta5.checked=false;
    }else{
        respuesta2.style.display="none";
    }
}

function validacheck3(){
    var checked=pregunta3.checked;
    if(checked){
      
        respuesta3.style.display="block";
        respuesta3.style.animation="crecer 2s";
        respuesta1.style.display="none";
        respuesta2.style.display="none";
       
        respuesta4.style.display="none";
        respuesta5.style.display="none";
        pregunta1.checked=false;
        pregunta2.checked=false;
        pregunta4.checked=false;
        pregunta5.checked=false;
    }else{
        respuesta3.style.display="none";
    }
}
function validacheck4(){
    var checked=pregunta4.checked;
    if(checked){
      
        respuesta4.style.display="block";
        respuesta4.style.animation="crecer 2s";
        respuesta1.style.display="none";
        respuesta2.style.display="none";
        respuesta3.style.display="none";
       
        respuesta5.style.display="none";
        pregunta1.checked=false;
        pregunta3.checked=false;
        pregunta2.checked=false;
        pregunta5.checked=false;
    }else{
        respuesta4.style.display="none";
    }
}
function validacheck5(){
    var checked=pregunta5.checked;
    if(checked){
      
        respuesta5.style.display="block";
        respuesta5.style.animation="crecer 2s";
        respuesta1.style.display="none";
        respuesta2.style.display="none";
        respuesta3.style.display="none";
        respuesta4.style.display="none";
        pregunta1.checked=false;
        pregunta3.checked=false;
        pregunta4.checked=false;
        pregunta2.checked=false;
       
    }else{
        respuesta5.style.display="none";
    }
}



}
function tecnologia(){
 

  let textophp = document.getElementById("textophp");
  let textojava = document.getElementById("textojava");
  let textojavascript = document.getElementById("textojavascript");
  let textophyton = document.getElementById("textophyton");
  let textocsharp = document.getElementById("textocsharp");
  let textocplus = document.getElementById("textocplus");
  textojava.style.display="none";
  textojavascript.style.display="none";
  textophyton.style.display="none";
  textocsharp.style.display="none";
  textocplus.style.display="none";
  let php= document.getElementById("php");
  let java= document.getElementById("java");
  let javascript= document.getElementById("javascript");
  let phyton= document.getElementById("phyton");
  let csharp= document.getElementById("csharp");
  let cplus= document.getElementById("cplus");
  php.addEventListener("click",phpvisible);
  java.addEventListener("click",javavisible);   
  javascript.addEventListener("click",javascriptvisible);   
  phyton.addEventListener("click",phytonvisible); 
  csharp.addEventListener("click",csharpvisible); 
  cplus.addEventListener("click",cplusvisible); 
  
}
function tecnologiasSC(){
  php.style.backgroundColor="transparent";
  csharp.style.backgroundColor="transparent"; 
  java.style.backgroundColor="transparent";
  javascript.style.backgroundColor="transparent";
  cplus.style.backgroundColor="transparent";
  phyton.style.backgroundColor="transparent";
 }
 function cplusvisible(){
   textocplus.style.display="block";
   
   textophp.style.display="none";
   textojavascript.style.display="none";
   textophyton.style.display="none";
   textocsharp.style.display="none";
   textojava.style.display="none";
   tecnologiasSC();
   cplus.style.backgroundColor="rgb(113, 201, 252)";
 
 }
 function phpvisible(){
   textocplus.style.display="none";
   textophp.style.display="block";
   textojavascript.style.display="none";
   textophyton.style.display="none";
   textocsharp.style.display="none";
   textojava.style.display="none";
   tecnologiasSC();
   php.style.backgroundColor="rgb(113, 201, 252)";
   
 }
 function javavisible(){
 
   textophp.style.display="none";
   textojavascript.style.display="none";
   textophyton.style.display="none";
   textocsharp.style.display="none";
   textojava.style.display="block";
   textocplus.style.display="none";
   tecnologiasSC();
   java.style.backgroundColor="rgb(113, 201, 252)";
 }
 function javascriptvisible(){
 
   textophp.style.display="none";
   textojavascript.style.display="block";
   textophyton.style.display="none";
   textocsharp.style.display="none";
   textojava.style.display="none";
   textocplus.style.display="none";
   tecnologiasSC();
   javascript.style.backgroundColor="rgb(113, 201, 252)";
 }
 function phytonvisible(){
 
   textophp.style.display="none";
   textojavascript.style.display="none";
   textophyton.style.display="block";
   textocsharp.style.display="none";
   textojava.style.display="none";
   textocplus.style.display="none";
   tecnologiasSC();
   phyton.style.backgroundColor="rgb(113, 201, 252)";
 }
 function csharpvisible(){
 
   textophp.style.display="none";
   textojavascript.style.display="none";
   textophyton.style.display="none";
   textocsharp.style.display="block";
   textojava.style.display="none";
   textocplus.style.display="none";
   tecnologiasSC();
   csharp.style.backgroundColor="rgb(113, 201, 252)";
 }

/*function manejarScroll() {
  var menu = document.getElementById("menu");
  var scrollPosition = window.scrollY;

  if (scrollPosition > 200) {
      menu.classList.add("fixed");
  } else {
      menu.classList.remove("fixed");
  }
}*/
var validacionesFormulario = {
  validaformularioregistro: function() {
    var formulario = document.getElementById('formularioRegistro');

    var usuario = formulario.elements['usuario'].value;
    var nombres = formulario.elements['nombres'].value;
    var apellidos = formulario.elements['apellidos'].value;
    var email = formulario.elements['email'].value;
    var password = formulario.elements['password'].value;
    var confirmPassword = formulario.elements['password_confirmation'].value;
    var direccion = formulario.elements['direccion'].value;
    var telefono = formulario.elements['telefono'].value;
  
    // Añade aquí el resto de los campos del formulario...
  
    if (usuario.trim() === '' || nombres.trim() === '' || apellidos.trim() === '' || email.trim() === '' || password.trim() === '' || direccion.trim() === '' || telefono.trim() === '') {
        alert('Por favor, rellene todos los campos.');
        return false;
    }
  
    if (usuario.length < 4 || usuario.length > 20) {
        alert('El nombre de usuario debe tener entre 4 y 20 caracteres.');
        return false;
    }
    if (nombres.length < 4 || nombres.length > 20) {
        alert('El nombre debe tener entre 4 y 20 caracteres.');
        return false;
    }
    if (apellidos.length < 4 || apellidos.length > 20) {
        alert('El apellido debe tener entre 4 y 20 caracteres.');
        return false;
    }
    if (email.length < 4 || email.length > 50) {
        alert('El email debe tener entre 4 y 50 caracteres.');
        return false;
    }
    var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

    if (!emailRegex.test(email)) {
        alert('Por favor, ingrese un correo electrónico válido.');
        return false;
    }
    if (password.length < 4 || password.length > 20) {
        alert('La contraseña debe tener entre 4 y 20 caracteres.');
        return false;
    }
    if (password !== confirmPassword) {
      alert('La contraseña y la confirmación de la contraseña no coinciden.');
      return false;
    }
  
    // Aquí puedes añadir más reglas de validación para los otros campos...
  
    return true;
  },
  // Otras funciones de validación aquí...
};

