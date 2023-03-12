<?php

include("modelo/conectar.php");
$base = Conectar::conexion();

$Id = $_GET["id"];
$base->query("DELETE FROM productos WHERE CODIGOARTICULO='$Id'");
error_log("Error" . $Id);
header("Location:index.php");
?>