<?php
// Iniciamos la sesión para saber qué usuario está intentando borrar su cuenta
session_start();

// Si no hay sesión iniciada, redirigimos al index
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$servidor = "localhost";
$usuario_db = "root";
$password_db = "";
$base_datos = "cs_cases";

// Conexión a la base de datos
$conexion = new mysqli($servidor, $usuario_db, $password_db, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Obtenemos el nombre de usuario de la sesión actual
$nombreUsuario = $_SESSION['usuario'];

// Preparamos la consulta para eliminar al usuario de la base de datos
$stmt = $conexion->prepare("DELETE FROM usuario WHERE nombreUsuario = ?");
$stmt->bind_param("s", $nombreUsuario);

if ($stmt->execute()) {
    // Cerramos la sesión y destruimos todos los datos asociados
    session_unset();
    session_destroy();

    // Mensaje de éxito y redirección
    echo "<script>alert('Tu cuenta ha sido eliminada exitosamente.'); window.location.href='index.php';</script>";
} else {
    echo "<script>alert('Hubo un error al intentar eliminar la cuenta.'); window.location.href='perfil.php';</script>";
}

$stmt->close();
$conexion->close();
?>