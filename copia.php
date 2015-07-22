<link rel="stylesheet" href="css/estilos.css">

<?php
// variables
$dbhost = 'localhost';
$dbname = 'prestamos';
$dbuser = 'root';
$dbpass = '';
 
$backup_file = $dbname . date("Y-m-d-H-i-s") . '.gz';
 
// comandos a ejecutar
$command = "c:/xampp/mysql/bin/mysqldump -u root --password= --opt prestamos > respaldo.sql";
 
// ejecución y salida de éxito o errores
system($command,$output);
echo $output;
?>

<br><br>    
  <body>
     <a class="boton" href="index.html" title="Inicio">Inicio</a>
     </body>