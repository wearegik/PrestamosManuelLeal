<html>
<head>
  <title>Gestion de Prestamos Manuel Leal</title>  
  <link rel="stylesheet" href="css/estilos.css">
<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
<script type="text/javascript" src="priceformat.js">
        </script>
        <script type="text/javascript">
                  function miles() {
                $('#valor').priceFormat();
            }
        </script>
</head>
<body>
<form  class="contact_form" action="guardarpago.php" id="contact_form" runat="server" method="post">  
        <div>  
            <ul>  
                <li>  
                    <h2>Digite los datos del abono</h2>  
                    <?php 
                        include("conexion.php");

                        $query_prestamo = 'SELECT Valor, Interes, Cuotas, idcliente,fecha FROM prestamo WHERE idprestamo = '.$_GET['prestamo'].'';
                        $sql_prestamo   = mysql_query($query_prestamo, $conexion);
                        $row_prestamo   = mysql_fetch_array($sql_prestamo);

                        $query_abono = 'SELECT SUM(valor) as valortotal FROM abonos WHERE idprestamo = '.$_GET['prestamo'].'';
                        $sql_abono = mysql_query($query_abono, $conexion);
                        $row_abono = mysql_fetch_array($sql_abono);

                        $query_cliente = 'SELECT * FROM prestamo WHERE idcliente = '.$_GET['prestamo'].'';
                        $sql_cliente = mysql_query($query_cliente, $conexion);
                        $row_cliente = mysql_fetch_array($sql_cliente);


                        
                        $interes         = ($row_prestamo['Interes']/100)*$row_prestamo['Valor'];
                        $cuotas          = $row_prestamo['Cuotas'];      
                        $meses_cuotas    = $row_prestamo['Cuotas']/30;
                        $total_intereses = $interes * $meses_cuotas;
                        $valor_total     = $row_prestamo['Valor'];
                        $total_abono     = $row_abono['valortotal'];
                        $valor_deuda     = ($valor_total+$total_intereses);
                        $debe            = ($valor_total+$total_intereses)-$total_abono;
                        $suma            = ($valor_total+$total_intereses);
                        $valor_cuota     = round($valor_deuda/$cuotas);

                     $id = htmlentities($row_prestamo['idcliente']);

                     $query = 'SELECT * from cliente WHERE idcliente = '.$id.'  LIMIT 1';
                     $sql = mysql_query($query, $conexion);
                     $row = mysql_fetch_array($sql);
                     ?>
                    <h3> Total deuda: <?= '$ '.number_format($valor_deuda); ?></h3>
                    <h3> Valor del Interes <?= '$ '.number_format($total_intereses        ); ?></h3>
                    <h3><?= $row_cliente['Nombres'].' '.$row_cliente['Apellidos']  ?></h3>
                    <h3>Total abonado : <?= '$ '.number_format($row_abono['valortotal']);

                     ?></h3>
                     <h3>Debe: 
                     <?php 
                     
                       

                        echo '$' . number_format($debe);




                     ?></h3>
                     
                     <h3>
                       Valor por cuota: <?php echo '$ '.number_format($valor_cuota); ?>
                     </h3>
                     <h3>
                         Cuotas restantes:

                         <?php 
                     
                        $query_cuota = 'SELECT SUM(cuotas) as cuota FROM abonos WHERE idprestamo = '.$_GET['prestamo'].'';
                        $sql_cuota   = mysql_query($query_cuota, $conexion);
                        $row_cuota   = mysql_fetch_array($sql_cuota);
                        
                        echo $row_prestamo['Cuotas']-$row_cuota['cuota'];

                        

                     ?> 
                     </h3>
                        <h3><?php $date = new DateTime($row_prestamo['fecha']);
                                   echo  "Fecha " . $date->format('Y-m-d')  ?></h3>


                      <h3><?= $row['Nombres'].' '.$row['Apellidos']  ?></h3>


                     

                    <span class="required_notification">* Datos requeridos</span>  
                    <input type="hidden" name="id" value="<?= $_GET['prestamo']; ?>" />
                    <input type="hidden" name="cuo" value="<?= $cuotas; ?>" />
                    <input type="hidden" name="val" value="<?= $valor_cuota; ?>" />


                </li>  


                <li>  
                    <label for="valor">Valor:</label>  
                    <input type="text" name="valor" id="valor" placeholder="Valor del abono" required onkeyup="miles()" />  
                </li>  
                
 
                <li>  
                    <button class="submit" type="submit">Agregar</button>  

                    
                </li>  
            </ul>  
        </div>  
    </form> 

     <h3>Abonos Pagados: </h3><br>
                     
                      <?php
                     $queryf = 'SELECT * from abonos WHERE idprestamo = '.$_GET['prestamo'].'';
                     $sqlf = mysql_query($queryf, $conexion);
                    
                     while ($rowf = mysql_fetch_array($sqlf)) {
                         $date = new DateTime($rowf['fecha']);
                          echo '<div>';
                          echo 'Pagaron el: '. $date->format('Y-m-d').'';
                          echo ' La cantidad de $'.number_format($rowf['valor']) ;
                          echo '</div>' ;

                      } 
                     ?>

    <form  class="contact_form" action="index.html" id="contact_form" runat="server">  
        <div>  
            <ul>  
                <li>  
                    <button class="submit" type="submit">Inicio</button>     
                </li>   
            </ul>  
        </div>  
    </form>   
    <a href="javascript:history.back()" >Regresar</a>
    </body>
    </html>