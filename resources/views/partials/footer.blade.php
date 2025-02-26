<footer class="footer-main">
    <div class="container">
        <div class="row">
            <!-- Información de la Empresa -->
            <div class="col-lg-4 col-md-12 footer-info">
                <h4>{{ __('mesa_ya') }}</h4>
                <p>{{ __('descubre_experiencias') }}</p>
            </div>


            <!-- Contacto -->
            <div class="col-lg-4 col-md-6 footer-contact">
                <h4>{{ __('contacto') }}</h4>
                <ul class="contact-list">
                    <li><i class="fa-solid fa-location-dot"></i> {{ __('direccion') }}</li>
                    <li><i class="fa-solid fa-phone"></i> {{ __('telefono') }}</li>
                    <li><i class="fa-solid fa-envelope"></i> {{ __('email_contacto') }}</li>
                </ul>
            </div>


            <!-- Redes Sociales y Mapa del Sitio -->
            <div class="col-lg-4 col-md-6 footer-social">
                <h4>{{ __('siguenos') }}</h4>
                <div class="social-links">
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                </div>


                <!-- Mapa del Sitio -->
                <p class="sitemap-title" data-bs-toggle="collapse" data-bs-target="#sitemapCollapse">
                    {{ __('mapa_sitio') }}
                </p>
                <div class="collapse" id="sitemapCollapse">
                    <ul class="sitemap-list">
                        <li><a href="{{ url('/') }}">{{ __('inicio') }}</a></li>
                        <li><a href="{{ route('nosotros') }}">{{ __('sobre_nosotros') }}</a></li>
                        <li><a href="{{ route('contacto') }}">{{ __('contacto') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="footer-divider"></div>
        <div class="footer-bottom">
            <small>© 2025 MesaYa. {{ __('todos_derechos') }}</small>
        </div>
    </div>
</footer>



