<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
	<link rel="stylesheet" type="text/css" href="hoja.css">
	<style>
		td{
			border: 1px dotted red;
	
		}
		#titulo{
			font-weight: bold;
			color: blue;	
			text-align: center;
		}
	</style>
</head>

<body>
<header>
     <form action="" method="get">
        <label>Buscar: <input type="text" name="buscar"></label>
        <button type="submit" >Aceptar</button>
      </form>

  </header>
  <?php
  include("modelo/paginacion.php");


//----------Paginación------------------------

$registros_por_pagina=5; /* CON ESTA VARIABLE INDICAREMOS EL NUMERO DE REGISTROS QUE QUEREMOS POR PAGINA*/
		$estoy_en_pagina=1;/* CON ESTA VARIABLE INDICAREMOS la pagina en la que estamos*/
		
			if (isset($_GET["pagina"])){
				$estoy_en_pagina=$_GET["pagina"];				
			}
		
		$empezar_desde=($estoy_en_pagina-1)*$registros_por_pagina;
		
		$sql_total="SELECT * FROM productos" ;
/* CON LIMIT 0,3 HACE LA SELECCION DE LOS 3 REGISTROS QUE HAY EMPEZANDO DESDE EL REGISTRO 0*/
		$resultado=$base->prepare($sql_total);
		$resultado->execute(array());
		
		$num_filas=$resultado->rowCount(); /* nos dice el numero de registros del reusulset*/
		$total_paginas=ceil($num_filas/$registros_por_pagina); /* FUNCION CEIL REDONDEA EL RESULTADO*/

//-------------------------------------------

/**
 * Búsqueda
 */

// Si recibimos una búsqueda
if ( isset($_GET["buscar"]) ){
 $sql_variables[':BUSCAR'] = '%'.$_GET["buscar"].'%';

 // Se hace una primera consulta para saber todos los registros para la paginación
 $sql = '
   SELECT * FROM productos
   WHERE
     CODIGOARTICULO LIKE :BUSCAR OR
     SECCION LIKE :BUSCAR OR
     NOMBREARTICULO LIKE :BUSCAR OR
     PRECIO LIKE :BUSCAR OR
     FECHA LIKE :BUSCAR OR
     IMPORTADO LIKE :BUSCAR OR
     PAISDEORIGEN LIKE :BUSCAR
 ';
 $resultado=$base->prepare($sql);
 $resultado->execute($sql_variables);
 $num_filas=$resultado->rowCount();
 
 // Se hace la consulta a mostrar con los datos ya limitados según la página
 $sql = "
   SELECT * FROM productos
   WHERE
     CODIGOARTICULO LIKE :BUSCAR OR
     SECCION LIKE :BUSCAR OR
     NOMBREARTICULO LIKE :BUSCAR OR
     PRECIO LIKE :BUSCAR OR
     FECHA LIKE :BUSCAR OR
     IMPORTADO LIKE :BUSCAR OR
     PAISDEORIGEN LIKE :BUSCAR
   LIMIT $empezar_desde,$registros_por_pagina
   ";
 $resultado=$base->prepare($sql);
 $resultado->execute($sql_variables);
 $registros = $resultado->fetchAll(PDO::FETCH_ASSOC);

} else {
 // Si no recibimos búsqueda
 $sql = "
   SELECT * FROM productos";
   $resultado=$base->prepare($sql);
 $resultado->execute();
 $num_filas=$resultado->rowCount();
 
 $sql = "
   SELECT * FROM productos
   LIMIT $empezar_desde,$registros_por_pagina
 ";
 $resultado=$base->prepare($sql);
 $resultado->execute();
 $registros = $resultado->fetchAll(PDO::FETCH_ASSOC);
}


// contamos los registros para la paginación
/* nos dice el numero de registros del reusulset*/
$total_paginas=ceil($num_filas/$registros_por_pagina); /* FUNCION CEIL REDONDEA EL RESULTADO*/



/* Fin búsqueda */

  $conexion=$base->query("SELECT * FROM productos LIMIT $empezar_desde,$registros_por_pagina");
  $registros=$conexion->fetchAll(PDO::FETCH_OBJ);
  $listaproductos;
  $producto;
?>

  <main>
  <table width="50%" border="0" align="center">
    <tr >
      <td class="primera_fila">CODIGOARTICULO</td>
      <td class="primera_fila">SECCION</td>
      <td class="primera_fila">NOMBRE</td>
      <td class="primera_fila">PRECIO</td>
      <td class="primera_fila">FECHA</td>
      <td class="primera_fila">IMPORTADO</td>
      <td class="primera_fila">PAISDEORIGEN</td>
    </tr> 
  
    <?php
      foreach($matrizProductos as $producto):
    ?>

		
   	<tr>
      <td><?php echo $producto['CODIGOARTICULO']?> </td>
      <td><?php echo $producto['SECCION']?></td>
      <td><?php echo $producto['NOMBREARTICULO']?></td>
      <td><?php echo $producto['PRECIO']?></td>
      <td><?php echo $producto['FECHA']?></td>
      <td><?php echo $producto['IMPORTADO']?></td>
      <td><?php echo $producto['PAISDEORIGEN']?></td>

 
      <td class="bot">
        <a href="borrar.php?id=<?php echo $producto['CODIGOARTICULO']?>">
        <input type='button' name='del' id='del' value='Borrar'></a></td>

      <td class='bot'>
        <a href="editarInicial.php?CODIGOARTICULO=<?php echo $producto['CODIGOARTICULO']?> & SECCION=<?php echo $producto['SECCION']?> & NOMBREARTICULO=<?php echo $producto['NOMBREARTICULO']?> & PRECIO=<?php echo $producto['PRECIO']?> & FECHA=<?php echo $producto['FECHA']?> & IMPORTADO=<?php echo $producto['IMPORTADO']?> & PAISDEORIGEN=<?php echo $producto['PAISDEORIGEN']?> ">
        <input type='button' name='up' id='up' value='Actualizar'></a></td>
    </tr>
    
    <?php
      endforeach;
    ?>

	<tr>
      <form method="get" action="insertar.php">
        <td><input type='text' name='CODIGOARTICULO' size='10' class='centrado'></td>
        <td><input type='text' name='SECCION' size='10' class='centrado'></td>
        <td><input type='text' name='NOMBREARTICULO' size='10' class='centrado'></td>
        <td><input type='text' name='PRECIO' size='10' class='centrado'></td>
        <td><input type='text' name='FECHA' size='10' class='centrado'></td>
        <td><input type='text' name='IMPORTADO' size='10' class='centrado'></td>
        <td><input type='text' name='PAISDEORIGEN' size='10' class='centrado'></td>
        <td class='bot'><input type='submit' name='cr' id='cr' value='Insertar'></td></tr>    
      </form>
  </table>
  <div id="paginacion">
  <?php

  for ($i=1; $i<=$total_paginas; $i++){

    
    if ( isset($_GET["buscar"]) ) {
      $buscar = $_GET["buscar"];
      if( $i == $estoy_en_pagina ) {
        echo "<a class='activa' href='index.php?buscar=$buscar&pagina=$i'>$i</a>";
      } else {
        echo "<a href='index.php?buscar=$buscar&pagina=$i'>$i</a>";
      }
  
    } else {
    
      if( $i == $estoy_en_pagina ) {
        echo "<a class='activa' href='index.php?pagina=$i'>$i</a>";
      } else {
        echo "<a href='index.php?pagina=$i'>$i</a>";
      }
    }
  }

?>
</table>
	
</body>
</html>