<?php
$hostname='localhost';
$database='id19666383_library';
$username='id19666383_libreriadb';
$password='g]zGA@Z*r((~@t4G';

$conexion = new mysqli($hostname, $username, $password, $database);
if ($conexion->connect_errno) {
    echo "Falló la conexión con MySQL: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
}
?>	