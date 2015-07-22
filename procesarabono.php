<?php 
    include("conexion.php");
    
    $id = htmlentities($_GET['idsearch']);

    $query = 'SELECT * from cliente WHERE idcliente = '.$id.'  LIMIT 1';
    $sql = mysql_query($query, $conexion);
    $row = mysql_fetch_array($sql);



    $query_prestamos = 'SELECT * from prestamo WHERE idcliente = '.$id.' AND estado = 0';
    $sql_prestamos   = mysql_query($query_prestamos, $conexion);

?>

<html>
<head>
  <title>Gestion de Prestamos Manuel Leal</title>  
  <link rel="stylesheet" href="css/estilos.css">
<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
</head>
<body>

<form  class="contact_form" action="procesarpago.php" id="contact_form" runat="server">  
        <div>  
            <ul>  
                <li>  
                    <h2>Abono de prestamo  clientes</h2>  
                     <h3><?= $row['Nombres'].' '.$row['Apellidos']  ?></h3>
                </li>  
              
                <li>  
                    <label for="apellido">Seleccione el Prestamo:</label>  
                    <?php 
                        echo  '<select name="prestamo">';
                        
                        while($row_prestamos = mysql_fetch_array($sql_prestamos))
                        {
                            if ($row_prestamos['Prestamoya']== 1) {
                                $algo = 'Prestamo Rapido';
                            } else {
                                $algo = 'Prestamo Normal';
                            }


                            echo '<option value="'.$row_prestamos['idprestamo'].'">$'.number_format($row_prestamos['Valor']).' - '.$row_prestamos['fecha']. ' - '.$algo.'</option>';
                            if ($row_prestamos['Prestamoya=1']) {
                                echo 'Prestamo Rapido' ;
                            }    

                            else {
                                echo 'Prestamo Normal';
                            }
                        }
                        
                        echo '</select>';

                     ?>
                </li> 
              
                  <li>  
                    <button class="submit" type="submit">Procesar</button>  

                    
                </li>  
                
            </ul>  
        </div>  
   
</form>

    

    <form  class="contact_form" action="index.html" id="contact_form" runat="server">  
        <div>  
            <ul>  
                <li>  
                    <button class="submit" type="submit">Inicio</button>     
                </li>   
            </ul>  
        </div>  
    </form>   
    <a href="javascript:history.back()">Regresar</a>
    </body>
    </html>