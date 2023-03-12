<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php

    if( isset($_GET["buscar"]) ) {
        $busqueda = $_GET["buscar"];
    } else {
        echo 'No se ha recibido la búsqueda.<br>Inténtelo de nuevo.';
        exit;
    }

    echo $busqueda;

    try{
        $conexion = new PDO("mysql:host=localhost; dbname=pruebas", "root", "yojuanjo");
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexion->exec("SET CHARACTER SET utf8");

        $Sql="SELECT * FROM productos";

        $resultado=$conexion->prepare($Sql);

		$resultado->execute();

        $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
        //print_r($datos);
        
        foreach( $datos as $registro ) {

            echo "Código de articulo: " . $registro['CODIGOARTICULO'] .
            "Sección: " . $registro['SECCION'] .
            "Nombre de artículo:" . $registro['NOMBREARTICULO'] .
            "Precio: " . $registro['PRECIO'] . 
            "Fecha: " . $registro['FECHA'] . 
            "Importado desde: " . $registro['IMPORTADO'] . 
            "País de origen: " . $registro['PAISDEORIGEN'];
        }
    
    }catch(Exception $e){

        die('Error: ' . $e->GetMessage());

    }finally{

        $conexion=null;
    }
?>

</body>
</html>