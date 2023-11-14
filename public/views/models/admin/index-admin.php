<?php
session_start(); // Iniciar la sesión

require_once("../../../db/conexion.php");
$db = new database();
$conexion = $db->conectar();

// Asegúrate de que la sesión esté iniciada y que 'document' esté definida
if (isset($_SESSION['document'])) {
    $documento = $_SESSION['document'];

    // Corrige la consulta SQL
    $sql = $conexion->prepare("SELECT * FROM usuarios AS u
        JOIN roles AS r ON u.id_rol = r.id_rol
        WHERE u.documento = :documento");
    $sql->bindParam(":documento", $documento, PDO::PARAM_STR);
    $sql->execute();
    $usua = $sql->fetch();
} else {
    // Manejar el caso en el que la sesión no esté iniciada o 'document' no esté definida
    echo "La sesión no está iniciada o falta 'document'";
    exit(); // Agrega un exit() para detener la ejecución del script en este punto
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Título</title> <!-- Cambia el título a algo descriptivo -->
    <style>
        /* Agrega estilos para el menú de navegación */
        body {
            font-family: Arial, sans-serif;
        }

        nav {
            background-color: #333;
            overflow: hidden;
        }

        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav a:hover {
            background-color: #ddd;
            color: black;
        }
    </style>
</head>
<body>
    <nav>
        <a href="../admin/index.php">Inicio</a>
        <a href="../admin/categoria/index.php">Categoria</a>
        <a href="../admin/embalaje/index.php">Embalaje</a>
        <a href="../admin/genero/index.php">Genero</a>
        <a href="../admin/producto/producto.php">Producto</a>
        <a href="../admin/roles/index.php">Roles</a>
    </nav>

    <h1>Bienvenido</h1>
    <?php
    if (isset($usua)) {
        // Mostrar los datos del usuario
        echo "Administrador " . $usua['nombre'];
        // Agrega más campos de usuario si es necesario
    } else {
        echo "No se pudo encontrar al usuario";
    }
    ?>
</body>
</html>
