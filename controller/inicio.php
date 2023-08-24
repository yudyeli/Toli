<?php 
require_once ("../db/conexion.php"); 
$db = new Database();
$con = $db ->conectar();
session_start();

if ($_POST["inicio"]){
    // inicia sesion para los usuarios

    $doc = $_POST["documento"];
    $contraseña = $_POST["contraseña"];
    // consultemos segun usuarios y clave
    $nexl = $con -> prepare ("SELECT * FROM usuarios WHERE  documento ='$doc'");
    $nexl -> execute();
    $fila = $nexl -> fetch();
    if($fila&&password_verify($contraseña,$fila['password']));


    if ($fila)
    {
        //si el usuario y la clave son correctas creamos las sessiones

        $_SESSION['documento'] = $fila['documento'];
        $_SESSION['contraseña'] = $fila['password'];
        $_SESSION['tipo'] = $fila['id_rol'];

        //dependiendo del tipo de usuario lo redireccionamos

        ///si es un tipo de client
        if ($_SESSION['tipo'] == 1 ){
            header ("Location: ../vist/administrador/index.php");
            exit();
        }
    

        else if ($_SESSION['tipo'] == 2 ){
            header ("Location: ../vist/coach/index.php");
            exit(); 
        }


    }else {
            //si el usuario y la clave son incorrecto lo lleva a la pagina de inicio
            header ("Location: ../errorlog.html" );
            exit();
        }
    
}
?>





