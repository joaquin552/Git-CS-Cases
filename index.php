<?php
// Iniciamos la sesión para comprobar el estado del usuario
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BoxCS2</title>
    <!-- Importación de fuente estilo pixel -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background-color: #000;
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        /* Barra de navegación superior */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background-color: #000;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 1.5rem;
            color: #fff;
        }
        .logo span {
            color: #f39c12;
        }
        .search-btn {
            background: #fff;
            border: none;
            padding: 8px;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hero {
            position: relative;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding: 40px;
            background-image: url('https://blog-uploads.eneba.games/uploads/2026/04/opening-a-case-best-cs2-case-opening-sites.webp');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            overflow: hidden;
        }
        /* Menú de Botones Estilo Pixel */
        .menu-buttons {
            display: flex;
            flex-direction: column;
            gap: 20px;
            z-index: 2;
        }
        .btn-pixel {
            background-color: #ffffff;
            color: #000;
            border: 4px solid #000;
            border-radius: 40px;
            padding: 15px 30px;
            font-family: 'Press Start 2P', monospace;
            font-size: 0.9rem;
            text-align: center;
            text-decoration: none;
            box-shadow: 4px 4px 0px #000;
            transition: transform 0.1s ease, box-shadow 0.1s ease;
            cursor: pointer;
            width: 280px;
        }
        .btn-pixel:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px #000;
        }
        .btn-pixel:active {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0px #000;
        }
        /* Barra Inferior / Footer */
        footer {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 15px 40px;
            background-color: #000;
        }
        .auth-container {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .avatar-icon {
            width: 40px;
            height: 40px;
            border: 2px solid #00f2fe;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-links {
            font-size: 1rem;
            font-weight: 600;
        }
        .auth-links a {
            color: #fff;
            text-decoration: none;
            transition: color 0.2s;
        }
        .auth-links a:hover {
            color: #f39c12;
        }
        .auth-links .divider {
            margin: 0 5px;
            color: #888;
        }
        .user-welcome {
            color: #f39c12;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Encabezado -->
    <header>
        <div class="logo">
            <span>🎁</span> BoxCS2
        </div>
        <button class="search-btn" aria-label="Buscar">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
        </button>
    </header>

    <!-- Contenido Principal -->
    <main class="hero">
        <div class="menu-buttons">
            <a href="perfil.php" class="btn-pixel">VER PERFIL</a>
            <a href="#" class="btn-pixel">ABRIR CAJAS</a>
            <a href="#" class="btn-pixel">SKINS OBTENIDAS</a>
            <a href="#" class="btn-pixel">ACERCA DE NOSOTROS</a>
        </div>
    </main>

    <!-- Pie de página -->
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
</body>
</html>