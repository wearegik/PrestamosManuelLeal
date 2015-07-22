<link rel="stylesheet" href="css/estilos.css">

<?php
include("conexion.php");
 if (isset ($_POST['valor']) && !empty($_POST['valor']))
     {


        $cuotas = $_POST['val'];
        $valor = str_replace( '.', '' , $_POST['valor']);

        $suma_cuotas = $valor/$cuotas;


        $query = 'INSERT INTO abonos (idprestamo, valor, cuotas) VALUES('.$_POST['id'].','.$valor.','.$suma_cuotas.')';
        $sql = mysql_query($query, $conexion);


        $query_abono = 'SELECT SUM(valor) as valortotal FROM abonos WHERE idprestamo = '.$_POST['id'].'';
        $sql_abono = mysql_query($query_abono, $conexion);
        $row_abono = mysql_fetch_array($sql_abono);

       

        $query_prestamo = 'SELECT Valor, Interes FROM prestamo WHERE idprestamo = '.$_POST['id'].'';
        $sql_prestamo   = mysql_query($query_prestamo, $conexion);
        $row_prestamo   = mysql_fetch_array($sql_prestamo);

        if ( $row_abono['valortotal'] >= ($row_prestamo['Valor']))
        {
        	$query_pago = 'UPDATE prestamo SET estado="1" WHERE idprestamo = '.$_POST['id'];
       	 	$sql_pago = mysql_query($query_pago, $conexion);
        }
    

        echo "Datos insertados correctamente";
    }
    else {
        echo "Problemas al insertar los datos";
     } 
?>


<br><br>    
  <body>
     <a class="boton" href="index.html" title="Inicio">Inicio</a>
     </body>