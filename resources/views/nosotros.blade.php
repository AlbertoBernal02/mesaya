@extends('layouts.app')

@section('title', __('sobre_nosotros'))

@section('content')    
 <!-- Sección Hero con Parallax -->
 <section class="hero d-flex flex-column align-items-center justify-content-center py-5" style="min-height: 100vh; position: relative; overflow: hidden;">
    <!-- Imagen de fondo con parallax -->
    <div class="parallax-background" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('../../img/paralax.png'); background-attachment: fixed; background-size: cover; background-position: center; z-index: -1;"></div>

    <!-- Capa con fondo gris claro para resaltar el texto -->
    <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(169, 169, 169, 0.5); z-index: 0;"></div>

    <div class="container text-center mb-5" style="position: relative; z-index: 1;">
        <h1 class="fw-bold display-3 text-white">{{ __('quienes_somos') }}</h1>
        <p class="lead fs-4 text-white">{{ __('descripcion_empresa') }}</p>
    </div>
    
    <!-- Mensaje de ventajas -->
    <div class="container text-center mb-4" style="position: relative; z-index: 1;">
        <h2 class="fw-bold display-5 text-white">{{ __('disfruta_ventajas') }}</h2>
    </div>
    
    <!-- Carrusel -->
    <div class="container d-flex justify-content-center mb-5" style="position: relative; z-index: 1;">
        <div id="carouselExample" class="carousel slide carousel-fade w-100" data-bs-ride="carousel" style="max-width: 700px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); overflow: hidden;">
            <div class="carousel-inner">
                <div class="carousel-item active text-center">
                    <h3 class="text-white">{{ __('carrusel11') }}</h3>
                    <img src="../../img/carrousel1.svg" class="d-block w-100" alt="Catering 1" style="object-fit: contain; height: 500px; width: 100%; margin: auto;">
                    <p class="text-white">{{ __('carrusel12') }}</p>
                </div>
                <div class="carousel-item text-center">
                    <h3 class="text-white">{{ __('carrusel21') }}</h3>
                    <img src="../../img/carrousel2.svg" class="d-block w-100" alt="Catering 2" style="object-fit: contain; height: 500px; width: 100%; margin: auto;">
                    <p class="text-white">{{ __('carrusel22') }}</p>
                </div>
                <div class="carousel-item text-center">
                    <h3 class="text-white">{{ __('carrusel31') }}</h3>
                    <img src="../../img/carrousel3.svg" class="d-block w-100" alt="Catering 3" style="object-fit: contain; height: 500px; width: 100%; margin: auto;">
                    <p class="text-white">{{ __('carrusel32') }}</p>
                </div>
            </div>
            <!-- Controles del carrusel -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev" aria-label="Anterior">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next" aria-label="Siguiente">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>
    </div>
</section>

@endsection