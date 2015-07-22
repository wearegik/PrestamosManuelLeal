<html>

<link rel="stylesheet" href="css/estilos.css">

<?php

include("conexion.php");

$fechas = 'SELECT fecha FROM prestamo WHERE Prestamoya = 1' ;
$s_fechas = mysql_query($fechas, $conexion);
$r_fechas = mysql_fetch_array($s_fechas);

while ($dato=mysql_fetch_array($s_fechas)) {
	
}
?>

<body>
<center><h1>Todos los prestamos rapidos</h1></center>
<?php 
echo $fechas;

?>

<center><a class="boton" href="index.html" title="Inicio">Inicio</a></center>
</body>
</html>