<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<link rel="stylesheet" type="text/css" href="hoja.css">
</head>

<body>

<h1>ACTUALIZAR</h1>

<?php

include("modelo/conectar.php");

$codigoArticulo=$_GET["CODIGOARTICULO"];
$seccion=$_GET["SECCION"];
$nombreArtículo=$_GET["NOMBREARTICULO"];
$precio=$_GET["PRECIO"];
$fecha=$_GET["FECHA"];
$importado=$_GET["IMPORTADO"];
$paisDeOrigen=$_GET["PAISDEORIGEN"];

?>

<p>&nbsp;</p>

<p>&nbsp;</p>
<form name="form1" method="get" action="actualizar.php">
  <table width="25%" border="0" align="center">
    <tr>
      <td>Código de artículo</td>
      <td><label for="Id"></label>
      <input type="text" name="id" id="id" value="<?php echo $codigoArticulo; ?>"></td>
    </tr>
    <tr>
      <td>Sección</td>
      <td><label for="Nom"></label>
      <input type="text" name="Nombre" id="nom" value="<?php echo $seccion; ?>"></td>
    </tr>
    <tr>
      <td>Nombre de artículo</td>
      <td><label for="Ape"></label>
      <input type="text" name="Apellido" id="ape" value="<?php echo $nombreArtículo; ?>"></td>
    </tr>
    <tr>
      <td>Precio</td>
      <td><label for="Dir"></label>
      <input type="text" name="Direccion" id="pre" value="<?php echo $precio; ?>"></td>
    </tr>
    <tr>
      <td>Fecha</td>
      <td><label for="Fec"></label>
      <input type="text" name="Direccion" id="fec"  value="<?php echo $fecha; ?>"></td>
    </tr>
    <tr>
      <td>Importado</td>
      <td><label for="Imp"></label>
      <input type="text" name="Direccion" id="imp"  value="<?php echo $importado; ?>"></td>
    </tr>
    <tr>
      <td>País de origen</td>
      <td><label for="Pais"></label>
      <input type="text" name="Direccion" id="pdo"></td  value="<?php echo $paisDeOrigen; ?>">
    </tr>
    <tr>
      <td colspan="2"><input type="submit" name="bot_actualizar" id="bot_actualizar" value="Actualizar"></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>