<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ auth()->check() ? (auth()->user()->role === 'restaurant' ? route('schedules.index1') : route('home')) : route('home') }}">
            <img src="{{ asset('img/logo.png') }}" alt="__('logoalt')" class="hi">
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
                        <a class="btn btn-reservas btn-custom position-relative" href="{{ route('carrito.index') }}">
                                <i class="fas fa-calendar-check"></i> {{ __('confirmar_reservas') }}
                                @if($reservasPendientes > 0)
                                    <span class="badge badge-danger position-absolute top-0 start-100 translate-middle">
                                        {{ $reservasPendientes }}
                                    </span>
                                @endif
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                    <a class="btn btn-logout btn-custom" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> {{ __('cerrar_sesion') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hf">
                            @csrf
                        </form>
                    </li>
                @endguest

                <!-- Botón para cambiar el idioma sin usar sesión -->
                <li class="nav-item">
                    <a href="{{ url()->current() }}?lang={{ app()->getLocale() == 'es' ? 'en' : 'es' }}" class="btn btn-language">
                        {{ app()->getLocale() == 'es' ? '🇬🇧 English' : '🇪🇸 Español' }}
                    </a>
                </li>



            </ul>
        </div>
    </div>
</nav>