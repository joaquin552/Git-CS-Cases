<?php
session_start();

$servidor = "localhost";
$usuario_db = "root";
$password_db = "";
$base_datos = "cs_cases";

$conexion = new mysqli($servidor, $usuario_db, $password_db, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreUsuario = trim($_POST['usuario']);
    $email = trim($_POST['correo']);
    $contrasena = $_POST['contrasena'];
    $confirmar_contrasena = $_POST['confirmar-contrasena'];

    if ($contrasena !== $confirmar_contrasena) {
        echo "<script>alert('Las contraseñas no coinciden.'); window.history.back();</script>";
        exit;
    }

    $contrasena_encriptada = password_hash($contrasena, PASSWORD_DEFAULT);

    $stmt = $conexion->prepare("INSERT INTO usuario (nombreUsuario, email, contraseña, rol) VALUES (?, ?, ?, 'usuario')");
    $stmt->bind_param("sss", $nombreUsuario, $email, $contrasena_encriptada);

    if ($stmt->execute()) {
        $_SESSION['usuario'] = $nombreUsuario;
        $_SESSION['email'] = $email;
        $_SESSION['rol'] = 'usuario'; // Asignamos rol por defecto en la sesión

        echo "<script>alert('¡Cuenta creada exitosamente!'); window.location.href='perfil.php';</script>";
    } else {
        echo "<script>alert('Error: El nombre de usuario o el correo electrónico ya están registrados.'); window.history.back();</script>";
    }

    $stmt->close();
}

$conexion->close();
?>