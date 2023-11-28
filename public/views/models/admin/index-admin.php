<?php
session_start(); // Iniciar la sesión

require_once("../../../db/conexion.php");
require_once("./menu.php");

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

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
        <div class="container-fluid container-center-center">
            <!-- contenido pagina principal del administrador -->
            <div class="row"> <!-- CONTENIDO PARA USUARIOS -->
                <div class="col-xxl-6 col-lg-6 col-sm-6">
                    <a href="#">
                        <div class="widget-stat card bg-danger">
                            <div class="card-body p-4">
                                <div class="media">
                                    <span class="me-3">
                                        <img src="../../../assets/img/usuarios.jpg" class="la la-users sd-shape"></img>
                                    </span>
                                    <div class="media-body text-white text-end">
                                        <p class="mb-1">Usuarios Registrados</p>
                                        <?php
                                        $conteoUser = "SELECT COUNT(*) AS contadorUser FROM usuarios";
                                        try {
                                            $conteosUser = $conexion->query($conteoUser);
                                            $contadorUser = $conteosUser->fetch(PDO::FETCH_ASSOC)['contadorUser'];

                                            if ($contadorUser) {

                                        ?>
                                                <h3 class="text-white"><?php echo $contadorUser ?></h3>

                                            <?php
                                            } else {
                                            ?>
                                                <h3 class="text-white">0</h3>
                                            <?php
                                            }
                                        } catch (PDOException $e) {

                                            ?>
                                            <h3 class="text-white"><?php $e->getMessage() ?></h3>
                                        <?php
                                        }

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- CONTENIDO PARA VENTAS -->
                <div class="col-xxl-6 col-lg-6 col-sm-6">
                    <a href="#">
                        <div class="widget-stat card bg-danger">
                            <div class="card-body p-4">
                                <div class="media">
                                    <span class="me-3">
                                        <img src="../../../assets/images/anime.png" class="la la-users sd-shape"></img>
                                    </span>
                                    <div class="media-body text-white text-end">
                                        <p class="mb-1">Ventas Realizadas</p>
                                        <?php
                                        $conteoUser = "SELECT COUNT(*) AS contadorUser FROM usuarios";
                                        try {
                                            $conteosUser = $conexion->query($conteoUser);
                                            $contadorUser = $conteosUser->fetch(PDO::FETCH_ASSOC)['contadorUser'];

                                            if ($contadorUser) {

                                        ?>
                                                <h3 class="text-white"><?php echo $contadorUser ?></h3>

                                            <?php
                                            } else {
                                            ?>
                                                <h3 class="text-white">0</h3>
                                            <?php
                                            }
                                        } catch (PDOException $e) {

                                            ?>
                                            <h3 class="text-white"><?php $e->getMessage() ?></h3>
                                        <?php
                                        }

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </a>
                </div>
                <!-- CONTENIDO PARA PRODUCTOS -->
                <div class="col-xxl-6 col-lg-6 col-sm-6">
                    <a href="./listaWeapons.php">
                        <div class="widget-stat card bg-danger">
                            <div class="card-body p-4">
                                <div class="media">
                                    <span class="me-3">
                                        <img src="../../../assets/img/img_produc/Productos-agricolas.png" class="la la-users sd-shape"></img>

                                    </span>
                                    <div class="media-body text-white text-end">
                                        <p class="mb-1">Cantidad de productos</p>
                                        <?php
                                        $conteoproductos = "SELECT COUNT(*) AS contadorproductos FROM productos";
                                        try {
                                            $conteoproductos = $conexion->query($conteoproductos);
                                            $contadorproductos = $conteoproductos->fetch(PDO::FETCH_ASSOC)['contadorproductos'];

                                            if ($contadorproductos) {

                                        ?>
                                                <h3 class="text-white"><?php echo $contadorproductos ?></h3>

                                            <?php
                                            } else {
                                            ?>
                                                <h3 class="text-white">0</h3>
                                            <?php
                                            }
                                        } catch (PDOException $e) {

                                            ?>
                                            <h3 class="text-white"><?php $e->getMessage() ?></h3>
                                        <?php
                                        }

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- CONTENIDO PARA EMBALAJE -->
                <div class="col-xxl-6 col-lg-6 col-sm-6">
                    <a href="./listaWorlds.php">
                        <div class="widget-stat card bg-danger">
                            <div class="card-body p-4">
                                <div class="media">
                                    <span class="me-3">
                                        <img src="../../../assets/images/hero-banner.png" class="la la-users sd-shape"></img>

                                    </span>
                                    <div class="media-body text-white text-end">
                                        <p class="mb-1">Embalajes Registrados</p>
                                        <?php
                                        $conteoEmbala = "SELECT COUNT(*) AS contadorEmbala FROM embalaje";
                                        try {
                                            $conteoEmbala = $conexion->query($conteoEmbala);
                                            $contadorEmbala = $conteoEmbala->fetch(PDO::FETCH_ASSOC)['contadorEmbala'];

                                            if ($contadorEmbala) {

                                        ?>
                                                <h3 class="text-white"><?php echo $contadorEmbala ?></h3>

                                            <?php
                                            } else {
                                            ?>
                                                <h3 class="text-white">0</h3>
                                            <?php
                                            }
                                        } catch (PDOException $e) {

                                            ?>
                                            <h3 class="text-white"><?php $e->getMessage() ?></h3>
                                        <?php
                                        }

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body container-table">
        <div class="container-fluid">

            <div class="row page-titles">
                <ol class="breadcrumb">
                    <!-- <li class="breadcrumb-item active"><a href="javascript:void(0)">Estadisticas</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Actividad Jugadores</a></li> -->
                </ol>
            </div>
            <!-- row -->


            <!-- <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Actividad</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>Tipo de documento</th>
                                            <th>Documento</th>
                                            <th>Nombres</th>
                                            <th>Rol</th>
                                            <th>Correo</th>
                                            <th>Entrada</th>


                                        </tr>
                                    </thead> -->
                                    <tbody>
                                        <?php foreach ($entry as $entrada) { ?>
                                            <!-- <tr>
                                                <td><?= $entrada["tipoDocumento"] ?></td>
                                                <td><?= $entrada["documento"] ?></td>
                                                <td><?= $entrada["nombreCompleto"] ?></td>
                                                <td><?= $entrada["rol"] ?></td>
                                                <td><?= $entrada["correoElectronico"] ?></td>
                                                <td><?= $entrada["horario_entrada"] ?></td>

                                            </tr> -->

                                        <?php
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>


<?php
// require_once 'footer.php';
?>