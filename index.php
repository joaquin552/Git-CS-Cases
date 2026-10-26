<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BoxCS2</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: #000; color: #fff; min-height: 100vh; display: flex; flex-direction: column; }
        header { display: flex; justify-content: space-between; align-items: center; padding: 15px 30px; background-color: #000; }
        .logo { display: flex; align-items: center; gap: 10px; font-weight: 700; font-size: 1.5rem; color: #fff; }
        .logo span { color: #f39c12; }
        .search-btn { background: #fff; border: none; padding: 8px; border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center; }
        .hero { position: relative; flex: 1; display: flex; align-items: center; justify-content: flex-start; padding: 40px; background-image: url('https://blog-uploads.eneba.games/uploads/2026/04/opening-a-case-best-cs2-case-opening-sites.webp'); background-size: cover; background-position: center; overflow: hidden; }
        .menu-buttons { display: flex; flex-direction: column; gap: 20px; z-index: 2; }
        .btn-pixel { background-color: #ffffff; color: #000; border: 4px solid #000; border-radius: 40px; padding: 15px 30px; font-family: 'Press Start 2P', monospace; font-size: 0.9rem; text-align: center; text-decoration: none; box-shadow: 4px 4px 0px #000; transition: transform 0.1s ease, box-shadow 0.1s ease; cursor: pointer; width: 280px; }
        .btn-pixel:hover { transform: translate(-2px, -2px); box-shadow: 6px 6px 0px #000; }
        footer { display: flex; justify-content: flex-end; align-items: center; padding: 15px 40px; background-color: #000; }
        .auth-container { display: flex; align-items: center; gap: 15px; }
        .avatar-icon { width: 40px; height: 40px; border: 2px solid #00f2fe; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
        .auth-links { font-size: 1rem; font-weight: 600; }
        .auth-links a { color: #fff; text-decoration: none; transition: color 0.2s; }
        .auth-links a:hover { color: #f39c12; }
        .auth-links .divider { margin: 0 5px; color: #888; }
        .user-welcome { color: #f39c12; font-weight: bold; }
        .modal-acerca-container { display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.85); justify-content: center; align-items: center; }
        .modal-acerca-content { position: relative; width: 90%; max-width: 550px; border: 3px solid #f39c12; border-radius: 12px; background-color: #0b0b0b; padding: 30px 20px; box-shadow: 0 0 30px rgba(243, 156, 18, 0.4); color: #fff; text-align: center; }
        .about-title { font-family: 'Press Start 2P', monospace; font-size: 1.4rem; color: #f39c12; margin-bottom: 5px; }
        .about-school { font-size: 0.95rem; color: #aaa; margin-bottom: 20px; font-weight: 600; }
        .team-list { display: flex; flex-direction: column; gap: 10px; margin-bottom: 20px; }
        .team-member { background-color: #1a1a1a; border: 1px solid #333; padding: 10px 15px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center; font-weight: 600; }
        .team-member span { color: #fff; }
        .team-member small { color: #00f2fe; font-size: 0.85rem; }
        .emails-section { border-top: 1px solid #333; padding-top: 15px; }
        .emails-title { font-size: 0.85rem; color: #888; margin-bottom: 5px; }
        .email-text { font-size: 0.75rem; color: #ccc; word-break: break-all; }
        .close-modal { position: absolute; top: -15px; right: -15px; background-color: #ff4d4d; color: white; font-size: 20px; font-weight: bold; width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; border: 2px solid #fff; z-index: 10000; }
        .close-modal:hover { background-color: #cc0000; }

        /* Estilo para el botón flotante de Admin */
        .btn-admin-flotante {
            position: fixed;
            bottom: 15px;
            left: 50px;
            background-color: #ffffff;
            color: #000;
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 0.85rem;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.5);
            z-index: 999;
            transition: background 0.2s, transform 0.2s;
            border: 2px solid #000;
        }
        .btn-admin-flotante:hover {
            background-color: #fff;
            transform: translateY(-3px);
        }
    </style>
</head>
<body>
    <header>
        <div class="logo"><span>🎁</span> BoxCS2</div>
        <form action="buscar.php" method="GET" style="display: flex; gap: 8px; align-items: center;">
            <input type="text" name="usuario" placeholder="Buscar usuario..." required style="padding: 6px 12px; border-radius: 4px; border: none; font-size: 14px; outline: none;">
            <button type="submit" class="search-btn" aria-label="Buscar">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </button>
        </form>
    </header>

    <main class="hero">
        <div class="menu-buttons">
            <a href="perfil.php" class="btn-pixel">VER PERFIL</a>
            <a href="#" class="btn-pixel">ABRIR CAJAS</a>
            <a href="skins.php" class="btn-pixel">SKINS OBTENIDAS</a>
            <a href="#" id="btn-acerca" class="btn-pixel">ACERCA DE NOSOTROS</a>
        </div>
    </main>

    <footer>
        <div class="auth-container">
            <div class="avatar-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                </svg>
            </div>
            <div class="auth-links">
                <?php if (isset($_SESSION['usuario'])): ?>
                    <span class="user-welcome">Hola, <?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
                    <span class="divider">/</span>
                    <a href="logout.php">Salir</a>
                <?php else: ?>
                    <a href="login.php">Iniciar Sesión</a>
                    <span class="divider">/</span>
                    <a href="iniciosesion.php">Registrarse</a>
                <?php endif; ?>
            </div>
        </div>
    </footer>

    <!-- Botón flotante de Administrador (Solo visible para rol 'dev') -->
    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'dev'): ?>
        <a href="admin.php" class="btn-admin-flotante">⚙️ Panel Admin</a>
    <?php endif; ?>

    <div id="modal-acerca" class="modal-acerca-container">
        <div class="modal-acerca-content">
            <span class="close-modal">&times;</span>
            <h2 class="about-title">LOS SIGMAS</h2>
            <p class="about-school">E.T. N°26 D.E. 6 "Confederación Suiza"</p>
            <div class="team-list">
                <div class="team-member"><span>Oscar Perez</span> <small>Front End</small></div>
                <div class="team-member"><span>Cristopher Juarez</span> <small>Front End</small></div>
                <div class="team-member"><span>Sergio Gaspar</span> <small>Scrum Master</small></div>
                <div class="team-member"><span>Thiago Sarni</span> <small>Back End</small></div>
                <div class="team-member"><span>Joaquin Umnon</span> <small>Data Base</small></div>
            </div>
            <div class="emails-section">
                <p class="emails-title">Contacto / Correos:</p>
                <p class="email-text">frontend@gmail.com | frontend2@gmail.com</p>
                <p class="email-text">scrummaster09@gmail.com | backend11@gmail.com</p>
                <p class="email-text">database865@gmail.com</p>
            </div>
        </div>
    </div>

    <script>
        const modalAcerca = document.getElementById("modal-acerca");
        const btnAcerca = document.getElementById("btn-acerca");
        const spanCerrar = document.querySelector(".close-modal");

        btnAcerca.onclick = function(e) { e.preventDefault(); modalAcerca.style.display = "flex"; }
        spanCerrar.onclick = function() { modalAcerca.style.display = "none"; }
        window.onclick = function(event) { if (event.target == modalAcerca) { modalAcerca.style.display = "none"; } }
    </script>
</body>
</html>