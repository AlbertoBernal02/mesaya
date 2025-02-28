@extends('layouts.app')


@section('title', __('sobre_nosotros'))


@section('content')    
 <!-- Sección Hero con Parallax -->
 <section class="hero">
        <div class="text-center text-white hero-content">
            <h1>Texto</h1>
            <p>Descripcion</p>
        </div>

        <!-- Sección de Carrusel dentro del Parallax -->
        <div id="carousel-section" class="mt-5">
            <div class="container">
                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <!-- Imágenes del carrusel -->
                        <div class="carousel-item active">
                            <img src="img/1.jpg" class="d-block w-100 rounded" alt="Catering 1">
                        </div>
                        <div class="carousel-item">
                            <img src="img/2.png" class="d-block w-100 rounded" alt="Catering 2">
                        </div>
                        <div class="carousel-item">
                            <img src="img/3.png" class="d-block w-100 rounded" alt="Catering 3">
                        </div>
                    </div>
                    <!-- Controles del carrusel -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            </div>
        </div>
    </section>
@endsection



