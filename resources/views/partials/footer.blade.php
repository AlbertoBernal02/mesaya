<footer class="footer-main">
    <div class="container">
        <div class="row">
            <!-- Información de la Empresa -->
            <div class="col-lg-4 col-md-12 footer-info">
                <h4>MESA YA</h4>
                <p>Descubre experiencias únicas con los restaurantes gracias a Mesa YA</p>
            </div>

            <!-- Contacto -->
            <div class="col-lg-4 col-md-6 footer-contact">
                <h4>Contacto</h4>
                <ul class="contact-list">
                    <li><i class="fa-solid fa-location-dot"></i> Av. Principal 123, Ciudad</li>
                    <li><i class="fa-solid fa-phone"></i> +123 456 789</li>
                    <li><i class="fa-solid fa-envelope"></i> adminmesaya@yopmail.com</li>
                </ul>
            </div>

            <!-- Redes Sociales y Mapa del Sitio -->
            <div class="col-lg-4 col-md-6 footer-social">
                <h4>Síguenos</h4>
                <div class="social-links">
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                </div>

                <!-- Mapa del Sitio -->
                <p class="sitemap-title" data-bs-toggle="collapse" data-bs-target="#sitemapCollapse">
                    Mapa del Sitio
                </p>
                <div class="collapse" id="sitemapCollapse">
                    <ul class="sitemap-list">
                        <li><a href="{{ url('/') }}">Inicio</a></li>
                        <li><a href="{{ route('nosotros') }}">Sobre Nosotros</a></li>
                        <li><a href="{{ route('contacto') }}">Contacto</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-divider"></div>
        <div class="footer-bottom">
            <small>© 2025 MesaYa. Todos los derechos reservados.</small>
        </div>
    </div>
</footer>
