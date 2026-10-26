<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Selección de Cajas</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #000;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Contenedor principal estilo pantalla */
        .screen-container {
            position: relative;
            width: 1000px;
            height: 560px;
            /* Reemplaza 'fondo.jpg' con la imagen de fondo con desenfoque */
            background: url('https://media.criticalhit.net/2025/11/image-11.jpeg') no-repeat center center;
            background-size: cover;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Barra superior con fondo oscuro para el título */
        .top-bar {
            background-color: #000;
            height: 50px;
            display: flex;
            align-items: center;
            padding-left: 30px;
        }

        .top-bar h1 {
            font-size: 20px;
            font-weight: bold;
        }

        /* Contenedor de tarjetas alineado al centro de manera recta */
        .cards-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 50px;
        }

        .card {
            width: 360px;
            text-align: center;
            text-decoration: none;
            color: inherit;
            display: block;
            transition: transform 0.2s ease;
        }

        /* Efecto al pasar el ratón por encima de la caja */
        .card:hover {
            transform: scale(1.03);
        }

        .card-image-box {
            width: 100%;
            height: 240px;
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.7);
            margin-bottom: 15px;
        }

        .card-image-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-title {
            font-size: 22px;
            font-weight: bold;
            line-height: 1.2;
            text-shadow: 1px 1px 4px rgba(0,0,0,0.8);
        }

        /* Barra inferior negra */
        .footer-bar {
            background-color: #000;
            height: 50px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding-right: 30px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: bold;
            font-size: 18px;
        }

        .user-icon {
            width: 28px;
            height: 28px;
            border: 2px solid #fff;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 14px;
        }
    </style>
</head>
<body>

<?php
// Datos de las dos cajas con sus respectivos enlaces
$cajas = [
    [
        'titulo' => 'Box Classic - 2013',
        'imagen' => 'https://www.dexerto.com/cdn-image/wp-content/uploads/2023/12/19/cs2-case.jpg', // Reemplaza por la imagen correspondiente
        'enlace' => 'box_classic.php'   // Reemplaza con el enlace de destino
    ],
    [
        'titulo' => "Checho’s Box<br>2027 Limited",
        'imagen' => 'https://hellagood.marketing/wp-content/uploads/2025/12/hellagood-18.webp',  // Reemplaza por la imagen correspondiente
        'enlace' => 'chechos_box.php'   // Reemplaza con el enlace de destino
    ]
];

$usuario = "Thiago Tachyon";
?>

<div class="screen-container">
    <!-- Barra superior con el título -->
    <div class="top-bar">
        <h1>Selección de Cajas</h1>
    </div>

    <!-- Contenido central (Cajas con enlaces) -->
    <div class="cards-container">
        <?php foreach ($cajas as $caja): ?>
            <a href="<?php echo htmlspecialchars($caja['enlace']); ?>" class="card">
                <div class="card-image-box">
                    <img src="<?php echo htmlspecialchars($caja['imagen']); ?>" alt="Caja">
                </div>
                <div class="card-title">
                    <?php echo $caja['titulo']; ?>
                </div>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- Barra inferior con el usuario -->
    <div class="footer-bar">
        <div class="user-profile">
            <div class="user-icon">👤</div>
            <span><?php echo htmlspecialchars($usuario); ?></span>
        </div>
    </div>
</div>

</body>
</html>