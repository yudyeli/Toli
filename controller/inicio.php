<?php
require_once("../db/conexion.php");
$db = new Database();
$con = $db->conectar();
session_start();

if (isset($_POST["btn-ingresar"])) {

    // ESTOS DATOS DEL USUARIO VIENEN DEL FORMULARIO Y LA DB
    $email = $_POST['correo_electronico'];
    $contra = $_POST['password'];

    // SE SACA LA HORA EN TIEMPO REAL
    date_default_timezone_set('America/Bogota');
    $fecha_actual = date('Y-m-d');
    $hora_actual = date('H:i:s');

    // SE REALIZA UNA CONSULTA PARA SABER SI LA PERSONA ESTA EN MODO 1 ACTIVO
    $consulta = $con->prepare("SELECT * FROM usuarios WHERE correo_electronico = :email AND id_estado = 1");
    $consulta->execute([':email' => $email]);
    $consul = $consulta->fetch();

    // SE SACA LA VARIANLE SESSION DOCUMENTO DEL USUARIO
    $_SESSION['document'] = $consul['documento'];
    $documento = $_SESSION['document'];

    // SE INSERTAN DATOS A LA TABLA DE INGRESO
    $consulta2 = $con->prepare("SELECT * FROM ingreso INNER JOIN usuarios ON ingreso.documento=usuarios.documento WHERE ingreso.documento= :documento");
    $consulta2->execute([':documento' => $documento]);

    $consulta3 = $con -> prepare ("INSERT INTO ingreso (documento, fecha_ingre, hora_ingre) VALUES ('$documento','$fecha_actual', '$hora_actual')");
    $consulta3->execute();

    /* Set the "cost" parameter to 12. */
    $options = ['cost' => 12];

    if ($consul) {

        if (password_verify($contra, $consul['password'])) {
            /* The password is correct. */

            /* Check if the hash needs to be created again. */
            if (password_needs_rehash($consul['password'], PASSWORD_DEFAULT, $options)) {
                $hash = password_hash($contra, PASSWORD_DEFAULT, $options);

                /* Update the password hash on the database. */
                $query = 'UPDATE usuarios SET password = :passwd WHERE documento = :id';
                $values = [':passwd' => $hash, ':id' => $consul['documento']];

                try {
                    $res = $con->prepare($query);
                    $res->execute($values);
                } catch (PDOException $e) {
                    /* Query error. */
                    echo 'Query error.';
                    die();
                }
            }

            $_SESSION['document'] = $consul['documento'];
            $_SESSION['name'] = $consul['nombre'];
            $_SESSION['email'] = $consul['correo_electronico'];
            $_SESSION['roles'] = $consul['id_rol'];

            $redirectLocation = '';

            switch ($_SESSION['roles']) {
                case 1:
                    $redirectLocation = "../views/models/admin/index-admin.php";
                    break;
                case 2:
                    $redirectLocation = "../views/models/user/index-user.php";
                    break;
                case 3:
                    $redirectLocation = "../views/models/vendedor/index-vende.php";
                    break;
                default:
                    header("Location:../views/auth/error_log.php");
                    exit();
            }

            header("Location: $redirectLocation");
            exit();

        } else {
            // Si el usuario y la clave son incorrectos, actualizamos el contador de intentos fallidos
            $fallos = $consul['fallos'] + 1;

            if ($fallos >= 3) {
                // Si ha superado los 3 intentos fallidos, el estado pasara a inactivo
                $stmt_update_estado = $con->prepare("UPDATE usuarios SET id_estado = 2, fallos = :fallos WHERE documento = :documento");
                $stmt_update_estado->bindParam(":fallos", $fallos, PDO::PARAM_INT);
                $stmt_update_estado->bindParam(":documento", $consul['documento']);
                $stmt_update_estado->execute();

                echo '<script>alert("Realizaste tres intentos fallidos, tu cuenta a pasado a estado inactivo")</script>';
                echo '<script>window.location="../views/auth/error_log.php"</script>';
                echo '<script>alert("Realizaste tres intentos fallidos, tu cuenta a pasado a estado inactivo")</script>';
            } else {
                // Si no ha superado los 3 intentos, actualizamos solo el contador de intentos fallidos
                $stmt_update_intentos = $con->prepare("UPDATE usuarios SET fallos = :fallos WHERE documento = :documento");
                $stmt_update_intentos->bindParam(":fallos", $fallos, PDO::PARAM_INT);
                $stmt_update_intentos->bindParam(":documento", $consul['documento']);
                $stmt_update_intentos->execute();

                // Redireccionamos a la página de inicio con un mensaje de error
                header("Location:../views/auth/error_log.php");
                exit();
            }
        }
    } else {
        header("Location:../views/auth/error_log.php");
        exit();
    }
}
?>
