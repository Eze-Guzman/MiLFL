<?php

    include "../assets/php/conexion_bd.php";

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style-usuarios.css">
    <link rel="shortcut icon" href="../assets/img/logo.png" type="image/x-icon">
    <title>Agregar o Modificar Usuarios - MiLFL</title>
</head>
<body>

<!-- Contenedor de Sección "Agregar o Modificar Usuarios" -->

    <section id="container">    

    <h1>Lista de Usuarios</h1>
    <a href="index_registro.php" class="btn_new">Agregar Usuario</a>

    <!-- Tabla contendora de los usuarios -->

        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Correo Electrónico</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>

            <?php

            /*Consulta de usuarios y selección de datos:
                1) Administradores
                2) Profesores
                3) Alumnos
                4) Directivos
                5) Preceptores
            */

                $query_admin = mysqli_query($conexion, "SELECT u.id, u.nombre_completo, u.dni, u.correo, r.rol 
                FROM administradores u 
                INNER JOIN rol r ON u.rol_id = r.idrol");

                $result_admin = mysqli_num_rows($query_admin);

                //Condicional muestra-datos de la tabla ADMINISTRADORES

                if($result_admin > 0){

                    while ($data = mysqli_fetch_array($query_admin)) {

                        ?>
                            <tr>
                                <td><?php echo $data['id'] ?></td>
                                <td><?php echo $data['nombre_completo'] ?></td>
                                <td><?php echo $data['dni'] ?></td>
                                <td><?php echo $data['correo'] ?></td>
                                <td><?php echo $data['rol'] ?></td>
                                <td>
                                    <a href="edicion/editar_administrador.php?id=<?php echo $data["id"]; ?>" 
                                    class="link_edit">Editar</a>
                                    |
                                    <a href="assets/php/eliminacion/eliminar_admin.php?id=<?php echo $data['id'] ?>"
                                     class="link_delete">Eliminar</a>
                                </td>
                            </tr>
    
                        <?php
                    }
                }

                $query_prof = mysqli_query($conexion, "SELECT u.id, u.nombre_completo, u.dni, u.correo, r.rol 
                FROM profesores u 
                INNER JOIN rol r ON u.rol_id = r.idrol");

                $result_prof = mysqli_num_rows($query_prof);

                //Condicional muestra-datos de la tabla PROFESORES

                if($result_prof > 0) {

                    while ($data = mysqli_fetch_array($query_prof)) {

                        ?>
                            <tr>
                                <td><?php echo $data['id'] ?></td>
                                <td><?php echo $data['nombre_completo'] ?></td>
                                <td><?php echo $data['dni'] ?></td>
                                <td><?php echo $data['correo'] ?></td>
                                <td><?php echo $data['rol'] ?></td>
                                <td>
                                    <a href="edicion/editar_docente.php?id=<?php echo $data["id"]; ?>" 
                                    class="link_edit">Editar</a>
                                    |
                                    <a href="assets/php/eliminacion/eliminar_profesores.php?id=<?php echo $data['id'] ?>"
                                     class="link_delete">Eliminar</a>
                                </td>
                            </tr>
    
                        <?php

                    }
                }

                $query_alum = mysqli_query($conexion, "SELECT u.id, u.nombre_completo, u.dni, u.correo, r.rol 
                FROM alumnos u 
                INNER JOIN rol r ON u.rol_id = r.idrol");

                $result_alum = mysqli_num_rows($query_alum);

                //Condicional muestra-datos de la tabla ESTUDIANTES

                if($result_alum > 0) {

                    while ($data = mysqli_fetch_array($query_alum)) {

                        ?>
                            <tr>
                                <td><?php echo $data['id'] ?></td>
                                <td><?php echo $data['nombre_completo'] ?></td>
                                <td><?php echo $data['dni'] ?></td>
                                <td><?php echo $data['correo'] ?></td>
                                <td><?php echo $data['rol'] ?></td>
                                <td>
                                    <a href="edicion/editar_estudiante.php?id=<?php echo $data["id"]; ?>" 
                                    class="link_edit">Editar</a>
                                    |
                                    <a href="assets/php/eliminacion/eliminar_alumnos.php?id=<?php echo $data['id'] ?>"
                                     class="link_delete">Eliminar</a>
                                </td>
                            </tr>
    
                        <?php

                    }
                }

                $query_dir = mysqli_query($conexion, "SELECT u.id, u.nombre_completo, u.dni, u.correo, r.rol 
                FROM directivos u 
                INNER JOIN rol r ON u.rol_id = r.idrol");

                $result_dir = mysqli_num_rows($query_dir);

                //Condicional muestra-datos de la tabla DIRECTIVOS

                if($result_dir > 0) {

                    while ($data = mysqli_fetch_array($query_dir)) {

                        ?>
                            <tr>
                                <td><?php echo $data['id'] ?></td>
                                <td><?php echo $data['nombre_completo'] ?></td>
                                <td><?php echo $data['dni'] ?></td>
                                <td><?php echo $data['correo'] ?></td>
                                <td><?php echo $data['rol'] ?></td>
                                <td>
                                    <a href="edicion/editar_directivos.php?id=<?php echo $data["id"]; ?>" 
                                    class="link_edit">Editar</a>
                                    |
                                    <a href="assets/php/eliminacion/eliminar_directivos.php?id=<?php echo $data['id'] ?>"
                                     class="link_delete">Eliminar</a>
                                </td>
                            </tr>
    
                        <?php

                    }
                }

                $query_prece = mysqli_query($conexion, "SELECT u.id, u.nombre_completo, u.dni, u.correo, r.rol 
                FROM preceptores u 
                INNER JOIN rol r ON u.rol_id = r.idrol");

                $result_prece = mysqli_num_rows($query_prece);

                //Condicional muestra-datos de la tabla PRECEPTORES

                if($result_prece > 0) {

                    while ($data = mysqli_fetch_array($query_prece)) {

                        ?>
                            <tr>
                                <td><?php echo $data['id'] ?></td>
                                <td><?php echo $data['nombre_completo'] ?></td>
                                <td><?php echo $data['dni'] ?></td>
                                <td><?php echo $data['correo'] ?></td>
                                <td><?php echo $data['rol'] ?></td>
                                <td>
                                    <a href="edicion/editar_prece.php?id=<?php echo $data["id"]; ?>" 
                                    class="link_edit">Editar</a>
                                    |
                                    <a href="assets/php/eliminacion/eliminar_preceptores.php?id=<?php echo $data['id'] ?>"
                                     class="link_delete">Eliminar</a>
                                </td>
                            </tr>
    
                        <?php

                    }
                }

            ?>


        </table>
    </section>

    <script src="assets/js/eliminacion.js"></script>

</body>
</html>