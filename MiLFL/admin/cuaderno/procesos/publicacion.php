<?php

    include "../../../assets/php/conexion_bd.php";

    $mensajePublicacion = $_POST['mensaje-publicacion'];
    $cursoDestinatario = $_POST['curso-destinatario'];
    $fechaActual = $_POST['fecha-actual'];
    $nombreUsuario = $_POST['nombre-usuario'];
    $dniUsuario = $_POST['dni-usuario'];

    $query = "INSERT INTO publicaciones (nombre_usuario, dni_usuario, contenido_publicacion, fecha_publicacion, curso_id) 
    VALUES ('$nombreUsuario', '$dniUsuario', '$mensajePublicacion', '$fechaActual', '$cursoDestinatario')";

    if ($cursoDestinatario == 7) {
        $update_msg = "UPDATE alumnos SET msg_no_leidos = msg_no_leidos + 1";
    } else {
        $update_msg = "UPDATE alumnos SET msg_no_leidos = msg_no_leidos + 1 
                       WHERE curso ='$cursoDestinatario'";
    }

    $ejecutar = mysqli_query($conexion, $query);
    $ejecutar_msg = mysqli_query($conexion, $update_msg);

    if($ejecutar) {
        echo '
            <script>
                alert("Nota subida exitosamente!");
                window.location = "../cuaderno.php";
            </script>
        ';
    }

?>