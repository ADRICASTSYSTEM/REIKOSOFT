<main class="main">
        <div class="slider-container">
            <img class="slider-image active" src="{{ route('recursos.show', ['img', 'portadaweb2.gif']) }}" alt="Imagen 1">
            <img class="slider-image" src="{{ route('recursos.show', ['img', 'portadaweb3.gif']) }}" alt="Imagen 2">
            <img class="slider-image" src="{{ route('recursos.show', ['img', 'portadaweb4.gif']) }}" alt="Imagen 3">
            <img class="slider-image" src="{{ route('recursos.show', ['img', 'portadaweb5.gif']) }}" alt="Imagen 4">
            <img class="slider-image" src="{{ route('recursos.show', ['img', 'portadaweb.gif']) }}" alt="Imagen 4">
            <div class="slider-overlay"></div>
        </div>
   
        <div class="contenido">
            <div class="imagen">
                <img src="{{ route('recursos.show', ['img', 'user.png']) }}" alt="">
            </div>
            <div class="titulo">
                <h1>CREAR USUARIO</h1>
            </div>
            <div class="seccion">
                
                <h2><i class="fa fa-key" aria-hidden="true"></i></h2>
                <form action="{{ route('enviarFormulario') }}" method="post">
                    @csrf
                    <label for="usuario">Usuario:</label>
                    <input type="user" id="usuario" name="usuario" value="" required>


                    <label for="password">Email:</label>
                    <input type="password" id="password" name="password" value="" required>


                    <input type="submit" value="Ingresar">
                </form>
                
            </div>
            
        </div>

        <script> 
           
           var slideIndex = 0;
          
           funcionslider();
         
       </script>
</main>