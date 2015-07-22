<html>
<head>
  <title>Gestion de Prestamos Manuel Leal</title>  
  <link rel="stylesheet" href="css/estilos.css">
<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
</head>
<body>
<form  class="contact_form" action="procesarabono.php" id="contact_form" runat="server">  
        <div>  
            <ul>  
                <li>  
                    <h2>Busqueda de Cliente</h2>  
                    <span class="required_notification">* Datos requeridos</span>  
                </li>  
                <li>  
                    <label for="name">Nombres y Apellidos:</label>  
                    <?php 
                        include("conexion.php");
                        
                        $query = 'SELECT * from cliente ORDER BY Nombres ASC';
                        $sql = mysql_query($query, $conexion);

                        echo  '<select name="idsearch">';
                        
                        while($row = mysql_fetch_array($sql))
                        {
                            echo '<option value="'.$row['idcliente'].'">'.$row['Nombres'].' '.$row['Apellidos'].' </option>';    
                        }
                        echo '</select>';

                    ?>
                </li>  
              
                 
                <li>  
                    <button class="submit" type="submit">Buscar</button>  

                    
                </li>  
            </ul>  
        </div>  
    </form> 
    <a href="javascript:history.back()">Regresar</a>
    </body>
    </html>