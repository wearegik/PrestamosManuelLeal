<link rel="stylesheet" href="css/estilos.css">

<?php
include("conexion.php");
 if (isset ($_POST['Nombres']) && !empty($_POST['Nombres']) &&
     isset ($_POST['Apellidos']) && !empty($_POST['Apellidos']) &&
     isset ($_POST['Cedula']) && !empty($_POST['Cedula']) &&
     isset ($_POST['Direccion']) && !empty($_POST['Direccion']) &&
     isset ($_POST['Correo']) && !empty($_POST['Correo']) &&
     isset ($_POST['Telefono']) && !empty($_POST['Telefono']))
     {
        $conexion = mysql_connect($host, $user, $pw) or die ("Problema al conectar con el host");
        mysql_select_db($bd, $conexion) or die ("Problemas al conectar con la base de datos");


        $tmp_name = $_FILES['imagen']['tmp_name'];
         if (is_dir('images') && is_uploaded_file($tmp_name))
         {
            $img_file = $_FILES['imagen']['name'];
            $img_type = $_FILES['imagen']['type'];
            if (((strpos($img_type, "gif") || strpos($img_type, "jpeg") || strpos($img_type, "jpg")) || strpos($img_type, "png")))
            {
                //¿Tenemos permisos para subir la imágen?
                if (move_uploaded_file($tmp_name, 'images' . '/' . $img_file))
                {
                    mysql_query("INSERT INTO cliente (Nombres, Apellidos, Cedula, Direccion, Correo, Telefono, foto)
                    VALUES ('$_POST[Nombres]', '$_POST[Apellidos]', '$_POST[Cedula]', '$_POST[Direccion]', '$_POST[Correo]', '$_POST[Telefono]', '$img_file' )", $conexion);

                    echo "Datos insertados correctamente";
                }
            }
         }

        
     }  else   {
        echo "Problemas al insertar los datos";
     }

?>

<br><br>    
  <body>
     <a class="boton" href="index.html" title="Inicio">Inicio</a>
     </body>