
<html>
<head>
  <title>Gestion de Prestamos Manuel Leal</title>  
  <link rel="stylesheet" href="css/estilos.css">
<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
<script type="text/javascript" src="priceformat.js">
       function miles() {
                $('#Valor').priceFormat();
        </script>
        <script type="text/javascript">
                  function miles() {
                $('#Valor').priceFormat();
            }
        </script>
</head>
<body>
<form  class="contact_form" action="procesarprestamo.php" id="contact_form" runat="server" method="post">  
        <div>  
            <ul>


                <li>  
                    <h2>Prestamo a hacer</h2>  
                    <span class="required_notification">* Datos requeridos</span>  
                </li> 
                <li>  
                    <label for="Prestamoya">Prestamo rapido:</label>  
                    <!-- <input type="text" name="Interes" placeholder="Interes del Prestamo" required />   -->
                    <select name="Prestamoya"> 
                        <option value="0">No</option>
                        <option value="1">Si</option>
                    </select>
                </li>  
                <li>  
                    <label for="Valor">Valor:</label>  
                    <input type="text" name="Valor" id="Valor" placeholder="Valor del Prestamo" required onkeyup="miles()" />  
                </li>  
                <li>  
                    <label for="Interes">Interes:</label>  
                    <!-- <input type="text" name="Interes" placeholder="Interes del Prestamo" required />   -->
                    <select name="Interes"> 
                        <option value ="#">Escoger</option>
                        <option value ="null">0%</option>
                        <option value="3">3%</option>
                        <option value="5">5%</option>
                        <option value="10">10%</option>
                    </select>
                </li> 
                <li>  
                    <label for="Cuotas">Cuotas:</label>  
                    <input type="text" name="Cuotas" placeholder="Cuotas a dividirlo" required />  
                </li>

                <li>  
                    <label for="Tiempo">Tiempo:</label>  
                    <input type="text" name="Tiempo" placeholder="Tiempo a dividirlo" required />    
                </li>  
                <li>  
                    <label for="Nombre">Nombre:</label>  
                    <!-- <input type="text" name="Nombre" placeholder="A quien se hará el prestamo"  />   -->
                    <?php 
                        include("conexion.php");
                        
                        $query = 'SELECT * from cliente ORDER BY Nombres ASC';
                        $sql = mysql_query($query, $conexion);

                        echo  '<select name="Nombre">';
                        
                        while($row = mysql_fetch_array($sql))
                        {
                            echo '<option value="'.$row['idcliente'].'">'.$row['Nombres'].' '.$row['Apellidos'].'</option>';    
                        }
                        echo '</select>';

                    ?>

                </li>  
                 


                <li>  
                    <button class="submit" type="submit">Agregar</button>  

                    
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