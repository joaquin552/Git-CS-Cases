<?php
// Iniciamos sesión para recuperar los datos
session_start();

// Si el usuario no ha iniciado sesión, lo devolvemos al index
if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Fredoka', sans-serif;
        }

        body {
            background-color: #000000;
            color: #ffffff;
            min-height: 100vh;
        }

        /* Banner superior */
        .profile-banner {
            position: relative;
            width: 100%;
            height: 220px;
            background: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTeUE2eKzjQaKFkd184rYyr5pW4_GZFQaNkB0Au-zbbZg&s=10') no-repeat center center;
            background-size: cover;
            display: flex;
            align-items: center;
            padding: 0 40px;
        }

        /* Avatar de usuario */
        .avatar-wrapper {
            width: 140px;
            height: 140px;
            overflow: hidden;
            background: linear-gradient(135deg, #8baaaa, #ae8b9c);
            display: flex;
            justify-content: center;
            align-items: flex-end;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            flex-shrink: 0;
        }

        /* Información del perfil */
        .profile-info {
            margin-left: 20px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.6);
        }

        .profile-info h1 {
            font-size: 32px;
            font-weight: 700;
            color: #ffffff; /* Cambiado a blanco para que destaque con el texto de sesión */
            margin-bottom: 4px;
        }

        .profile-info p {
            font-size: 18px;
            font-weight: 500;
            color: #d0d0d0;
        }

        /* Sección inferior de estadísticas */
        .stats-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 25px 20px;
            background-color: #000000;
            margin-top: 20px;
        }

        .stat-item {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .logout-btn {
            display: block;
            width: max-content;
            margin: 30px auto;
            padding: 10px 20px;
            background-color: #ff4d4d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .logout-btn:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>

    <!-- Encabezado con imagen de fondo -->
    <div class="profile-banner">
        <div class="avatar-wrapper">
            <!-- Icono SVG de silueta de usuario -->
            <svg width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="none">
                <circle cx="50" cy="38" r="22" fill="#ffffff" />
                <path d="M 15 95 C 15 65, 85 65, 85 95 Z" fill="#ffffff" />
            </svg>
        </div>
        <div class="profile-info">
            <!-- AQUÍ SE MUESTRA EL NOMBRE DE USUARIO DINÁMICAMENTE -->
            <h1><?php echo htmlspecialchars($_SESSION['usuario']); ?></h1>
            <p>Miembro de la comunidad de Cajas</p>
        </div>
    </div>

    <!-- Barra de estadísticas -->
    <div class="stats-container">
        <div class="stat-item">
            Cajas Abiertas: 0
        </div>
        <div class="stat-item">
            Racha de Días Consecutivos: 0
        </div>
    </div>

    <!-- Botón para cerrar sesión (opcional pero útil) -->
    <a href="logout.php" class="logout-btn">Cerrar Sesión</a>

</body>
</html>
