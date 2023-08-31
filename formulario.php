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
            <input type="text" name="buscarNit/Cc" id="" placeholder="Buscar cliente">
            <input type="submit" value="Buscar" name="buscar">
            <hr>
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
            <input type="submit" value="Listar todos los clientes" name="listar">
            <input type="submit" value="Actualizar cliente" name="actualizar">
            <input type="submit" value="Eliminar cliente" name="eliminar">
        </form>
    </center>
    <?php
        if(isset($_POST['guardar'])){
            //los datos de entrada almacenados en variables 
            $nitocc = $_POST['nitocc'];
            $nombre = $_POST['nombre']; 
            $direccion = $_POST['direccion']; 
            $telefono = $_POST['telefono']; 
            $fechaIngreso = $_POST['fechaIngreso']; 
            $cupoCredito = $_POST['cupoCredito'];
            //manejo de archivos
            $nombreFoto = $_FILES['foto']['name'];
            $ruta = $_FILES['foto']['tmp_name']; //ruta del archivo
            $foto = 'fotos/'.$nombreFoto; //ruta y nombre del archivo
            copy($ruta, $foto); //guarda el archivo en una ruta específica

            //verificar que no existan valores duplicados de nit o cedula
            $sqlBuscar = "SELECT nitocc FROM tblCliente WHERE nitocc='$nitocc' ORDER BY nitocc";

            if($resultado = mysqli_query($conexion, $sqlBuscar)){
                $numRegistros = mysqli_num_rows($resultado);
                if($numRegistros>0){
                    echo "<script>alert('ese nit o cc ya existe');</script>";
                } else {
                    mysqli_query($conexion, "INSERT INTO tblCliente (nitocc, nombre, direccion, telefono, fechaIngreso, cupoCredito, foto)
                    VALUES ('$nitocc', '$nombre', '$direccion', '$telefono', '$fechaIngreso', '$cupoCredito', '$foto')");

                    echo 'Datos guardados correctamente';
                }
            }
        }
    ?>
</body>
</html>
