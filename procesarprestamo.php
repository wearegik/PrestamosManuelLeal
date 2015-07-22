<link rel="stylesheet" href="css/estilos.css">

<?php
include("conexion.php");



 if (isset ($_POST['Valor']) && !empty($_POST['Valor']) &&
     isset ($_POST['Interes']) && ($_POST['Interes']) &&
     isset ($_POST['Cuotas']) && !empty($_POST['Cuotas']) &&
     isset ($_POST['Tiempo']) && !empty($_POST['Tiempo']) &&
     
     isset ($_POST['Nombre']) && !empty($_POST['Nombre']))
     {
       $Valor = str_replace( '.', '' , $_POST['Valor']);

        $conexion = mysql_connect($host, $user, $pw) or die ("Problema al conectar con el host");
        mysql_select_db($bd, $conexion) or die ("Problemas al conectar con la base de datos");
        mysql_query("INSERT INTO prestamo (Valor, Interes, Cuotas, Tiempo, Prestamoya, idcliente, estado)
            VALUES ('$Valor', '$_POST[Interes]', '$_POST[Cuotas]', '$_POST[Tiempo]', '$_POST[Prestamoya]', '$_POST[Nombre]', 0)", $conexion);

        echo "Datos insertados correctamente";
     }  else   {
        echo "Problemas al insertar los datos";
     } 
?>

<br><br>    
  <body>
     <a class="boton" href="index.html" title="Inicio">Inicio</a>
     </body>