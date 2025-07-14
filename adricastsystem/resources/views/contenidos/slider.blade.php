<div class="slider-container">
    <img class="slider-image active" src="{{ route('recursos.show', ['img', 'portadaweb2.gif']) }}" alt="Imagen 1">
    <img class="slider-image" src="{{ route('recursos.show', ['img', 'portadaweb3.gif']) }}" alt="Imagen 2">
    <img class="slider-image" src="{{ route('recursos.show', ['img', 'portadaweb4.gif']) }}" alt="Imagen 3">
    <img class="slider-image" src="{{ route('recursos.show', ['img', 'portadaweb5.gif']) }}" alt="Imagen 4">
    <img class="slider-image" src="{{ route('recursos.show', ['img', 'portadaweb.gif']) }}" alt="Imagen 4">
    <div class="slider-overlay"></div>
</div>
<script>
    var slideIndex = 0;
     funcionslider();
</script>