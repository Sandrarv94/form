<?php
    include("conexion.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Crud php</title>
    <?php
        $nitocc = "";
        $nombre = ""; 
        $direccion = ""; 
        $telefono = ""; 
        $fechaIngreso = ""; 
        $cupoCredito = "";
        $foto = "";
        if(isset($_POST['buscar'])){
            $buscarNitCc = $_POST['buscarNitCc'];
            $consulta = $conexion->query("SELECT * FROM tblCliente WHERE nitocc='$buscarNitCc'");
            while($resultadoConsulta = $consulta->fetch_array()){
                $nitocc=$resultadoConsulta[0];
                $nombre=$resultadoConsulta[1];
                $direccion=$resultadoConsulta[2];
                $telefono=$resultadoConsulta[3];
                $fechaIngreso=$resultadoConsulta[4];
                $cupoCredito=$resultadoConsulta[5];
                $foto=$resultadoConsulta[6];
            }
        }

    ?>
</head>
<body>
    <center>
        <h2>Manipulación de datos con PHP</h2>
        <form action=""  method="post" enctype="multipart/form-data">
            <label for="">Buscar</label>
            <input type="text" name="buscarNitCc" id="" placeholder="Buscar cliente">
            <input type="submit" value="Buscar" name="buscar">
            <input type="submit" value="Listar todos los clientes" name="listar">
        </form>
        <hr>
        <form action="consultas.php" method="post" enctype="multipart/form-data">
            <label for="">Nit o CC: </label>
            <input type="text" name="nitocc" id="" value="<?php echo $nitocc ?>" placeholder="Ingrese el nit o cc del nuevo cliente">
            <br><br>
            <label for="">Nombres: </label>
            <input type="text" name="nombre" id="" value="<?php echo $nombre ?>" placeholder="Ingresa el nombre completo">
            <br><br>
            <label for="">Dirección: </label>
            <input type="text" name="direccion" id="" value="<?php echo $direccion ?>" placeholder="Ej: Cl 34#12-20">
            <br><br>
            <label for="">Telefono: </label>
            <input type="number" name="telefono" id="" value="<?php echo $telefono ?>" placeholder="Ej: 222-222-2222">
            <br><br>
            <label for="">Fecha de ingreso: </label>
            <input type="date" name="fechaIngreso" id="" value="<?php echo $fechaIngreso ?>">
            <br><br>
            <label for="">Cupo del crédito: </label>
            <input type="number" name="cupoCredito" id="" value="<?php echo $cupoCredito ?>" placeholder="Ingresar valor en pesos">
            <br><br>
            <label for="">Subir foto: </label>
            <input type="file" name="foto" id="">
            <br><br>
            <label for="">Foto: </label>
            <img src="<?php echo $foto ?>" alt="" width="80" height="80">
            <br><br>
            <input type="submit" value="Guardar nuevo cliente" name="guardar">
            <input type="submit" value="Actualizar cliente" name="actualizar">
            <input type="submit" value="Eliminar cliente" name="eliminar">
        </form>
    </center>
    <?php
        if(isset($_POST['listar'])){
            echo "<center>
                <table border='3'>
                <tr>
                    <th>Nit o CC</th>
                    <th>Dirección</th>
                    <th>Telefono</th>
                    <th>Fecha de Ingreso</th>
                    <th>Cupo de Crédito</th>
                    <th>Foto del Cliente</th>
                </tr>";

                $buscar=$conexion->query("SELECT * FROM tblCliente");
                while($resultado = $buscar->fetch_array()){
                    $nitocc=$resultado[0];
                    $nombre=$resultado[1];
                    $direccion=$resultado[2];
                    $telefono=$resultado[3];
                    date_default_timezone_set('America/Bogota');
                    $fechaIngreso=date("d-m-Y", strtotime($resultado[4]));
                    $cupoCredito = number_format($resultado[5]);
                    $foto = $resultado[6];
                }
                
            echo "<tr>
                <td>$nitocc</td>
                <td>$nombre</td>
                <td>$direccion</td>
                <td>$telefono</td>
                <td>$fechaIngreso</td>
                <td>$cupoCredito</td>
                <td>
                    <img src='$foto' width='30%' height='30%'>
                </td>
        
            </tr> 
             
            </table></center>"; 
        }
    ?>
</body>
</html>
