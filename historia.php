<link rel="stylesheet" href="css/estilos.css">

<?php

include("conexion.php");

//TOTAL PRESTADO PRESTAMOS NORMALES

$q_prestado = 'SELECT SUM(Valor) as suma_total FROM prestamo WHERE Prestamoya = 0';
$s_prestado = mysql_query($q_prestado, $conexion);
$r_prestado = mysql_fetch_array($s_prestado);

//TOTAL PRESTADO PRESTAMOS RAPIDOS

$q_prestador = 'SELECT SUM(Valor) as suma_total FROM prestamo WHERE Prestamoya = 1';
$s_prestador = mysql_query($q_prestador, $conexion);
$r_prestador = mysql_fetch_array($s_prestador);

//CUANTO ME HAN ABONADO EN PRESTAMOS NORMALES
$q_abono = 'SELECT SUM(a.valor) as suma_total FROM abonos a inner join prestamo p on a.idprestamo = p.idprestamo WHERE a.cuotas > 1 and p.Prestamoya = 0';
$s_abono = mysql_query($q_abono, $conexion);
$r_abono = mysql_fetch_array($s_abono);

//CUANTO ME HAN ABONADO EN PRESTAMOS RAPIDOS
$q_abonor = 'SELECT SUM(abonos.valor) as suma_total FROM abonos JOIN prestamo ON abonos.idprestamo = prestamo.idprestamo WHERE prestamo.Prestamoya = 1';
$s_abonor = mysql_query($q_abonor, $conexion);
$r_abonor = mysql_fetch_array($s_abonor);

//CUANTO ME DEBEN EN PRESTAMOS NORMALES
$deben         = ($r_prestado['suma_total']) - $r_abono['suma_total'];
$debenr         = ($r_prestador['suma_total']) - $r_abonor['suma_total'];

//INTERESES PRESTAMOS NORMALES

$q_interes = 'SELECT SUM(Valor*Interes/100*Cuotas/30) as suma_total FROM prestamo WHERE Prestamoya = 0';
$s_interes = mysql_query($q_interes, $conexion);
$r_interes = mysql_fetch_array($s_interes);

//INTERESES PRESTAMOS RAPIDOS

$q_interesr = 'SELECT SUM(Valor*Interes/100) as suma_totalr FROM prestamo WHERE Prestamoya = 1';
$s_interesr = mysql_query($q_interesr, $conexion);
$r_interesr = mysql_fetch_array($s_interesr);

// TIEMPO

$q_tiempo = 'SELECT SUM(Cuotas/30) as tiempo FROM prestamo WHERE Prestamoya = 0' ;
$s_tiempo = mysql_query($q_tiempo, $conexion);
$r_tiempo = mysql_fetch_array($s_tiempo);


//INTERESES PRESTAMOS RAPIDOS

$q_interesr = 'SELECT SUM(Valor*Interes/100*Cuotas/30) as suma_totalr FROM prestamo WHERE Prestamoya = 1';
$s_interesr = mysql_query($q_interesr, $conexion);
$r_interesr = mysql_fetch_array($s_interesr);

?>

  <body>
  <div class="izquierda">
  <strong>Prestamos Normales </strong> <br>
  Dinero prestado en total: <?php   echo ' $'. number_format($r_prestado['suma_total']). ''   ?><br>
  Intereses en Total: <?php  echo number_format($r_interes['suma_total'] )     ?><br>
  Cuanto me han abonado: <?php   echo ' $'. number_format($r_abono['suma_total']). ''   ?> <br> 
  Cuanto me deben en total: <?php   

if ($deben>0) {
	echo  number_format($r_prestado['suma_total']+ $r_interes['suma_total']- $r_abono['suma_total']);
    }
	else {
	echo '0';
}
    

  ?>
</div>
  <br>
<div class="derecha">
  <strong>Prestamos rapidos </strong><br>
  Dinero prestado en total: <?php   echo ' $'. number_format($r_prestador['suma_total']). ''   ?><br>
  Intereses en Total: <?php  echo number_format($r_interesr['suma_totalr'])    ?><br>
  Cuanto me han abonado:  <?php   echo ' $'. number_format($r_abonor['suma_total']). ''   ?> <br>
  Cuanto me deben en total: <?php   if ($debenr>0) {
	echo  number_format($r_prestador['suma_total']+ $r_interesr['suma_totalr']- $r_abonor['suma_total']);
    }
	else {
	echo '0';
}  ?>
  </div>
     <center><a class="boton" href="index.html" title="Inicio">Inicio</a></center>
     </body>








