<?php
session_start();
$mensaje = "";

$servidor = "localhost";
$usuario_db = "root";
$password_db = "";
$base_datos = "cs_cases";

$conexion = new mysqli($servidor, $usuario_db, $password_db, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $contrasena = $_POST['contrasena'];

    if (!empty($usuario) && !empty($contrasena)) {
        $stmt = $conexion->prepare("SELECT nombreUsuario, contraseña, rol FROM usuario WHERE nombreUsuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $fila = $resultado->fetch_assoc();
            if (password_verify($contrasena, $fila['contraseña'])) {
                $_SESSION['usuario'] = $fila['nombreUsuario'];
                $_SESSION['rol'] = $fila['rol']; // Guardamos el rol en la sesión
                echo "<script>alert('¡Bienvenido de nuevo, " . $fila['nombreUsuario'] . "!'); window.location.href='perfil.php';</script>";
                exit;
            } else {
                $mensaje = "Contraseña incorrecta.";
            }
        } else {
            $mensaje = "El usuario no existe.";
        }
        $stmt->close();
    } else {
        $mensaje = "Por favor, completa todos los campos.";
    }
}
$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - BoxCS2</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: Arial, sans-serif; }
        body { background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://blog-uploads.eneba.games/uploads/2026/04/opening-a-case-best-cs2-case-opening-sites.webp') no-repeat center center fixed; background-size: cover; min-height: 100vh; display: flex; justify-content: center; align-items: center; position: relative; }
        .btn-cancelar { position: absolute; top: 20px; left: 20px; background-color: rgba(0, 0, 0, 0.6); color: #ffffff; border: 2px solid #ffffff; padding: 10px 20px; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; text-decoration: none; transition: all 0.3s ease; }
        .btn-cancelar:hover { background-color: #ff4d4d; border-color: #ff4d4d; }
        .login-card { background-color: rgba(20, 20, 20, 0.85); border: 2px solid rgba(255, 255, 255, 0.1); padding: 40px; border-radius: 12px; width: 450px; box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.5); text-align: center; color: white; }
        .login-card h2 { font-size: 28px; margin-bottom: 25px; font-weight: bold; }
        .form-group { text-align: left; margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px; }
        .form-group input[type="text"], .form-group input[type="password"] { width: 100%; padding: 12px 15px; background-color: #ffffff; border: none; border-radius: 6px; font-size: 16px; color: #333; outline: none; }
        .captcha-container { display: flex; align-items: center; justify-content: space-between; background-color: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.2); padding: 12px 15px; border-radius: 6px; margin-bottom: 25px; }
        .btn-container { display: flex; gap: 15px; margin-bottom: 25px; }
        .btn { flex: 1; padding: 12px 0; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; text-decoration: none; display: inline-block; text-align: center; }
        .btn-login { background-color: #3b5998; color: white; }
        .btn-register { background-color: #4a6fa5; color: white; }
        .mensaje-error { color: #ff4d4d; font-size: 13px; margin-bottom: 15px; font-weight: bold; }
    </style>
</head>
<body>
    <a href="index.php" class="btn-cancelar">← Cancelar</a>
    <div class="login-card">
        <h2>Iniciar Sesión</h2>
        <?php if (!empty($mensaje)): ?>
            <div class="mensaje-error"><?php echo htmlspecialchars($mensaje); ?></div>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="usuario">Nombre de Usuario</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div>
            <div class="captcha-container">
                <span>Confirmar que no eres un bot</span>
                <input type="checkbox" id="not_bot" name="not_bot" required>
            </div>
            <div class="btn-container">
                <button type="submit" class="btn btn-login">Iniciar Sesión</button>
                <a href="iniciosesion.php" class="btn btn-register">Registrarse</a>
            </div>
        </form>
    </div>
</body>
</html>