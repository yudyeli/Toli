<?php
//Archivo que permite validar la sesion

if(!isset($_SESSION['documento']) || !isset($_SESSION['contraseña']))
{
    header("location:../../index.php");
    exit;
}
?>