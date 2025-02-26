<!-- resources/views/partials/footer.blade.php -->
<footer class="footer-main">
    <div class="container">
      <div class="row">
        <!-- Información de la Empresa -->
        <div class="col-lg-4 col-md-12 footer-info">
          <h4>MESA YA</h4>
          <p>
            Descubre experiencias únicas con los restaurantes gracias a Mesa YA
          </p>
          <a href="#inicio" class="footer-link">Volver al Inicio</a>
        </div>

        <!-- Contacto -->
        <div class="col-lg-4 col-md-6 footer-contact">
          <h4>Contacto</h4>
          <ul class="contact-list">
            <li>
              <i class="fa-solid fa-location-dot"></i> Av. Principal 123, Ciudad
            </li>
            <li><i class="fa-solid fa-phone"></i> +123 456 789</li>
            <li><i class="fa-solid fa-envelope"></i> adminmesaya@yopmail.com</li>
          </ul>
        </div>

        <!-- Redes Sociales y Mapa del Sitio -->
        <div class="col-lg-4 col-md-6 footer-social">
          <h4>Síguenos</h4>
          <div class="social-links">
            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
          </div>
          <!-- Botón para desplegar el mapa del sitio, centrado debajo de las RRSS -->
          <button
            class="footer-link btn btn-link text-center"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#sitemapCollapse"
            aria-expanded="false"
            aria-controls="sitemapCollapse"
          >
            Mapa del Sitio
          </button>
          <!-- Mapa del sitio desplegable -->
          <div class="collapse" id="sitemapCollapse">
            <ul class="sitemap-list">
              <li><a href="index.html">Inicio</a></li>
              <li><a href="experiencias.html">Experiencias</a></li>
              <li><a href="contacto.html">Contacto</a></li>
              <li><a href="#">Iniciar Sesión</a></li>
              <li><a href="#">Registrarse</a></li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Línea Divisoria -->
      <div class="footer-divider"></div>

      <!-- Derechos de Autor -->
      <div class="footer-bottom">
        <small>© 2025 MesaYa. Todos los derechos reservados.</small>
      </div>
    </div>
    <!-- Bootstrap & Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  </footer>