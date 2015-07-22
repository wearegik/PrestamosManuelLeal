<link rel="stylesheet" href="css/estilos.css">

<?php
include("conexion.php");
 	if (empty($_POST['nombre']) && empty($_POST['apellido']) && empty($_POST['direccion']) && empty($_POST['email']) && empty($_POST['cedula']))
    {
    	echo "Problemas al insertar los datos";
    }
    else
    {
    	$query = 'UPDATE cliente SET Nombres="'.$_POST['nombre'].'", Apellidos ="'.$_POST['apellido'].'",Cedula ="'.$_POST['cedula'].'", Direccion ="'.$_POST['direccion'].'", Telefono="'.$_POST['telefono'].'", Correo ="'.$_POST['email'].'" WHERE idcliente = '.$_POST['id'].' ';
        $sql = mysql_query($query, $conexion);
        
        echo "Datos insertados correctamente";
        
     } 
?>


<br><br>	
  <body>
     <a class="boton" href="index.html" title="Inicio">Inicio</a>
     </body>