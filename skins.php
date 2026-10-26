<?php
// Iniciamos la sesión para saber qué usuario está conectado
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$nombreUsuario = $_SESSION['usuario'];

$servidor = "localhost";
$usuario_db = "root";
$password_db = "";
$base_datos = "cs_cases";

$conexion = new mysqli($servidor, $usuario_db, $password_db, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// 1. Buscamos el ID del usuario actual
$stmt_user = $conexion->prepare("SELECT IDusuario FROM usuario WHERE nombreUsuario = ?");
$stmt_user->bind_param("s", $nombreUsuario);
$stmt_user->execute();
$resultado_user = $stmt_user->get_result();
$usuario_data = $resultado_user->fetch_assoc();
$idUsuario = $usuario_data['IDusuario'];
$stmt_user->close();

// 2. Consultamos las skins/objetos sin usar fechaObtencion (que ya no está en la BD)
$sql = "SELECT o.nombreObjeto, o.rareza, a.tipoArma 
        FROM inventario_usuario i
        JOIN objeto o ON i.IDobjeto = o.IDobjeto
        LEFT JOIN arma a ON o.IDobjeto = a.IDobjeto
        WHERE i.IDusuario = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$resultado_skins = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skins Obtenidas - BoxCS2</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: #0b0b0b; color: #fff; min-height: 100vh; display: flex; flex-direction: column; }
        header { display: flex; justify-content: space-between; align-items: center; padding: 20px 40px; background-color: #000; border-bottom: 2px solid #222; }
        .logo { font-family: 'Press Start 2P', monospace; font-size: 1.2rem; color: #fff; text-decoration: none; }
        .logo span { color: #f39c12; }
        .back-btn { background-color: #fff; color: #000; padding: 8px 16px; border-radius: 20px; text-decoration: none; font-weight: 700; font-size: 0.9rem; transition: background 0.2s; }
        .back-btn:hover { background-color: #f39c12; }
        main { flex: 1; padding: 40px; max-width: 1200px; margin: 0 auto; width: 100%; }
        h1 { font-family: 'Press Start 2P', monospace; font-size: 1.5rem; color: #f39c12; margin-bottom: 30px; text-align: center; }
        .skins-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 20px; }
        .skin-card { background-color: #161616; border: 2px solid #333; border-radius: 12px; padding: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.5); transition: transform 0.2s, border-color 0.2s; }
        .skin-card:hover { transform: translateY(-5px); border-color: #f39c12; }
        .skin-name { font-size: 1.1rem; font-weight: 700; color: #fff; margin-bottom: 8px; }
        .skin-type { font-size: 0.85rem; color: #888; margin-bottom: 12px; text-transform: uppercase; }
        .skin-rareza { display: inline-block; padding: 4px 10px; border-radius: 6px; font-size: 0.75rem; font-weight: 700; background-color: #333; color: #00f2fe; margin-bottom: 12px; }
        .no-skins { text-align: center; grid-column: 1 / -1; padding: 50px; background-color: #141414; border-radius: 10px; color: #777; font-size: 1rem; }
    </style>
</head>
<body>

    <header>
        <a href="index.php" class="logo"><span>🎁</span> BoxCS2</a>
        <a href="index.php" class="back-btn">Volver al Inicio</a>
    </header>

    <main>
        <h1>Inventario de Skins</h1>

        <div class="skins-grid">
            <?php if ($resultado_skins->num_rows > 0): ?>
                <?php while($row = $resultado_skins->fetch_assoc()): ?>
                    <div class="skin-card">
                        <div class="skin-name"><?php echo htmlspecialchars($row['nombreObjeto']); ?></div>
                        <div class="skin-type"><?php echo htmlspecialchars($row['tipoArma'] ?? 'Objeto'); ?></div>
                        <div><span class="skin-rareza"><?php echo htmlspecialchars($row.['rareza'] ?? $row['rareza']); ?></span></div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="no-skins">
                    <p>¡Todavía no tienes skins en tu inventario! Abre algunas cajas para empezar a coleccionar.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

</body>
</html>

<?php
$stmt->close();
$conexion->close();
?>