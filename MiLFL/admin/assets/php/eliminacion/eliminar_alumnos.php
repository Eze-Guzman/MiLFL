<?php

    include "../../../../assets/php/conexion_bd.php";

    $id = $_GET['id'];
    $delete = "DELETE FROM alumnos WHERE id = '$id'";

    $delete_result = mysqli_query($conexion, $delete);

    if($delete_result) {
        header("location: ../../../agregar_mod_usuarios.php");
    }
?>