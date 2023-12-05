<?php
function conectar(){
    $user="root";
    $pass="";
    $server="localhost";
    $bd="air";
    $con=mysqli_connect($server,$user,$pass,$bd) or die("no hay conexion a la base de datos");

    return $con;
}
?>