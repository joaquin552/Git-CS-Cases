<?php
session_start();

$servidor = "localhost";
$usuario_db = "root";
$password_db = "";
$base_datos = "cs_cases";

$conexion = new mysqli($servidor, $usuario_db, $password_db, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$busqueda = isset($_GET['usuario']) ? trim($_GET['usuario']) : '';

$stmt = $conexion->prepare("SELECT nombreUsuario, email FROM usuario WHERE nombreUsuario = ?");
$stmt->bind_param("s", $busqueda);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuarioEncontrado = $resultado->fetch_assoc();
} else {
    echo "<script>alert('El usuario no existe.'); window.location.href='index.php';</script>";
    exit();
}

$stmt->close();
$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de <?php echo htmlspecialchars($usuarioEncontrado['nombreUsuario']); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Fredoka', sans-serif; }
        body { background-color: #000000; color: #ffffff; min-height: 100vh; }
        .profile-banner { position: relative; width: 100%; height: 220px; background: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTeUE2eKzjQaKFkd184rYyr5pW4_GZFQaNkB0Au-zbbZg&s=10') no-repeat center center; background-size: cover; display: flex; align-items: center; padding: 0 40px; }
        .btn-menu-principal { position: absolute; top: 20px; right: 20px; background-color: rgba(0, 0, 0, 0.7); color: #ffffff; border: 2px solid #ffffff; padding: 10px 20px; border-radius: 8px; font-size: 15px; font-weight: bold; cursor: pointer; text-decoration: none; transition: all 0.3s ease; z-index: 10; }
        .btn-menu-principal:hover { background-color: #f39c12; border-color: #f39c12; color: #000; }
        .avatar-wrapper { width: 140px; height: 140px; overflow: hidden; background: linear-gradient(135deg, #8baaaa, #ae8b9c); display: flex; justify-content: center; align-items: flex-end; border-radius: 50%; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); flex-shrink: 0; }
        .profile-info { margin-left: 20px; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.6); }
        .profile-info h1 { font-size: 32px; font-weight: 700; color: #ffffff; margin-bottom: 4px; }
        .profile-info p { font-size: 18px; font-weight: 500; color: #d0d0d0; }
        .stats-container { display: flex; justify-content: space-around; align-items: center; padding: 25px 20px; background-color: #000000; margin-top: 20px; }
        .stat-item { font-size: 22px; font-weight: 700; letter-spacing: 0.5px; }
    </style>
</head>
<body>
    <div class="profile-banner">
        <a href="index.php" class="btn-menu-principal">Menú principal</a>
        <div class="avatar-wrapper">
            <svg width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="none">
                <circle cx="50" cy="38" r="22" fill="#ffffff" />
                <path d="M 15 95 C 15 65, 85 65, 85 95 Z" fill="#ffffff" />
            </svg>
        </div>
        <div class="profile-info">
            <h1><?php echo htmlspecialchars($usuarioEncontrado['nombreUsuario']); ?></h1>
            <p>Miembro de la comunidad de Cajas (Perfil Público)</p>
        </div>
    </div>
    <div class="stats-container">
        <div class="stat-item">Cajas Abiertas: 0</div>
        <div class="stat-item">Racha de Días Consecutivos: 0</div>
    </div>
</body>
</html>