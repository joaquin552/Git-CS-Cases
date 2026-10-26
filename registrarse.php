<?php
// Datos del usuario
$nombreUsuario = "Nombre de Usuario";
$descripcion = "Descripción";

$cajasAbiertas = 0;
$rachaDias = 0;

// Imagen de perfil
$fotoPerfil = "img/perfil.png";

// Imagen del banner
$banner = "img/banner.png";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Perfil</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #000;
            font-family: Arial, Helvetica, sans-serif;
            color: white;
        }

        /* CONTENEDOR PRINCIPAL */
        .perfil {
            width: 100%;
            min-height: 100vh;
        }

        /* BANNER */
        .banner {
            height: 140px;
            width: 100%;

            background-image: url('<?php echo $banner; ?>');
            background-size: cover;
            background-position: center;

            position: relative;
        }

        /* FOTO DE PERFIL */
        .foto-perfil {
            position: absolute;

            left: 37px;
            top: 23px;

            width: 100px;
            height: 100px;

            object-fit: cover;
        }

        /* INFORMACIÓN DEL USUARIO */
        .informacion {
            position: absolute;

            left: 143px;
            top: 27px;

            color: black;
        }

        .informacion h1 {
            font-size: 23px;
            margin-bottom: 2px;
        }

        .informacion p {
            font-size: 17px;
            font-weight: bold;
        }

        /* BOTÓN CERRAR SESIÓN */
        .cerrar-sesion {
            position: absolute;

            right: 8px;
            top: 4px;

            background-color: white;
            color: black;

            border: 1px solid #aaa;
            border-radius: 15px;

            padding: 3px 8px;

            font-size: 11px;
            cursor: pointer;
        }

        .cerrar-sesion:hover {
            background-color: #ddd;
        }

        /* ESTADÍSTICAS */
        .estadisticas {
            width: 100%;

            display: flex;
            justify-content: space-between;

            padding: 10px 60px;
        }

        .estadistica {
            font-size: 18px;
            font-weight: bold;
        }

        /* PUNTO */
        .punto {
            width: 15px;
            height: 15px;

            background-color: #00aebb;

            border-radius: 50%;

            margin-left: auto;
            margin-right: 0;

            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="perfil">

        <!-- BANNER -->
        <div class="banner">

            <!-- FOTO -->
            <img
                src="<?php echo $fotoPerfil; ?>"
                class="foto-perfil"
                alt="Foto de perfil"
            >

            <!-- INFORMACIÓN -->
            <div class="informacion">

                <h1>
                    <?php echo $nombreUsuario; ?>
                </h1>

                <p>
                    <?php echo $descripcion; ?>
                </p>

            </div>

            <!-- CERRAR SESIÓN -->
            <form action="logout.php" method="POST">
                <button
                    type="submit"
                    class="cerrar-sesion"
                >
                    Cerrar Sesión
                </button>
            </form>

        </div>

        <!-- ESTADÍSTICAS -->
        <div class="estadisticas">

            <div class="estadistica">
                Cajas Abiertas:<?php echo $cajasAbiertas; ?>
            </div>

            <div class="estadistica">
                Racha de Días Consecutivos:<?php echo $rachaDias; ?>
            </div>

        </div>

        <!-- PUNTO -->
        <div class="punto"></div>

    </div>

</body>
</html>