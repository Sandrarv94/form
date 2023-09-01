<?php
    include("conexion.php");
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
       


       if(isset($_POST['guardar'])){
        //verificar que no existan valores duplicados de nit o cedula
        $sqlBuscar = "SELECT nitocc FROM tblCliente WHERE nitocc='$nitocc' ORDER BY nitocc";

        if($resultado = mysqli_query($conexion, $sqlBuscar)){
            $numRegistros = mysqli_num_rows($resultado);
            if($numRegistros>0){
                echo "<script>alert('ese nit o cc ya existe');</script>";

            } else {
                copy($ruta, $foto); 

                mysqli_query($conexion, "INSERT INTO tblCliente (nitocc, nombre, direccion, telefono, fechaIngreso, cupoCredito, foto)
                VALUES ('$nitocc', '$nombre', '$direccion', '$telefono', '$fechaIngreso', '$cupoCredito', '$foto')");

                echo "<script>alert('Datos guardados correctamente'); window.location.href='formulario.php'</script>";
            }
        }
    }

    if(isset($_POST['actualizar'])){
        mysqli_query($conexion, "UPDATE tblCliente SET nombre='$nombre', 
        direccion='$direccion', telefono='$telefono', fechaIngreso='$fechaIngreso', 
        cupoCredito='$cupoCredito', foto='$foto' WHERE nitocc='$nitocc'");

        echo "<script>alert('Datos actualizados correctamente'); window.location.href='formulario.php'</script>";

    }

    if(isset($_POST['eliminar'])){
        mysqli_query($conexion, "DELETE FROM tblCliente WHERE nitocc='$nitocc' ");
        
        echo "<script>alert('Datos eliminados correctamente'); window.location.href='formulario.php'</script>";

    }


?>