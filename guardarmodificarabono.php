
<link rel="stylesheet" href="css/estilos.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
<script type="text/javascript" src="priceformat.js">
       function miles() {
                $('#valor').priceFormat();
        </script>
        <script type="text/javascript">
                  function miles() {
                $('#valor').priceFormat();
            }
        </script>

<?php
include("conexion.php");


$query_prestamo = 'SELECT Valor, Interes, Cuotas FROM prestamo WHERE idprestamo = '.$_GET['idprestamo'].'';
$sql_prestamo   = mysql_query($query_prestamo, $conexion);
$row_prestamo   = mysql_fetch_array($sql_prestamo);

$query_abono = 'SELECT SUM(valor) as valortotal FROM abonos WHERE idprestamo = '.$_GET['idprestamo'].'';
$sql_abono = mysql_query($query_abono, $conexion);
$row_abono = mysql_fetch_array($sql_abono);

$interes         = ($row_prestamo['Interes']/100)*$row_prestamo['Valor'];
$cuotas          = $row_prestamo['Cuotas'];      
$meses_cuotas    = $row_prestamo['Cuotas']/30;
$total_intereses = $interes * $meses_cuotas;
$valor_total     = $row_prestamo['Valor'];
$total_abono     = $row_abono['valortotal'];
$valor_deuda     = ($valor_total+$total_intereses);
$debe            = ($valor_total+$total_intereses)-$total_abono;
$valor_cuota     = round($valor_deuda/$cuotas);



if ( isset ($_POST['btn']))
{
    if (isset ($_POST['valor']) && !empty($_POST['valor'])) {
        

    $cuotas = $_POST['val'];
    $valor = str_replace( '.', '' , $_POST['valor']);

    $suma_cuotas = $valor/$cuotas;


    $query = 'UPDATE abonos SET  valor = '.$valor.', cuotas = '.$suma_cuotas.' WHERE idabono ='.$_POST['id'].' ';
    $sql = mysql_query($query, $conexion);


    $query_abono = 'SELECT SUM(valor) as valortotal FROM abonos WHERE idprestamo = '.$_POST['id'].'';
    $sql_abono = mysql_query($query_abono, $conexion);
    $row_abono = mysql_fetch_array($sql_abono);


    $query_prestamo = 'SELECT Valor, Interes FROM prestamo WHERE idprestamo = '.$_POST['id'].'';
    $sql_prestamo   = mysql_query($query_prestamo, $conexion);
    $row_prestamo   = mysql_fetch_array($sql_prestamo);

    if ( $row_abono['valortotal'] == ($row_prestamo['Valor']*($row_prestamo['Interes']/100)+$row_prestamo['Valor']))
    {
        $query_pago = 'UPDATE prestamo SET estado="0" WHERE idprestamo = '.$_POST['id'];
        $sql_pago = mysql_query($query_pago, $conexion);
    }


    echo "Datos insertados correctamente";
    }
    else {
    echo "Problemas al insertar los datos";
    } 
}
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

<form action="" method="post">
    
    <label>Seleccione el abono a modificar</label>
     <div>
      <input type="hidden" name="id" value="<?= $_GET['idabono']; ?>" />
     <input type="hidden" name="val" value="<?= $valor_cuota; ?>" />
     <input type="text" name="valor" id="valor" onkeyup="miles()" /> 
     <div>
        <button name="btn" id="btn">Guardar modificar</button>
</div>
     </div>

<br><br>    
     <a class="boton" href="index.html" title="Inicio">Inicio</a>
     </form>
</body>
</html>