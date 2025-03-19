<?php
require_once 'config.php';
$logged_in = isset($_SESSION['usuario_id']);
$nombre_usuario = $logged_in ? $_SESSION['nombre'] : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bodas.com.mx - Tu boda perfecta comienza aquí</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #ff6b6b;
            --secondary-color: #4ecdc4;
            --accent-color: #ffe66d;
            --text-color: #2d3436;
            --light-gray: #f7f7f7;
            --white: #ffffff;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }
        
        body {
            color: var(--text-color);
            background-color: var(--light-gray);
            line-height: 1.6;
        }
        
        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: var(--white);
            padding: 1rem 5%;
            box-shadow: var(--shadow);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .logo span {
            color: var(--secondary-color);
        }
        
        .nav-links {
            display: flex;
            list-style: none;
        }
        
        .nav-links li {
            margin-left: 2rem;
        }
        
        .nav-links a {
            text-decoration: none;
            color: var(--text-color);
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .nav-links a:hover {
            color: var(--primary-color);
        }
        
        .auth-buttons {
            display: flex;
            align-items: center;
        }
        
        .btn {
            padding: 0.5rem 1.5rem;
            border-radius: 4px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .btn-login {
            background-color: transparent;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            margin-right: 1rem;
        }
        
        .btn-signup {
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
        }
        
        .btn:hover {
            transform: translateY(-2px);
        }
        
        /* Hero Section */
        .hero {
            height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('images/hero-bg.jpg') no-repeat center center/cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: var(--white);
            padding: 0 5%;
            margin-top: 70px;
        }
        
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .hero p {
            font-size: 1.2rem;
            max-width: 600px;
            margin-bottom: 2rem;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 0.8rem 2rem;
            font-size: 1.1rem;
            border: none;
        }
        
        /* Features Section */
        .features {
            padding: 5rem 5%;
            text-align: center;
        }
        
        .section-title {
            font-size: 2rem;
            margin-bottom: 3rem;
            position: relative;
            display: inline-block;
        }
        
        .section-title::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--primary-color);
        }
        
        .feature-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .feature-card {
            background-color: var(--white);
            border-radius: 8px;
            padding: 2rem;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .feature-card h3 {
            margin-bottom: 1rem;
        }
        
        /* Providers Section */
        .providers {
            padding: 5rem 5%;
            background-color: var(--white);
        }
        
        .provider-filters {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        
        .filter-btn {
            background-color: var(--light-gray);
            border: none;
            padding: 0.5rem 1.5rem;
            margin: 0.5rem;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .filter-btn.active {
            background-color: var(--primary-color);
            color: var(--white);
        }
        
        .provider-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .provider-card {
            background-color: var(--light-gray);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }
        
        .provider-image {
            height: 200px;
            background-color: #ddd;
            background-image: url('images/provider-placeholder.jpg');
            background-size: cover;
            background-position: center;
        }
        
        .provider-info {
            padding: 1.5rem;
        }
        
        .provider-info h3 {
            margin-bottom: 0.5rem;
        }
        
        .provider-category {
            display: inline-block;
            background-color: var(--secondary-color);
            color: var(--white);
            font-size: 0.8rem;
            padding: 0.2rem 0.8rem;
            border-radius: 12px;
            margin-bottom: 0.8rem;
        }
        
        .provider-rating {
            color: var(--accent-color);
            margin-bottom: 1rem;
        }
        
        /* Community Section */
        .community {
            padding: 5rem 5%;
            background-color: var(--light-gray);
            text-align: center;
        }
        
        .testimonials {
            margin-top: 3rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .testimonial-card {
            background-color: var(--white);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: var(--shadow);
            text-align: left;
        }
        
        .testimonial-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .testimonial-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #ddd;
            margin-right: 1rem;
            background-image: url('images/avatar-placeholder.jpg');
            background-size: cover;
        }
        
        .forum-preview {
            margin-top: 3rem;
            background-color: var(--white);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: var(--shadow);
        }
        
        .forum-topics {
            margin-top: 1.5rem;
        }
        
        .forum-topic {
            display: flex;
            justify-content: space-between;
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
        }
        
        /* Footer */
        footer {
            background-color: var(--text-color);
            color: var(--white);
            padding: 3rem 5%;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
        }
        
        .footer-column h3 {
            margin-bottom: 1.5rem;
            color: var(--primary-color);
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 0.8rem;
        }
        
        .footer-links a {
            color: var(--white);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-links a:hover {
            color: var(--primary-color);
        }

        .copyright {
            text-align: center;
            padding-top: 2rem;
            margin-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            overflow: auto;
        }
        
        .modal-content {
            background-color: var(--white);
            margin: 10% auto;
            padding: 2rem;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
            box-shadow: var(--shadow);
            position: relative;
        }
        
        .close-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        
        .form-control {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        
        /* Alerts */
        .alert {
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
            display: none;
        }
        
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 1rem;
            }
            
            .logo {
                margin-bottom: 1rem;
            }
            
            .nav-links {
                flex-direction: column;
                width: 100%;
                text-align: center;
            }
            
            .nav-links li {
                margin: 0.5rem 0;
            }
            
            .auth-buttons {
                width: 100%;
                justify-content: center;
                margin-top: 1rem;
            }
            
            .hero {
                height: auto;
                padding-top: 6rem;
                padding-bottom: 4rem;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<script src="script.js"></script>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="logo">Bodas<span>.com.mx</span></div>
        <ul class="nav-links">
            <li><a href="#" class="active">Inicio</a></li>
            <li><a href="#">Servicios</a></li>
            <li><a href="#">Proveedores</a></li>
            <li><a href="#">Comunidad</a></li>
        </ul>
        <div class="auth-buttons">
            <?php if ($logged_in): ?>
                <span style="margin-right: 1rem;">Hola, <?php echo htmlspecialchars($nombre_usuario); ?></span>
                <a href="logout.php" class="btn btn-login">Cerrar sesión</a>
            <?php else: ?>
                <a href="#" class="btn btn-login" onclick="openModal('login-modal')">Iniciar sesión</a>
                <a href="#" class="btn btn-signup" onclick="openModal('signup-modal')">Crear cuenta</a>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Tu boda perfecta comienza aquí</h1>
        <p>Crea tu página de boda personalizada, encuentra los mejores proveedores y organiza tu día especial sin complicaciones.</p>
        <a href="#" class="btn btn-primary" onclick="openModal('create-wedding-modal')">Crear mi página de boda</a>
    </section>

    <!-- Features Section -->
    <section class="features">
        <h2 class="section-title">Todo lo que necesitas para tu boda perfecta</h2>
        <div class="feature-cards">
            <div class="feature-card">
                <div class="feature-icon">💻</div>
                <h3>Página web personalizada</h3>
                <p>Crea tu propia página web de boda para compartir con tus invitados, con fotos, historia de amor y toda la información importante.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">👥</div>
                <h3>Gestión de invitados</h3>
                <p>Gestiona tu lista de invitados, envía invitaciones digitales y realiza un seguimiento de las confirmaciones de asistencia.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🏆</div>
                <h3>Mejores proveedores</h3>
                <p>Encuentra y contrata a los mejores proveedores para tu boda: fotógrafos, catering, floristas y más.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📅</div>
                <h3>Planificador</h3>
                <p>Organiza todas las tareas pendientes con nuestro planificador inteligente que te guiará paso a paso.</p>
            </div>
        </div>
    </section>

    <!-- Providers Section -->
    <section class="providers">
        <h2 class="section-title">Proveedores destacados</h2>
        <div class="provider-filters">
            <button class="filter-btn active">Todos</button>
            <button class="filter-btn">Fotografía</button>
            <button class="filter-btn">Catering</button>
            <button class="filter-btn">Florería</button>
            <button class="filter-btn">Música</button>
            <button class="filter-btn">Locaciones</button>
        </div>
        <div class="provider-cards">
            <div class="provider-card">
                <div class="provider-image"></div>
                <div class="provider-info">
                    <span class="provider-category">Fotografía</span>
                    <h3>Moments Photography</h3>
                    <div class="provider-rating">★★★★★</div>
                    <p>Capturando momentos inolvidables con un estilo único y personal.</p>
                    <a href="#" class="btn btn-primary">Ver detalles</a>
                </div>
            </div>
            <div class="provider-card">
                <div class="provider-image"></div>
                <div class="provider-info">
                    <span class="provider-category">Catering</span>
                    <h3>Delicias Gourmet</h3>
                    <div class="provider-rating">★★★★☆</div>
                    <p>Menús personalizados con ingredientes frescos para sorprender a tus invitados.</p>
                    <a href="#" class="btn btn-primary">Ver detalles</a>
                </div>
            </div>
            <div class="provider-card">
                <div class="provider-image"></div>
                <div class="provider-info">
                    <span class="provider-category">Florería</span>
                    <h3>Pétalos & Co.</h3>
                    <div class="provider-rating">★★★★★</div>
                    <p>Arreglos florales únicos que harán de tu boda un evento mágico.</p>
                    <a href="#" class="btn btn-primary">Ver detalles</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Community Section -->
    <section class="community">
        <h2 class="section-title">Nuestra comunidad</h2>
        <p>Únete a miles de parejas que comparten experiencias y consejos para crear bodas increíbles.</p>
        
        <div class="testimonials">
            <div class="testimonial-card">
                <div class="testimonial-header">
                    <div class="testimonial-avatar"></div>
                    <div>
                        <h4>María y Carlos</h4>
                        <small>Ciudad de México - Marzo 2025</small>
                    </div>
                </div>
                <p>"Gracias a Bodas.com.mx pudimos organizar nuestra boda en tiempo récord. La plataforma es súper intuitiva y los proveedores son de primera calidad."</p>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-header">
                    <div class="testimonial-avatar"></div>
                    <div>
                        <h4>Laura y Daniel</h4>
                        <small>Guadalajara - Enero 2025</small>
                    </div>
                </div>
                <p>"Nuestros invitados quedaron encantados con nuestra página web personalizada. El sistema de confirmación de asistencia funcionó perfectamente."</p>
            </div>
        </div>
        
        <div class="forum-preview">
            <h3>Foros populares</h3>
            <div class="forum-topics">
                <div class="forum-topic">
                    <span>¿Cómo elegir el vestido perfecto?</span>
                    <small>32 respuestas</small>
                </div>
                <div class="forum-topic">
                    <span>Ideas para bodas al aire libre</span>
                    <small>48 respuestas</small>
                </div>
                <div class="forum-topic">
                    <span>Presupuestos y tips de ahorro</span>
                    <small>72 respuestas</small>
                </div>
            </div>
            <a href="#" class="btn btn-primary" style="margin-top: 1.5rem;">Ir al foro</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <h3>Bodas.com.mx</h3>
                <p>La plataforma más completa para organizar la boda de tus sueños en México.</p>
            </div>
            <div class="footer-column">
                <h3>Enlaces rápidos</h3>
                <ul class="footer-links">
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#">Servicios</a></li>
                    <li><a href="#">Proveedores</a></li>
                    <li><a href="#">Comunidad</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Servicios</h3>
                <ul class="footer-links">
                    <li><a href="#">Crear página de boda</a></li>
                    <li><a href="#">Gestión de invitados</a></li>
                    <li><a href="#">Directorio de proveedores</a></li>
                    <li><a href="#">Planificador de bodas</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Contacto</h3>
                <ul class="footer-links">
                    <li><a href="mailto:info@bodas.com.mx">info@bodas.com.mx</a></li>
                    <li><a href="tel:+525512345678">+52 55 1234 5678</a></li>
                    <li><a href="#">CDMX, México</a></li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2025 Bodas.com.mx - Todos los derechos reservados</p>
        </div>
    </footer>

    <!-- Modals -->
    <!-- Login Modal -->
    <div id="login-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('login-modal')">&times;</span>
            <h2>Iniciar sesión</h2>
            <div id="login-alert" class="alert"></div>
            <form id="login-form">
                <div class="form-group">
                    <label for="login-email">Correo electrónico</label>
                    <input type="email" id="login-email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="login-password">Contraseña</label>
                    <input type="password" id="login-password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Iniciar sesión</button>
            </form>
            <p style="margin-top: 1rem; text-align: center;">¿No tienes cuenta? <a href="#" onclick="openModal('signup-modal'); closeModal('login-modal')">Regístrate</a></p>
        </div>
    </div>

    <!-- Signup Modal -->
    <div id="signup-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('signup-modal')">&times;</span>
            <h2>Crear cuenta</h2>
            <div id="signup-alert" class="alert"></div>
            <form id="signup-form">
                <div class="form-group">
                    <label for="signup-nombre">Nombre completo</label>
                    <input type="text" id="signup-nombre" name="nombre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="signup-email">Correo electrónico</label>
                    <input type="email" id="signup-email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="signup-password">Contraseña</label>
                    <input type="password" id="signup-password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Tipo de cuenta</label>
                    <div style="display: flex;">
                        <label style="margin-right: 20px;">
                            <input type="radio" name="tipo_cuenta" value="pareja" checked> Soy pareja
                        </label>
                        <label>
                            <input type="radio" name="tipo_cuenta" value="proveedor"> Soy proveedor
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Crear cuenta</button>
            </form>
            <p style="margin-top: 1rem; text-align: center;">¿Ya tienes cuenta? <a href="#" onclick="openModal('login-modal'); closeModal('signup-modal')">Inicia sesión</a></p>
        </div>
    </div>

    <!-- Create Wedding Modal -->
    <div id="create-wedding-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('create-wedding-modal')">&times;</span>
            <h2>Crear página de boda</h2>
            <div id="wedding-alert" class="alert"></div>
            <form id="create-wedding-form">
                <div class="form-group">
                    <label for="nombres-pareja">Nombres de la pareja</label>
                    <input type="text" id="nombres-pareja" name="nombres_pareja" class="form-control" placeholder="Ej: María & Juan" required>
                </div>
                <div class="form-group">
                    <label for="fecha-boda">Fecha de la boda</label>
                    <input type="date" id="fecha-boda" name="fecha_boda" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="lugar-ceremonia">Lugar de la ceremonia</label>
                    <input type="text" id="lugar-ceremonia" name="lugar_ceremonia" class="form-control" placeholder="Ej: Hacienda Los Olivos, CDMX" required>
                </div>
                <div class="form-group">
                    <label for="tema-boda">Tema de la boda</label>
                    <select id="tema-boda" name="tema" class="form-control" required>
                        <option value="">Seleccionar tema</option>
                        <option value="Clásico">Clásico</option>
                        <option value="Bohemio">Bohemio</option>
                        <option value="Playa">Playa</option>
                        <option value="Vintage">Vintage</option>
                        <option value="Moderno">Moderno</option>
                        <option value="Rústico">Rústico</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Crear página de boda</button>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Modal Functions
        function openModal(modalId) {
            document.getElementById(modalId).style.display = "block";
        }
        
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = "none";
            
            // Reset any alerts
            const alertElement = document.querySelector(`#${modalId} .alert`);
            if (alertElement) {
                alertElement.style.display = "none";
                alertElement.className = "alert";
                alertElement.textContent = "";
            }
            
            // Reset form if exists
            const formElement = document.querySelector(`#${modalId} form`);
            if (formElement) {
                formElement.reset();
            }
        }
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            const modals = document.getElementsByClassName("modal");
            for (let i = 0; i < modals.length; i++) {
                if (event.target === modals[i]) {
                    modals[i].style.display = "none";
                }
            }
        };
        
        // Form submissions
        document.addEventListener("DOMContentLoaded", function() {
            // Login Form
            const loginForm = document.getElementById("login-form");
            if (loginForm) {
                loginForm.addEventListener("submit", function(e) {
                    e.preventDefault();
                    const formData = new FormData(loginForm);
                    
                    fetch("login.php", {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        const alertElement = document.getElementById("login-alert");
                        alertElement.textContent = data.message;
                        alertElement.style.display = "block";
                        
                        if (data.status === "success") {
                            alertElement.className = "alert alert-success";
                            setTimeout(function() {
                                if (data.redirect) {
                                    window.location.href = data.redirect;
                                }
                            }, 1500);
                        } else {
                            alertElement.className = "alert alert-danger";
                        }
                    })
                    .catch(error => {
                        document.getElementById("login-alert").textContent = "Error de conexión. Inténtalo de nuevo.";
                        document.getElementById("login-alert").className = "alert alert-danger";
                        document.getElementById("login-alert").style.display = "block";
                    });
                });
            }
