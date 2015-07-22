<?php 
    include("conexion.php");
    
    $id = htmlentities($_GET['idsearch']);

    $query = 'SELECT * from cliente WHERE idcliente = '.$id.'  LIMIT 1';
    $sql = mysql_query($query, $conexion);
    $row = mysql_fetch_array($sql);


    $query_prestamos = 'SELECT * from prestamo WHERE idcliente = '.$id.' AND Prestamoya = 0 AND estado = 0 ORDER BY estado, fecha DESC';
    $sql_prestamos   = mysql_query($query_prestamos, $conexion);

                       
?>

<html>
<head>
  <title>Gestion de Prestamos Manuel Leal</title>  
  <link rel="stylesheet" href="css/estilos.css">
<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
</head>
<body>
<form  class="contact_form" action="#" id="contact_form" runat="server">  
        <div>  
            <ul>  
                <li>  
                    <h2>Busqueda de Clientes</h2>  
                     
                </li>  
                <li>  
                    <label for="foto">foto:</label>  
                     <img src="images/<?= $row['foto']; ?>" width="150">
                </li>  
                <li>  
                    <label for="name">Nombres:</label>  
                    <input type="text" value="<?= $row['Nombres']; ?>" />  
                </li>  
                <li>  
                    <label for="apellido">Apellidos:</label>  
                    <input type="text" value="<?= $row['Apellidos']; ?>"   />  
                </li> 
                <li>  
                    <label for="direccion">Dirección:</label>  
                    <input type="text" value="<?= $row['Direccion']; ?>"   />  
                </li>

                <li>  
                    <label for="email">Email:</label>  
                    <input type="email" name="email" value="<?= $row['Correo']; ?>"   />  
                     
                </li>  
                <li>  
                    <label for="cedula">Cedula:</label>  
                    <input type="url" name="website" value="<?= $row['Cedula']; ?>"    />  
                </li>
                <li>  
                    <label for="cedula">Telefono:</label>  
                    <input type="url" name="telefono" value="<?= $row['Telefono']; ?>"    />  
                </li>  
                 
                
            </ul>  
        </div>  
    </form> 
    
    <div>
        <h3>PRESTAMOS RAPIDOS</h3>
        <form action="" class="contact_form">
           
        <?php 

            $prestamos_rapidos     = 'SELECT * from prestamo WHERE idcliente = '.$id.' AND Prestamoya=1 AND estado = 0 ORDER BY fecha DESC';
            $sql_prestamos_rapidos = mysql_query($prestamos_rapidos, $conexion);
            
            
           

            if ( $sql_prestamos_rapidos) {

                $cuenta_prestamos_rapidos = mysql_num_rows($sql_prestamos_rapidos);
            
                if ($cuenta_prestamos_rapidos ==0)
                {
                    echo 'No han hecho prestamos rapidos a este usuario';
                }
            else
                {

                    while ($fech_prestamos_rapidos = mysql_fetch_array($sql_prestamos_rapidos))
                    {

                        $query_prestamo = 'SELECT Valor, Interes, Cuotas, idcliente FROM prestamo WHERE idprestamo = '.$fech_prestamos_rapidos['idprestamo'].'' ;
                        $sql_prestamo   = mysql_query($query_prestamo, $conexion);
                        $row_prestamo   = mysql_fetch_array($sql_prestamo);

            $query_abono = 'SELECT SUM(valor) as valortotal FROM abonos WHERE idprestamo = '.$fech_prestamos_rapidos['idprestamo'].'' ;
                        $sql_abono = mysql_query($query_abono, $conexion);
                        $row_abono = mysql_fetch_array($sql_abono);

            $interes         = ($row_prestamo['Interes']/100)*$row_prestamo['Valor'];
            $valor_total     = $row_prestamo['Valor'];
            $meses_cuotas    = $row_prestamo['Cuotas']/30;
             $total_intereses = $interes * $meses_cuotas;
            $total_abono     = $row_abono['valortotal'];
            $debe            = ($valor_total+$total_intereses)-$total_abono;

                        echo '<form class="contact_form"><ul>';

                        $interes_prestamo_rapido = $fech_prestamos_rapidos['Valor']*($fech_prestamos_rapidos['Interes']/100 * $fech_prestamos_rapidos['Tiempo']/30 );

                        $suma_intereses_prestamo_rapido =  $interes_prestamo_rapido + $fech_prestamos_rapidos['Valor'];


                        $fecha_intereses_prestamo_rapido = $fech_prestamos_rapidos['fecha'];

                        $nuevafecha = strtotime ( '+'.$fech_prestamos_rapidos['Tiempo'].'  day' , strtotime ( $fecha_intereses_prestamo_rapido ) ) ;

                        $nuevafecha = date ( 'Y-m-j' , $nuevafecha );

                        echo '<label for="Valor Total">Valor:</label> ';
                        echo '<li> <input type="" name=""  value="$ '.number_format($fech_prestamos_rapidos['Valor']).'"   /> </li>';

                        echo '<label for="Valor Total">Con Interes:</label> ';
                        echo '<li> <input type="" name=""  value="$ '.number_format($suma_intereses_prestamo_rapido) .'" /> </li>';

                        echo '<label for="Valor Total">Ganancia:</label> ';
                        echo '<li> <input type="" name=""  value="$ '.number_format($interes_prestamo_rapido).'" /> </li>';

                        echo '<label for="Valor Total">Fecha de cobro:</label> ';
                        echo '<li> <input type="" name=""  value="'. $nuevafecha  .'" /> </li>';

                        echo '<label for="Valor Total">Debe:</label> ';
                        echo '<li> <input type="" name=""  value="'. number_format($debe)  .'" /> </li>';

                         echo '</ul> </form>';
                    }

                   
                }
            }

         ?>



        </form>
    </div>

    <div>
        <h3>PRESTAMOS</h3>

        <?php


            while ($row_prestamos   = mysql_fetch_array($sql_prestamos)) {

                $query_prestamo = 'SELECT Valor, Interes, Cuotas FROM prestamo WHERE idprestamo = '.$row_prestamos['idprestamo'].'' ;
                $sql_prestamo   = mysql_query($query_prestamo, $conexion);
                $row_prestamo   = mysql_fetch_array($sql_prestamo);

                $query_abono = 'SELECT SUM(valor) as valortotal FROM abonos WHERE idprestamo = '.$row_prestamos['idprestamo'].'';
                $sql_abono = mysql_query($query_abono, $conexion);
                $row_abono = mysql_fetch_array($sql_abono);
                
                $interes         = ($row_prestamo['Interes']/100)*$row_prestamo['Valor'];
                $cuotas          = $row_prestamos['Cuotas'];      
                $meses_cuotas    = $row_prestamos['Cuotas']/30;
                $total_intereses = $interes * $meses_cuotas;
                $valor_total     = $row_prestamo['Valor'];
                $total_abono     = $row_abono['valortotal'];
                $valor_deuda     = ($valor_total+$total_intereses);
                $debe            = ($valor_total+$total_intereses)-$total_abono;
                $valor_cuota     = round($valor_deuda/$cuotas);

        ?>
        
        <form  class="contact_form" >
        <div>  
            <ul> 
                <li>  
                    <label for="Prestamo">Fecha:</label>  
                    <input type="url" name="fecha" value="<?= $row_prestamos['fecha']; ?>"   />  
                   
                </li> 
                <!--<li>  
                    <label for="Prestamo">Estado:</label>  
                    <input type="url" name="fecha" style="font-weight:bold; background:yellow" value="<?php if ($row_prestamos['estado'] ==1) {
                        echo 'Activo';
                    }else{ echo 'Cancelado' ;} ?>"   />  
                   
                </li>--> 
                 <li>  
                    <label for="Prestamo">Cantidad Solicitada:</label>  
                    <input type="url" name="Prestamo"  value="$<?= number_format($row_prestamos['Valor']); ?>"     />  
                   
                </li>
                <li>  
                    <label for="Interes">Interes:</label>  
                    <input type="url" name="Interes"  value="<?= $row_prestamos['Interes']; ?>%"     />  
                      
                </li>
                <li>  
                    <label for="Cuotas">Cuotas:</label>  
                    <input type="url" name="Cuotas" value="<?= $row_prestamos['Cuotas']; ?> diarias"      />  
                      
                </li>
                <li>  
                    <label for="Tiempo">Tiempo:</label>  
                    <input type="url" name="Tiempo"  value="<?= $row_prestamos['Tiempo']/30; ?> meses"     />  
                      
                </li>
                <li>  
                    <label for="Valor Total">Valor Total:</label>  
                    <input type="url" name="valorTotal"  value="$<?= number_format( ($row_prestamos['Valor']) +($row_prestamos['Valor']*($row_prestamos['Interes']/100)) * ($row_prestamos['Tiempo']/30)); ?>"   />     
                </li> 
                <li>  
                    <label for="Valor Total">Ganancia Total:</label>  
                    <input type="url" name="valorGanancia"  value="$<?=number_format( ($row_prestamos['Valor']*($row_prestamos['Interes']/100)) * ($row_prestamos['Tiempo']/30)); ?>"   />    
                </li>
                <li>  
                    <label for="Valor Total">Total Abonado:</label>  
                    <input type="url" name="valorGanancia"  value="<?= '$ '.number_format($row_abono['valortotal']);

                     ?>"   />    
                </li> 
                <li>  
                    <label for="Valor Total">Debe:</label>  
                    <input type="url" name="valorGanancia"  value="<?php 
                     
                       

                        echo '$' . number_format($debe);




                     ?>"   />    
                </li> 
                <li>  
                    <label for="Valor Total">Valor Cuota:</label>  
                    <input type="url" name="valorGanancia"  value="<?php echo '$ '.number_format($valor_cuota); ?>"   />    
                </li> 
                <li>  
                    <label for="Valor Total">Cuotas Restantes:</label>  
                    <input type="url" name="valorGanancia"  value="<?php 
                     
                        $query_cuota = 'SELECT SUM(cuotas) as cuota FROM abonos WHERE idprestamo = '.$row_prestamos['idprestamo'].'';
                        $sql_cuota   = mysql_query($query_cuota, $conexion);
                        $row_cuota   = mysql_fetch_array($sql_cuota);
                        
                        

                        $query_cuotas = 'SELECT Cuotas as cuotasr FROM prestamo WHERE idcliente = '.$id.'';
                        $sql_cuotas = mysql_query($query_cuotas, $conexion);
                        $row_cuotas = mysql_fetch_array($sql_cuotas);
                        
                        echo $row_cuotas['cuotasr']-$row_cuota['cuota'];

                     ?> "   />    
                </li>  
            </ul>  
        </div>  
        </form>

        <?php } ?>
    </div>
    
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