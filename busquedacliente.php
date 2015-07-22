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
  <title>Gestion de Prestamos</title>  
  <link rel="stylesheet" href="css/estilos.css">
<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
</head>
<body>

    
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

            $sqlnombre= 'SELECT p.Valor, p.Interes, p.Cuotas, p.idcliente, c.Nombres, c.Apellidos FROM prestamo p INNER JOIN cliente c on p.idcliente = c.idcliente WHERE estado = 0 AND Prestamoya = 1';
             $sql_nombre   = mysql_query($sqlnombre, $conexion);
            $row_nombre   = mysql_fetch_array($sql_nombre);

                        echo '<form class="contact_form"><ul>';

                        $interes_prestamo_rapido = $fech_prestamos_rapidos['Valor']*($fech_prestamos_rapidos['Interes']/100 * $fech_prestamos_rapidos['Tiempo']/30 );

                        $suma_intereses_prestamo_rapido =  $interes_prestamo_rapido + $fech_prestamos_rapidos['Valor'];


                        $fecha_intereses_prestamo_rapido = $fech_prestamos_rapidos['fecha'];

                        $nuevafecha = strtotime ( '+'.$fech_prestamos_rapidos['Tiempo'].'  day' , strtotime ( $fecha_intereses_prestamo_rapido ) ) ;

                        $nuevafecha = date ( 'Y-m-j' , $nuevafecha );


    echo '<div class="echo">' ;

    echo '<p> El prestamo se debe recoger en    '. $nuevafecha. ' </p>';

    echo '<p> El prestamo se hizo en            '. $fech_prestamos_rapidos['fecha'] . ' </p>';

    echo '<p> El prestamo se hizo a nombre de  '. $row_nombre['Nombres']. ' '.$row_nombre['Apellidos'].'</p>';

   echo '<p> El prestamo Tiene un valor de   '. number_format($fech_prestamos_rapidos['Valor']). ' </p>';

   echo '<p> El prestamo se hizo a  '. $row_nombre['Cuotas'].  ' Cuotas '. '</p>';

   echo '<p> Aun queda por pagar   '. number_format($debe). ' </p>';

   echo '<p> Han abonado  '. number_format($row_abono['valortotal']) .' </p>';

   echo '</div>' ;

    

     

                         echo '</ul> </form>';
                    }

                   
                }
            }

         ?>



        </form>
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