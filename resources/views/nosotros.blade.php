@extends('layouts.app') <!-- Extiende la plantilla 'app' -->

@section('title', __('sobre_nosotros')) <!-- Establece el título de la página -->

@section('content')
<!-- Sección Hero con Parallax -->
<section class="hero d-flex flex-column align-items-center justify-content-center py-5 sh">
    <!-- Imagen de fondo con parallax -->
    <div class="parallax-background fp"></div>

    <!-- Capa con fondo gris claro para resaltar el texto -->
    <div class="overlay rt"></div>

    <div class="container text-center mb-5 c1">
        <h1 class="fw-bold display-3 text-white">{{ __('quienes_somos') }}</h1> <!-- Título de la sección -->
        <p class="lead fs-4 text-white">{{ __('descripcion_empresa') }}</p> <!-- Descripción de la empresa -->
    </div>

    <!-- Mensaje de ventajas -->
    <div class="container text-center mb-4 c1">
        <h2 class="fw-bold display-5 text-white">{{ __('disfruta_ventajas') }}</h2> <!-- Título de las ventajas -->
    </div>

    <!-- Carrusel -->
    <div class="container d-flex justify-content-center mb-5 c1">
        <div id="carouselExample" class="carousel slide carousel-fade w-100 c2" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active text-center">
                    <h3 class="text-white">{{ __('carrusel11') }}</h3> <!-- Título del primer ítem del carrusel -->
                    <img src="../../img/carrousel1.svg" class="d-block w-100 ci" alt="{{ __('carrusel1alt') }}"> <!-- Imagen del primer ítem del carrusel -->
                    <p class="text-white">{{ __('carrusel12') }}</p> <!-- Descripción del primer ítem del carrusel -->
                </div>
                <div class="carousel-item text-center">
                    <h3 class="text-white">{{ __('carrusel21') }}</h3> <!-- Título del segundo ítem del carrusel -->
                    <img src="../../img/carrousel2.svg" class="d-block w-100 ci" alt="{{ __('carrusel2alt') }}"> <!-- Imagen del segundo ítem del carrusel -->
                    <p class="text-white">{{ __('carrusel22') }}</p> <!-- Descripción del segundo ítem del carrusel -->
                </div>
                <div class="carousel-item text-center">
                    <h3 class="text-white">{{ __('carrusel31') }}</h3> <!-- Título del tercer ítem del carrusel -->
                    <img src="../../img/carrousel3.svg" class="d-block w-100 ci" alt="{{ __('carrusel3alt') }}"> <!-- Imagen del tercer ítem del carrusel -->
                    <p class="text-white">{{ __('carrusel32') }}</p> <!-- Descripción del tercer ítem del carrusel -->
                </div>
            </div>
            <!-- Controles del carrusel -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev" aria-label="Anterior">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span> <!-- Icono de control anterior -->
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next" aria-label="Siguiente">
                <span class="carousel-control-next-icon" aria-hidden="true"></span> <!-- Icono de control siguiente -->
            </button>
        </div>
    </div>
</section>

@endsection