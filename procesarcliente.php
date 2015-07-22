<?php 
    include("conexion.php");
    
    $id = htmlentities($_GET['idsearch']);

    $query = 'SELECT * from cliente WHERE idcliente = '.$id.'  LIMIT 1';
    $sql = mysql_query($query, $conexion);
    $row = mysql_fetch_array($sql);


    $query_prestamos = 'SELECT * from prestamo WHERE idcliente = '.$id.' AND estado = 0 ORDER BY fecha DESC';
    $sql_prestamos   = mysql_query($query_prestamos, $conexion);
?>

<html>
<head>
  <title>Gestion de Prestamos</title>  
  <link rel="stylesheet" href="css/estilos.css">
<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
</head>
<body>
<form  class="contact_form" action="guardarcliente.php" id="contact_form" runat="server" method="post">  
        <div>  
            <ul>  
                <li>  
                    <h2>Actualizar de Clientes</h2>  
                    <input type="hidden" name="id" value="<?= $id ?>" />   
                </li>  
                <li>  
                    <label for="name">Nombres:</label>
                    <input type="text" name="nombre" value="<?= $row['Nombres']; ?>" />  
                </li>

                <li>  
                    <label for="apellido">Apellidos:</label>  
                    <input type="text" name="apellido" value="<?= $row['Apellidos']; ?>"   />  
                </li> 
                
                <li>  
                    <label for="direccion">Dirección:</label>  
                    <input type="text" name="direccion" value="<?= $row['Direccion']; ?>"   />  
                </li>

                <li>  
                    <label for="direccion">Telefono:</label>  
                    <input type="text" name="telefono" value="<?= $row['Telefono']; ?>"   />  
                </li>

                <li>  
                    <label for="email">Email:</label>  
                    <input type="email" name="email" value="<?= $row['Correo']; ?>"   />  
                </li>  

                <li>  
                    <label for="cedula">Cedula:</label>  
                    <input type="text" name="cedula" value="<?= $row['Cedula']; ?>"    />  
                </li>  
                 
                <li>  
                    <button class="submit" type="submit">Agregar</button>  
                </li>  
                
            </ul>  
        </div>  
    </form> 



    <form  class="contact_form" action="modificarabono.php" id="contact_form" runat="server"> 
    <label>Seleccione el prestamo</label>
        <?php 
 
            $query = 'SELECT * from prestamo WHERE idcliente =  '.$id.' AND estado = 0  ORDER BY estado, Fecha DESC';
            $sql = mysql_query($query, $conexion);

            echo  '<select name="id">';
            
            while($row = mysql_fetch_array($sql))
            {

                 if ($row['Prestamoya']== 1) {
                                $algo = 'Prestamo Rapido';
                            } else {
                                $algo = 'Prestamo Normal';
                            }
                echo '<option value="'.$row['idprestamo'].'">$'.number_format($row['Valor']).' - '.$row['fecha']. ' - '.$algo.'</option>';
                            if ($row['Prestamoya=1']) {
                                echo 'Prestamo Rapido' ;
                            }    

                            else {
                                echo 'Prestamo Normal';
                            }
                        }
            echo '</select>';

        ?>

        <button>Modificar</button>  

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