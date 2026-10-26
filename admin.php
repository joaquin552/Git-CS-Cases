<?php
session_start();

// Validar estrictamente que el usuario sea 'dev'
if (!isset($_SESSION['usuario']) || !isset($_SESSION['rol']) || $_SESSION['rol'] !== 'dev') {
    header("Location: index.php");
    exit();
}

$servidor = "localhost";
$usuario_db = "root";
$password_db = "";
$base_datos = "cs_cases";

$conexion = new mysqli($servidor, $usuario_db, $password_db, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$mensaje = "";
$tipo_mensaje = "";

// Lógica para actualizar el rol cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] === 'cambiar_rol') {
    $nombreObjetivo = trim($_POST['nombre_usuario']);
    $nuevoRol = $_POST['nuevo_rol'];

    if (!empty($nombreObjetivo) && ($nuevoRol === 'dev' || $nuevoRol === 'usuario')) {
        // Verificar si el usuario existe
        $stmt_check = $conexion->prepare("SELECT IDusuario FROM usuario WHERE nombreUsuario = ?");
        $stmt_check->bind_param("s", $nombreObjetivo);
        $stmt_check->execute();
        $resultado_check = $stmt_check->get_result();

        if ($resultado_check->num_rows > 0) {
            // Evitar que un dev se quite su propio rol por accidente si lo desea, o permitirlo (aquí lo permitimos con advertencia, pero actualizamos)
            $stmt_update = $conexion->prepare("UPDATE usuario SET rol = ? WHERE nombreUsuario = ?");
            $stmt_update->bind_param("ss", $nuevoRol, $nombreObjetivo);
            
            if ($stmt_update->execute()) {
                $mensaje = "¡El rol del usuario '$nombreObjetivo' ha sido actualizado a '$nuevoRol' exitosamente!";
                $tipo_mensaje = "success";
            } else {
                $mensaje = "Hubo un error al actualizar la base de datos.";
                $tipo_mensaje = "error";
            }
            $stmt_update->close();
        } else {
            $mensaje = "El usuario '$nombreObjetivo' no existe en la base de datos.";
            $tipo_mensaje = "error";
        }
        $stmt_check->close();
    } else {
        $mensaje = "Por favor, completa todos los campos correctamente.";
        $tipo_mensaje = "error";
    }
}
$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - BoxCS2</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: #0b0b0b; color: #fff; min-height: 100vh; display: flex; flex-direction: column; }
        header { display: flex; justify-content: space-between; align-items: center; padding: 20px 40px; background-color: #000; border-bottom: 2px solid #222; }
        .logo { font-family: 'Press Start 2P', monospace; font-size: 1.2rem; color: #fff; text-decoration: none; }
        .logo span { color: #f39c12; }
        .back-btn { background-color: #fff; color: #000; padding: 8px 16px; border-radius: 20px; text-decoration: none; font-weight: 700; font-size: 0.9rem; transition: background 0.2s; }
        .back-btn:hover { background-color: #f39c12; }
        main { flex: 1; padding: 40px; max-width: 800px; margin: 0 auto; width: 100%; }
        h1 { font-family: 'Press Start 2P', monospace; font-size: 1.5rem; color: #f39c12; margin-bottom: 30px; text-align: center; }
        .admin-card { background-color: #161616; border: 2px solid #333; border-radius: 12px; padding: 30px; box-shadow: 0 4px 10px rgba(0,0,0,0.5); margin-bottom: 25px; }
        .admin-card h2 { font-size: 1.2rem; color: #f39c12; margin-bottom: 15px; font-weight: 700; }
        .form-group { text-align: left; margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 600; font-size: 0.9rem; color: #ccc; }
        .form-group input[type="text"], .form-group select { width: 100%; padding: 10px 15px; background-color: #222; border: 1px solid #444; border-radius: 6px; font-size: 1rem; color: #fff; outline: none; }
        .form-group input[type="text"]:focus, .form-group select:focus { border-color: #f39c12; }
        .btn-submit { background-color: #f39c12; color: #000; border: none; padding: 12px 20px; border-radius: 6px; font-size: 1rem; font-weight: bold; cursor: pointer; width: 100%; transition: background 0.2s; }
        .btn-submit:hover { background-color: #e08b0b; }
        .mensaje { padding: 12px; border-radius: 6px; margin-bottom: 20px; font-weight: 600; text-align: center; font-size: 0.9rem; }
        .mensaje.success { background-color: rgba(46, 204, 113, 0.2); border: 1px solid #2ecc71; color: #2ecc71; }
        .mensaje.error { background-color: rgba(231, 76, 60, 0.2); border: 1px solid #e74c3c; color: #e74c3c; }
    </style>
</head>
<body>

    <header>
        <a href="index.php" class="logo"><span>🎁</span> BoxCS2 - Admin</a>
        <a href="index.php" class="back-btn">Volver al Inicio</a>
    </header>

    <main>
        <h1>Panel de Administración</h1>

        <?php if (!empty($mensaje)): ?>
            <div class="mensaje <?php echo $tipo_mensaje; ?>"><?php echo htmlspecialchars($mensaje); ?></div>
        <?php endif; ?>

        <div class="admin-card">
            <h2>Asignar o Quitar Rol de Desarrollador (Dev)</h2>
            <form action="admin.php" method="POST">
                <input type="hidden" name="accion" value="cambiar_rol">
                
                <div class="form-group">
                    <label for="nombre_usuario">Nombre de Usuario exacto:</label>
                    <input type="text" id="nombre_usuario" name="nombre_usuario" placeholder="Ej. JuanPerez123" required>
                </div>

                <div class="form-group">
                    <label for="nuevo_rol">Seleccionar Rol:</label>
                    <select id="nuevo_rol" name="nuevo_rol" required>
                        <option value="dev">Dev (Administrador)</option>
                        <option value="usuario">Usuario Estándar</option>
                    </select>
                </div>

                <button type="submit" class="btn-submit">Aplicar Cambios de Rol</button>
            </form>
        </div>
    </main>

</body>
</html>
</html>