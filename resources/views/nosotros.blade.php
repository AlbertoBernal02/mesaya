
@extends('layouts.app')

@section('title', 'Sobre Nosotros')

@section('content')    
 <!-- Imagen y Texto sobre nuestra empresa -->
<div class="d-flex flex-column min-vh-100">
    <!-- Gif alargado que ocupa todo el ancho con altura reducida -->
    <div class="w-100">
        <img src="../../img/anuncio.gif" alt="GIF de ejemplo" style="width: 100%; height: 35vh;">
    </div>

    <!-- Texto sobre la empresa centrado -->
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 40vh; margin-top: 5vh;">
        <div class="text-center">
            <h1>Somos una plataforma que conecta a los amantes de la gastronomía con los mejores restaurantes locales. Nuestra misión es facilitar reservas y mejorar la experiencia de comer fuera de casa, brindando un servicio cómodo, rápido y eficiente para todos.</h1>
        </div>
    </div>

    <!-- Título adicional "Disfruta de nuestras ventajas" -->
    <div class="container text-center mb-4" style= "min-height: 20vh";>
        <h2>Disfruta de nuestras ventajas</h2>
    </div>

 <!-- Tres Cards con diseño mejorado usando Bootstrap -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <!-- Card 1 -->
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-lg hover-card">
                <div class="card-inner">
                    <div class="card-front">
                        <img src="{{ asset('../../img/reloj.png') }}" class="card-img-top" alt="Card 1">
                        <div class="card-body text-center">
                            <h5 class="card-title">¿Tienes prisa?</h5>
                        </div>
                    </div>
                    <div class="card-back d-flex justify-content-center align-items-center text-center">
                        <div class="card-body">
                            <p class="card-text">Ahorrate el ir al restaurante y que no haya mesa y tengas que comer tarde. ¡Mesaya tiene la solución al problema!.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-lg hover-card">
                <div class="card-inner">
                    <div class="card-front">
                        <img src="{{ asset('../../img/vip.png') }}" class="card-img-top" alt="Card 2">
                        <div class="card-body text-center">
                            <h5 class="card-title">Fidelidad</h5>
                        </div>
                    </div>
                    <div class="card-back d-flex justify-content-center align-items-center text-center">
                        <div class="card-body">
                            <p class="card-text">Tendrás más opciones de eventos organizados por nosotros y descuentos en nuestros restaurantes.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-lg hover-card">
                <div class="card-inner">
                    <div class="card-front">
                        <img src="{{ asset('../../img/ahorro.png') }}" class="card-img-top" alt="Card 3">
                        <div class="card-body text-center">
                            <h5 class="card-title">Ofertas Exclusivas</h5>
                        </div>
                    </div>
                    <div class="card-back d-flex justify-content-center align-items-center text-center">
                        <div class="card-body">
                            <p class="card-text">Accede a promociones y descuentos exclusivos solo para usuarios de MesaYa.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
    