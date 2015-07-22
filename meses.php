<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
	<form action="" method="get">
		<select name="meses" id="meses" onchange="submit()">
			<option value="0">Seleccione un mes</option>
			<option value="01">Enero</option>
			<option value="02">Febrero</option>
			<option value="03">Marzo</option>
			<option value="04">Abril</option>
			<option value="05">Mayo</option>
			<option value="06">Junio</option>
			<option value="07">Julio</option>
			<option value="08">Agosto</option>
			<option value="09">Septiembre</option>
			<option value="10">Octubre</option>
			<option value="11">Noviembre</option>
			<option value="12">Diciembre</option>
			<option value="13">Todos</option>
		</select>
	</form>

	

	<?php 

if (isset($_GET['meses']))
{
	$valor = $_GET['meses'];
	$datos = array();



	if ($valor=='01'){
		$txtmes = 'Enero';
	}elseif ($valor=='02') {
		$txtmes = 'Febrero';
	}elseif ($valor=='03') {
		$txtmes = 'Marzo';
	}elseif ($valor=='04') {
		$txtmes = 'Abril';
	}elseif ($valor=='05') {
		$txtmes = 'Mayo';
	}elseif ($valor=='06') {
		$txtmes = 'Junio';
	}elseif ($valor=='07') {
		$txtmes = 'Julio';
	}elseif ($valor=='08') {
		$txtmes = 'Agosto';
	}elseif ($valor=='09') {
		$txtmes = 'Septiembre';
	}elseif ($valor=='10') {
		$txtmes = 'Octubre';
	}elseif ($valor=='11') {
		$txtmes = 'Noviembre';
	}elseif ($valor=='12') {
		$txtmes = 'Diciembre';
	}elseif ($valor=='13') {
		$txtmes = 'Todos';
	}



	if ($valor!=0)
	{
		include("conexion.php");
		
		$query = 'SELECT prestamo.idprestamo as idprestamo, prestamo.Valor as valorprestamo, prestamo.fecha as fechaprestamo, prestamo.Prestamoya , cliente.Nombres, cliente.Apellidos, prestamo.Tiempo as tiempoprestamo, prestamo.Interes from prestamo JOIN cliente ON prestamo.idcliente = cliente.idcliente WHERE Prestamoya = 1 AND estado = 0 ';
		//$query = 'SELECT * from prestamo JOIN cliente ON prestamo.idcliente = cliente.idcliente LEFT JOIN abonos ON abonos.idprestamo = prestamo.idprestamo WHERE Prestamoya = 1 ';
		//$query = 'SELECT * from prestamo JOIN cliente ON prestamo.idcliente = cliente.idcliente';
    	$sql = mysql_query($query, $conexion);

    	

    	while ($row = mysql_fetch_array($sql))
    	{
    		$mes = explode('-', $row['fechaprestamo']);
    		if ($valor == '13')
      {
       $datos[]=$row;
      }
      elseif ($mes[1] + ($row['tiempoprestamo'] / 30) == $valor)
      {
       $datos[]=$row;
      }
 

    	}
    		echo '<h3>Prestamos rápidos creados en  '.$txtmes.'</h3>';
    		echo '<hr/>';	

    		echo '
    		<ul class="tabla">
				<li>Cliente</li>
				<li>Valor</li>
				<li>Cuotas</li>
				<li>Sum Abonos</li>
				<li style="width:300px;">Fecha Abonos y Valor</li>
				<li>Saldo</li>
				
				
    		</ul>';

    		foreach ($datos as $key => $value)

    			
    			
    		{

    			$query2 = 'SELECT sum(valor) as sumaabono  from abonos WHERE idprestamo = '.$value['idprestamo'] ;
    		    $sql2 = mysql_query($query2, $conexion);
    		    $row2 = mysql_fetch_array($sql2);

    		   //$sumaabono = 'SELECT a.idprestamo, SUM(a.valor) as totalabonos, (p.Valor - sum(a.valor)) as restante FROM abonos a INNER JOIN prestamo p on a.idprestamo = p.idprestamo GROUP BY a.idprestamo';
    		   //$sqlsumaabono = mysql_query($sumaabono, $conexion);
    		   //$rowsumaabono = mysql_fetch_array($sqlsumaabono);

    		    $consultatotal = 'SELECT * from consulta_prestamos_activos';
    		    $sqltotal = mysql_query($consultatotal, $conexion);
    		    $rowtotal = mysql_fetch_array($sqltotal);

                $valuefinal = $value['fechaprestamo'];
    			$nuevafecha = strtotime ( '+'.$value['tiempoprestamo'].'  day' , strtotime ( $valuefinal ) ) ;
                $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
                //$debe = $value['Valor']- $value['valor'];
    		    $debeint = $value['valorprestamo']*($value['Interes']/100 * $value['tiempoprestamo']/30 );
    		    $debetot = $debeint + $value['valorprestamo'] ;

    		    $queryf = 'SELECT * from abonos WHERE idprestamo = '.$value['idprestamo'].'';
                $sqlf = mysql_query($queryf, $conexion);
                echo '<ul class="tabla">';
                while ($rowt = mysql_fetch_array($sqltotal)) {
                	

    			echo '<li>'.$rowt['Nombres'].'</li>';
    			echo '<li>'.number_format($rowtotal['prestamo']).'</li>';
				//echo '<li>'.$nuevafecha.'</li>';
				//echo '<li>'.date("Y-m-j",strtotime($value['fechaprestamo'])).'</li>';
    			echo '<li>'.$rowt['Cuotas'].'</li>';
    			echo '<li>'.number_format($rowt['totalabonos']).'</li>';
    			echo '<li style="margin-left:20px ; width:300px;">' ;
                }

    			

    			?>

    			<?php

    			echo '<select>';

    			while ($rowf = mysql_fetch_array($sqlf)) {
  
    				
                          echo '<option value="precio"> El '.date("j-m-Y", strtotime($rowf['fecha'])).' pagaron $'.number_format($rowf['valor']). '</option>';
                          
    				
    			}

    			echo '</select>' ;

    			?>

    			<?php

    			echo '<li>'.number_format($rowt['restante']).'</li>'; 
    			
    			echo '</ul>';

    			
    		}
	}
}
?>


 <center><a class="boton" href="index.html" title="Inicio">Inicio</a></center>
</body>
</html>