@extends('layouts.app')


@section('title', __('sobre_nosotros'))


@section('content')    
 <!-- Imagen y Texto sobre nuestra empresa -->
<div class="d-flex flex-column min-vh-100">
    <!-- Gif alargado que ocupa todo el ancho con altura reducida -->
    <div class="w-100">
        <img src="../../img/anuncio.gif" alt="{{ __('gif_ejemplo') }}" style="width: 100%; height: 35vh;">
    </div>


    <!-- Texto sobre la empresa centrado -->
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 40vh; margin-top: 5vh;">
        <div class="text-center">
            <h1>{{ __('descripcion_empresa') }}</h1>
        </div>
    </div>


    <!-- Título adicional "Disfruta de nuestras ventajas" -->
    <div class="container text-center mb-4" style= "min-height: 20vh";>
        <h2>{{ __('disfruta_ventajas') }}</h2>
    </div>


 <!-- Tres Cards con diseño mejorado usando Bootstrap -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <!-- Card 1 -->
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-lg hover-card">
                <div class="card-inner">
                    <div class="card-front">
                        <img src="{{ asset('../../img/reloj.png') }}" class="card-img-top" alt="{{ __('card_1') }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ __('tienes_prisa') }}</h5>
                        </div>
                    </div>
                    <div class="card-back d-flex justify-content-center align-items-center text-center">
                        <div class="card-body">
                            <p class="card-text">{{ __('texto_card_1') }}</p>
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
                        <img src="{{ asset('../../img/vip.png') }}" class="card-img-top" alt="{{ __('card_2') }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ __('fidelidad') }}</h5>
                        </div>
                    </div>
                    <div class="card-back d-flex justify-content-center align-items-center text-center">
                        <div class="card-body">
                            <p class="card-text">{{ __('texto_card_2') }}</p>
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
                        <img src="{{ asset('../../img/ahorro.png') }}" class="card-img-top" alt="{{ __('card_3') }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ __('ofertas_exclusivas') }}</h5>
                        </div>
                    </div>
                    <div class="card-back d-flex justify-content-center align-items-center text-center">
                        <div class="card-body">
                            <p class="card-text">{{ __('texto_card_3') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



