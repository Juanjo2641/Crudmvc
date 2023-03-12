<?php

include("modelo/conectar.php");
$base = Conectar::conexion();



$Id=$_GET["CODIGOARTICULO"];
$Nom=$_GET["SECCION"];
$Ape=$_GET["NOMBREARTICULO"];
$Dir=$_GET["PRECIO"];
$Fec=$_GET["FECHA"];
$Imp=$_GET["IMPORTADO"];
$Pais=$_GET["PAISDEORIGEN"];



error_log("ESTO NO FUNCIONA" . $Id . "" . $Nom . "   " . $Ape . "   " . $Dir);
$base->query("INSERT INTO productos (CODIGOARTICULO,SECCION,NOMBREARTICULO,PRECIO, FECHA, IMPORTADO, PAISDEORIGEN) VALUES ('$Id','$Nom', '$Ape', '$Dir', '$Fec', '$Imp', '$Pais')");
header("Location:index.php");

?>