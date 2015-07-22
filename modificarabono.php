<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

<form action="guardarmodificarabono.php">
    
    <label>Seleccione el abono a modificar</label>
    <input type="hidden" name="idprestamo" value="<?= $_GET['id']  ?>">
     <div>

         <?php 
            include("conexion.php");
            
            $query = 'SELECT * from abonos WHERE idprestamo =  '.$_GET['id'].' ORDER BY fecha DESC';
            $sql = mysql_query($query, $conexion);

            echo  '<select name="idabono">';
            
            while($row = mysql_fetch_array($sql))
            {
                echo '<option value="'.$row['idabono'].'">$ '.number_format($row['valor']).' '.$row['fecha'].' </option>';    
            }
            echo '</select>';

        ?>


<div>
            <button>Modificar</button>
</div>
     </div>

</form>
</body>
</html>