<footer class="footer-main">
    <div class="container">
        <div class="row">
            <!-- Información de la Empresa -->
            <div class="col-lg-4 col-md-12 footer-info">
                <h4>{{ __('mesa_ya') }}</h4> <!-- Título de la sección -->
                <p>{{ __('descubre_experiencias') }}</p> <!-- Descripción de la empresa -->
            </div>

            <!-- Contacto -->
            <div class="col-lg-4 col-md-6 footer-contact">
                <h4>{{ __('contacto') }}</h4> <!-- Título de la sección de contacto -->
                <ul class="contact-list">
                    <li><i class="fa-solid fa-location-dot"></i> {{ __('direccion') }}</li> <!-- Dirección -->
                    <li><i class="fa-solid fa-phone"></i> {{ __('telefono') }}</li> <!-- Teléfono -->
                    <li><i class="fa-solid fa-envelope"></i> {{ __('email_contacto') }}</li> <!-- Correo electrónico -->
                </ul>
            </div>

            <!-- Redes Sociales y Mapa del Sitio -->
            <div class="col-lg-4 col-md-6 footer-social">
                <h4>{{ __('siguenos') }}</h4> <!-- Título de la sección de redes sociales -->
                <div class="social-links">
                    <a href="https://www.facebook.com/profile.php?id=61573327006966"><i class="fa-brands fa-facebook"></i></a> <!-- Enlace a Facebook -->
                    <a href="https://www.instagram.com/mesayareservas/"><i class="fa-brands fa-instagram"></i></a> <!-- Enlace a Instagram -->
                    <a href="https://www.linkedin.com/in/mesa-ya-374001354/"><i class="fa-brands fa-linkedin"></i></a> <!-- Enlace a LinkedIn -->
                </div>

                <!-- Mapa del Sitio -->
                <p class="sitemap-title" data-bs-toggle="collapse" data-bs-target="#sitemapCollapse">
                    {{ __('mapa_sitio') }} <!-- Título del mapa del sitio -->
                </p>
                <div class="collapse" id="sitemapCollapse">
                    <ul class="sitemap-list">
                        <li><a href="{{ url('/') }}">{{ __('inicio') }}</a></li> <!-- Enlace a Inicio -->
                        <li><a href="{{ route('nosotros') }}">{{ __('sobre_nosotros') }}</a></li> <!-- Enlace a Sobre Nosotros -->
                        <li><a href="{{ route('contacto') }}">{{ __('contacto') }}</a></li> <!-- Enlace a Contacto -->
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-divider"></div> <!-- Línea divisoria -->
        <div class="footer-bottom">
            <small>© 2025 MesaYa. {{ __('todos_derechos') }}</small> <!-- Derechos reservados -->
        </div>
    </div>

    <!-- Botón "Volver Arriba" -->
    <a href="#" id="volver-arriba" class="boton-arriba">
        ↑ Volver Arriba <!-- Texto del botón -->
    </a>
</footer>