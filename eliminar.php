<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$servidor = "localhost";
$usuario_db = "root";
$password_db = "";
$base_datos = "cs_cases";

$conexion = new mysqli($servidor, $usuario_db, $password_db, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

$nombreUsuario = $_SESSION['usuario'];

$stmt = $conexion->prepare("DELETE FROM usuario WHERE nombreUsuario = ?");
$stmt->bind_param("s", $nombreUsuario);

if ($stmt->execute()) {
    session_unset();
    session_destroy();
    echo "<script>alert('Tu cuenta ha sido eliminada exitosamente.'); window.location.href='index.php';</script>";
} else {
    echo "<script>alert('Hubo un error al intentar eliminar la cuenta.'); window.location.href='perfil.php';</script>";
}

$stmt->close();
$conexion->close();
?>