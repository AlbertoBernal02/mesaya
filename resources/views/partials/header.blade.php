<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" style="height: 40px; margin-right: 10px;">
            MesaYa
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('nosotros') }}">{{ __('sobre_nosotros') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contacto') }}">{{ __('contacto') }}</a></li>

                @guest
                    <li class="nav-item">
                        <a class="btn btn-primary me-2" href="{{ route('login') }}">{{ __('iniciar_sesion') }}</a>
                        <a class="btn btn-secondary" href="{{ route('register') }}">{{ __('registrarse') }}</a>
                    </li>
                @else
                    @if (Auth::user()->role == 'user')
                        <li class="nav-item">
                            <a class="btn btn-warning me-2 position-relative" href="{{ route('carrito.index') }}">
                                📆 {{ __('confirmar_reservas') }}
                                @if($reservasPendientes > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $reservasPendientes }}
                                    </span>
                                @endif
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="btn btn-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('cerrar_sesion') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest

                <!-- Botón para cambiar el idioma sin usar sesión -->
                <li class="nav-item">
    <a href="{{ url()->current() }}?lang={{ app()->getLocale() == 'es' ? 'en' : 'es' }}" class="btn btn-outline-secondary">
        {{ app()->getLocale() == 'es' ? '🇬🇧 English' : '🇪🇸 Español' }}
    </a>
</li>

            </ul>
        </div>
    </div>
</nav>
