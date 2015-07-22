<?php
$host = "localhost";
$user = "root";
$pw   = "";
$bd   = "prestamos";
$conexion = mysql_connect($host, $user, $pw) or die ("Problema al conectar con el host");
mysql_select_db($bd, $conexion) or die ("Problemas al conectar con la base de datos");

?>