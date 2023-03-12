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

$base->query("UPDATE productos SET CODIGOARTICULO = '$Id', SECCION='$Nom', NOMBREARTICULO='$Ape', PRECIO='$Dir', FECHA='$Fec', IMPORTADO='$Imp', PAISDEORIGEN='$Pais' WHERE CODIGOARTICULO='$Id'");
header("Location:index.php");

?>