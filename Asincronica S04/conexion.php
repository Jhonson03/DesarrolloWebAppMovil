<?php
$servidor = "localhost";
$usuario = "root"; 
$contrasena = "";
$baseDatos = "cafeteria";

$conn = new mysqli($servidor, $usuario, $contrasena, $baseDatos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
